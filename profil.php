<?php


header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');

// Oturum kontrolünü dahil et
require_once 'session_kontrol.php';

// Kullanıcı girişi yapılmamışsa giriş sayfasına yönlendir
if (!isset($_SESSION['kullanici_id'])) {
    header("Location: uye_ol.php");
    exit();
}

// Veritabanı bağlantısını dahil et
require_once 'veritabani_baglantisi.php';

// Kullanıcı bilgilerini al
$kullanici_id = $_SESSION['kullanici_id'];
$kullanici_ad = $_SESSION['kullanici_ad'];
$kullanici_email = $_SESSION['kullanici_email'];

// Kullanıcı profil bilgilerini çek
$stmt = $conn->prepare("
    SELECT kp.*, k.son_giris_tarihi
    FROM kullanici_profilleri kp
    JOIN kullanicilar k ON k.id = kp.kullanici_id
    WHERE kp.kullanici_id = ?
");
$stmt->execute([$kullanici_id]);
$profil = $stmt->fetch(PDO::FETCH_ASSOC);

// Profil güncelleme işlemi
if (isset($_POST['profil_guncelle'])) {
    $telefon = trim($_POST['telefon']);
    $bio = trim($_POST['bio']);
    $dogum_tarihi = $_POST['dogum_tarihi'] ?: null;
    $cinsiyet = $_POST['cinsiyet'];
    $yoga_seviyesi = $_POST['yoga_seviyesi'];
    $ilgi_alanlari = isset($_POST['ilgi_alanlari']) ? implode(',', $_POST['ilgi_alanlari']) : '';
    
    try {
        // Profil bilgilerini güncelle
        $stmt = $conn->prepare("
            UPDATE kullanici_profilleri 
            SET telefon = ?, bio = ?, dogum_tarihi = ?, cinsiyet = ?, yoga_seviyesi = ?, ilgi_alanlari = ?
            WHERE kullanici_id = ?
        ");
        $stmt->execute([$telefon, $bio, $dogum_tarihi, $cinsiyet, $yoga_seviyesi, $ilgi_alanlari, $kullanici_id]);
        
        // Profil fotoğrafı yükleme
        if (isset($_FILES['profil_foto']) && $_FILES['profil_foto']['error'] === 0) {
            $izin_verilen_uzantilar = ['jpg', 'jpeg', 'png', 'gif'];
            $dosya_uzantisi = strtolower(pathinfo($_FILES['profil_foto']['name'], PATHINFO_EXTENSION));
            
            if (in_array($dosya_uzantisi, $izin_verilen_uzantilar)) {
                $yeni_dosya_adi = 'profil_' . $kullanici_id . '.' . $dosya_uzantisi;
                $hedef_klasor = 'profil_fotograflari/';
                
                // Klasör yoksa oluştur
                if (!file_exists($hedef_klasor)) {
                    mkdir($hedef_klasor, 0777, true);
                }
                
                $hedef_dosya = $hedef_klasor . $yeni_dosya_adi;
                
                if (move_uploaded_file($_FILES['profil_foto']['tmp_name'], $hedef_dosya)) {
                    // Veritabanında profil fotoğrafı yolunu güncelle
                    $stmt = $conn->prepare("UPDATE kullanici_profilleri SET profil_foto = ? WHERE kullanici_id = ?");
                    $stmt->execute([$hedef_dosya, $kullanici_id]);
                } else {
                    $upload_hata = "Dosya yüklenirken bir hata oluştu.";
                }
            } else {
                $upload_hata = "Sadece JPG, JPEG, PNG & GIF dosyaları yükleyebilirsiniz.";
            }
        }
        
        // Güncel profil bilgilerini al
        $stmt = $conn->prepare("SELECT * FROM kullanici_profilleri WHERE kullanici_id = ?");
        $stmt->execute([$kullanici_id]);
        $profil = $stmt->fetch(PDO::FETCH_ASSOC);
        
        $guncelleme_mesaji = "Profiliniz başarıyla güncellendi!";
    } catch (PDOException $e) {
        $guncelleme_hatasi = "Profil güncellenirken bir hata oluştu: " . $e->getMessage();
    }
}

// Şifre değiştirme işlemi
if (isset($_POST['sifre_degistir'])) {
    $mevcut_sifre = $_POST['mevcut_sifre'];
    $yeni_sifre = $_POST['yeni_sifre'];
    $yeni_sifre_tekrar = $_POST['yeni_sifre_tekrar'];
    
    // Mevcut şifreyi kontrol et
    $stmt = $conn->prepare("SELECT sifre FROM kullanicilar WHERE id = ?");
    $stmt->execute([$kullanici_id]);
    $kullanici_sifre = $stmt->fetchColumn();
    
    if (!password_verify($mevcut_sifre, $kullanici_sifre)) {
        $sifre_hatasi = "Mevcut şifreniz hatalı.";
    } elseif ($yeni_sifre != $yeni_sifre_tekrar) {
        $sifre_hatasi = "Yeni şifreler eşleşmiyor.";
    } elseif (strlen($yeni_sifre) < 4) {
        $sifre_hatasi = "Yeni şifreniz en az 4 karakter olmalıdır.";
    } else {
        // Şifreyi güncelle
        $hash_sifre = password_hash($yeni_sifre, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE kullanicilar SET sifre = ? WHERE id = ?");
        $stmt->execute([$hash_sifre, $kullanici_id]);
        
        $sifre_mesaji = "Şifreniz başarıyla güncellendi!";
    }
}

// İlgi alanlarını dizi haline getir
$ilgi_alanlari_dizi = !empty($profil['ilgi_alanlari']) ? explode(',', $profil['ilgi_alanlari']) : [];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - RuhBalance</title>
    <link rel="stylesheet" href="uye.css">
    <link rel="stylesheet" href="profil.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

<header>
    <a href="#" class="logo" onclick="anasayfaGoster()">RuhBalance</a>
    <div class="bx bx-menu" id="menu-icon"></div>

    <ul class="navbar">
        <li><a href="#" onclick="sayfaGoster('index.php', 'Anasayfa')">Anasayfa</a></li>
        <li><a href="#" onclick="sayfaGoster('hakkimizda.php', 'Hakkımızda')">Hakkımızda</a></li>
        <li><a href="#" onclick="sayfaGoster('yoga.php', 'Yoga')">Yoga</a></li>
        <li><a href="#" onclick="sayfaGoster('blog.php', 'Blog')">Blog</a></li>
        <li><a href="#" onclick="sayfaGoster('iletişim.php', 'İletişim')">İletişim</a></li>
        <li><a href="profil.php" class="home-active">Profil</a></li>
    </ul>
</header>


<div class="sayfa-goruntuleyici" id="sayfa-goruntuleyici">
    <div class="iframe-container">
        <div class="iframe-header">
            <h3 id="sayfa-baslik">Sayfa</h3>
            <button class="kapat-btn" onclick="sayfaKapat()">&times;</button>
        </div>
        <iframe class="iframe-content" id="content-frame" src=""></iframe>
    </div>
</div>

<main class="profil-sayfasi">
    <div class="profil-container">
        <div class="profil-sidebar">
            <div class="profil-resim">
                <?php if (!empty($profil['profil_foto'])): ?>
                    <img src="<?php echo htmlspecialchars($profil['profil_foto']); ?>" alt="Profil Fotoğrafı">
                <?php else: ?>
                    <div class="default-avatar">
                        <i class="fas fa-user"></i>
                    </div>
                <?php endif; ?>
                <h2><?php echo htmlspecialchars($kullanici_ad); ?></h2>
                <p><?php echo htmlspecialchars($kullanici_email); ?></p>
                
                <?php if (!empty($profil['yoga_seviyesi'])): ?>
                    <div class="seviye-badge">
                        <span>Seviye: <?php echo htmlspecialchars($profil['yoga_seviyesi']); ?></span>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="profil-menu">
                <ul>
                    <li><a href="#profil-bilgileri" class="active"><i class="fas fa-user"></i> Profil Bilgileri</a></li>
                    <li><a href="#sifre-degistir"><i class="fas fa-lock"></i> Şifre Değiştir</a></li>
                    <li><a href="cikis.php"><i class="fas fa-sign-out-alt"></i> Çıkış Yap</a></li>
                </ul>
            </div>
        </div>
        
        <div class="profil-content">
            <!-- Profil Bilgileri Formu -->
            <section id="profil-bilgileri" class="profil-section active">
                <h3>Profil Bilgileri</h3>
                
                <?php if(isset($guncelleme_mesaji)): ?>
                    <div class="mesaj basarili"><?php echo $guncelleme_mesaji; ?></div>
                <?php endif; ?>
                
                <?php if(isset($guncelleme_hatasi)): ?>
                    <div class="mesaj hata"><?php echo $guncelleme_hatasi; ?></div>
                <?php endif; ?>
                
                <?php if(isset($upload_hata)): ?>
                    <div class="mesaj hata"><?php echo $upload_hata; ?></div>
                <?php endif; ?>
                
                <form action="profil.php#profil-bilgileri" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="profil_foto"></label>
                        <input type="file" id="profil_foto" name="profil_foto" accept=".jpg, .jpeg, .png, .gif">
                    </div>
                    
                    <div class="form-group">
                        <label for="telefon"></label>
                        <input type="tel" id="telefon" name="telefon" value="<?php echo htmlspecialchars($profil['telefon'] ?? ''); ?>" placeholder="Telefon numaranız">
                    </div>
                    
                    <div class="form-group">
                        <label for="bio"></label>
                        <textarea id="bio" name="bio" rows="4" placeholder="Kendiniz hakkında kısa bilgi..."><?php echo htmlspecialchars($profil['bio'] ?? ''); ?></textarea>
                    </div>
                    
                    <div class="form-row">
                        <div class="form-group half">
                            <label for="dogum_tarihi"></label>
                            <input type="date" id="dogum_tarihi" name="dogum_tarihi" value="<?php echo htmlspecialchars($profil['dogum_tarihi'] ?? ''); ?>">
                        </div>
                        
                        <div class="form-group half">
                            <label for="cinsiyet"></label>
                            <select id="cinsiyet" name="cinsiyet">
                                <option value="">Seçiniz</option>
                                <option value="Kadın" <?php echo (isset($profil['cinsiyet']) && $profil['cinsiyet'] == 'Kadın') ? 'selected' : ''; ?>>Kadın</option>
                                <option value="Erkek" <?php echo (isset($profil['cinsiyet']) && $profil['cinsiyet'] == 'Erkek') ? 'selected' : ''; ?>>Erkek</option>
                                <option value="Diğer" <?php echo (isset($profil['cinsiyet']) && $profil['cinsiyet'] == 'Diğer') ? 'selected' : ''; ?>>Diğer</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="yoga_seviyesi"></label>
                        <select id="yoga_seviyesi" name="yoga_seviyesi">
                            <option value="">Seçiniz</option>
                            <option value="Başlangıç" <?php echo (isset($profil['yoga_seviyesi']) && $profil['yoga_seviyesi'] == 'Başlangıç') ? 'selected' : ''; ?>>Başlangıç</option>
                            <option value="Orta" <?php echo (isset($profil['yoga_seviyesi']) && $profil['yoga_seviyesi'] == 'Orta') ? 'selected' : ''; ?>>Orta</option>
                            <option value="İleri" <?php echo (isset($profil['yoga_seviyesi']) && $profil['yoga_seviyesi'] == 'İleri') ? 'selected' : ''; ?>>İleri</option>
                        </select>
                    </div>
                    
                    <div class="form-group buttons">
                        <button type="submit" name="profil_guncelle" class="btn primary">Profili Güncelle</button>
                    </div>
                </form>
            </section>
            
            <!-- Şifre Değiştir -->
            <section id="sifre-degistir" class="profil-section">
                <h3>Şifre Değiştir</h3>
                
                <?php if(isset($sifre_mesaji)): ?>
                    <div class="mesaj basarili"><?php echo $sifre_mesaji; ?></div>
                <?php endif; ?>
                
                <?php if(isset($sifre_hatasi)): ?>
                    <div class="mesaj hata"><?php echo $sifre_hatasi; ?></div>
                <?php endif; ?>
                
                <form action="profil.php" method="POST">
                    <div class="form-group">
                        <label for="mevcut_sifre"></label>
                        <input type="password" id="mevcut_sifre" name="mevcut_sifre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="yeni_sifre"></label>
                        <input type="password" id="yeni_sifre" name="yeni_sifre" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="yeni_sifre_tekrar"></label>
                        <input type="password" id="yeni_sifre_tekrar" name="yeni_sifre_tekrar" required>
                    </div>
                    
                    <div class="form-group buttons">
                        <button type="submit" name="sifre_degistir" class="btn primary">Şifreyi Değiştir</button>
                    </div>
                </form>
            </section>
        </div>
    </div>
</main>

<footer>
    <div class="footer-content">
        <div class="footer-logo">
            <h3>RuhBalance</h3>
            <p>Zihin ve vücut dengesi için doğru adres</p>
        </div>

    </div>
    <div class="footer-bottom">
        <p>&copy; <?php echo date('Y'); ?> RuhBalance - Tüm Hakları Saklıdır</p>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab menü sistemi
    const menuItems = document.querySelectorAll('.profil-menu a');
    const sections = document.querySelectorAll('.profil-section');
    
    menuItems.forEach(item => {
        item.addEventListener('click', function(e) {
            // Çıkış bağlantısına tıklandığında normal davranışı engelleme
            if (this.getAttribute('href') === 'cikis.php') {
                return true; // Normal bağlantı davranışı
            }
            
            e.preventDefault();
            
            // Aktif menü öğesini güncelle
            menuItems.forEach(i => i.classList.remove('active'));
            this.classList.add('active');
            
            // İlgili sekmeyi göster
            const target = this.getAttribute('href');
            sections.forEach(section => {
                section.classList.remove('active');
            });
            document.querySelector(target).classList.add('active');
        });
    });
    
    // URL hash'i varsa ilgili sekmeyi aç
    if (window.location.hash) {
        const hashLink = document.querySelector(`.profil-menu a[href="${window.location.hash}"]`);
        if (hashLink) {
            hashLink.click();
        }
    }
});

// Sayfa gösterme fonksiyonu
function sayfaGoster(url, baslik) {
    document.getElementById('content-frame').src = url;
    document.getElementById('sayfa-baslik').textContent = baslik;
    document.getElementById('sayfa-goruntuleyici').style.display = 'block';
    document.body.style.overflow = 'hidden'; // Arka planın kaydırılmasını engelle
}

// Anasayfa özel fonksiyonu
function anasayfaGoster() {
    sayfaGoster('index.php', 'Anasayfa');
}

// Sayfa kapatma fonksiyonu
function sayfaKapat() {
    document.getElementById('sayfa-goruntuleyici').style.display = 'none';
    document.getElementById('content-frame').src = '';
    document.body.style.overflow = 'auto'; // Arka planın kaydırılmasını tekrar aktif et
}

// ESC tuşu ile kapatma
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        sayfaKapat();
    }
});

// Modal dışına tıklayınca kapatma
document.getElementById('sayfa-goruntuleyici').addEventListener('click', function(e) {
    if (e.target === this) {
        sayfaKapat();
    }
});
</script>

</body>
</html>