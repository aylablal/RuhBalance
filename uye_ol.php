<?php


header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');



require_once 'session_kontrol.php';

if(isset($_SESSION['kullanici_id']) && !empty($_SESSION['kullanici_id'])) {
    // Kullanıcı oturumu aktif olarak kullanacak
    $kullanici_id = $_SESSION['kullanici_id'];
    $kullanici_ad = $_SESSION['kullanici_ad'] ?? '';
    $kullanici_email = $_SESSION['kullanici_email'] ?? '';
}

// Veritabanı bağlantısını dahil et
require_once 'veritabani_baglantisi.php';

// Üyelik işlemi
if (isset($_POST['uye_btn'])) {
    $ad = trim($_POST['uye_ad']);
    $email = trim($_POST['uye_email']);
    $sifre = $_POST['uye_sifre'];
    
    // Basit doğrulama
    if (strlen($ad) < 3) {
        $hata = "Adınız en az 3 karakter olmalıdır.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $hata = "Geçerli bir e-posta adresi giriniz.";
    } elseif (strlen($sifre) < 4) {
        $hata = "Şifreniz en az 4 karakter olmalıdır.";
    } else {
        // E-posta adresinin daha önce kullanılıp kullanılmadığını kontrol et
        $stmt = $conn->prepare("SELECT COUNT(*) FROM kullanicilar WHERE email = ?");
        $stmt->execute([$email]);
        $email_count = $stmt->fetchColumn();
        
        if ($email_count > 0) {
            $hata = "Bu e-posta adresi zaten kullanılıyor.";
        } else {
            // Şifreyi güvenli bir şekilde hashle
            $hash_sifre = password_hash($sifre, PASSWORD_DEFAULT);
            
            // Kullanıcıyı veritabanına ekle
            try {
                $stmt = $conn->prepare("INSERT INTO kullanicilar (ad, email, sifre) VALUES (?, ?, ?)");
                $stmt->execute([$ad, $email, $hash_sifre]);
                
                // Kullanıcı ID'sini al
                $kullanici_id = $conn->lastInsertId();
                
                // Kullanıcı profilini oluştur
                $stmt = $conn->prepare("INSERT INTO kullanici_profilleri (kullanici_id) VALUES (?)");
                $stmt->execute([$kullanici_id]);
                
                // Oturum değişkenlerini ayarla
                $_SESSION['kullanici_id'] = $kullanici_id;
                $_SESSION['kullanici_ad'] = $ad;
                $_SESSION['kullanici_email'] = $email;
                
                // Profil sayfasına yönlendir
                header("Location: profil.php");
                exit();
                
            } catch (PDOException $e) {
                $hata = "Üye kayıt işlemi sırasında bir hata oluştu: " . $e->getMessage();
            }
        }
    }
}

// Giriş işlemi
if (isset($_POST['giris_btn'])) {
    $ad = trim($_POST['giris_ad']);
    $sifre = $_POST['giris_sifre'];
    
    // Kullanıcı adına göre kullanıcıyı bul
    $stmt = $conn->prepare("SELECT id, ad, email, sifre FROM kullanicilar WHERE ad = ?");
    $stmt->execute([$ad]);
    $kullanici = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Kullanıcı bulundu ve şifre doğru
    if ($kullanici && password_verify($sifre, $kullanici['sifre'])) {
        // Son giriş tarihini güncelle
        $stmt = $conn->prepare("UPDATE kullanicilar SET son_giris_tarihi = NOW() WHERE id = ?");
        $stmt->execute([$kullanici['id']]);
        
        // Oturum değişkenlerini ayarla
        $_SESSION['kullanici_id'] = $kullanici['id'];
        $_SESSION['kullanici_ad'] = $kullanici['ad'];
        $_SESSION['kullanici_email'] = $kullanici['email'];
        
        // Profil sayfasına yönlendir
        header("Location: profil.php");
        exit();
    } else {
        $giris_hata = "Kullanıcı adı veya şifre hatalı.";
    }
}
?>

































<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Üye ol</title>
    <link rel="stylesheet" href="uye.css">
</head>
<body>

<header>
    <a href="index.php" class="logo"> RuhBalance</a>
    <div class="bx bx-menu" id="menu-icon"></div>

    <ul class="navbar">
        <li><a href="index.php" class="home-active">Anasayfa</a></li>
        <li><a href="hakkimizda.php">Hakkımızda</a></li>
        <li><a href="yoga.php">Yoga</a></li>
        <li><a href="blog.php">Blog</a></li>
        <li><a href="iletişim.php">İletişim</a></li>
    </ul>
</header>

<main <?php if(isset($hata) && strpos($hata, 'e-posta') !== false): ?>class="sign-up-mode"<?php endif; ?>>
    <div class="box">
        <div class="inner-box">
            <div class="forms-wrap">
                <!-- GİRİŞ FORMU -->
                <form action="uye_ol.php" method="POST" autocomplete="off" class="sign-in-form">
                    <div class="logo"><h3>RuhBalance</h3></div>

                    <div class="heading">
                        <h2>Tekrar Hoşgeldiniz</h2>
                        <h6>Henüz Kayıtlı Değil Misiniz?</h6>
                        <a href="#" class="toggle">Üye Ol</a>
                    </div>

                    <?php if(isset($giris_hata)): ?>
                        <div class="error-message" style="color: red; margin-bottom: 10px;"><?php echo $giris_hata; ?></div>
                    <?php endif; ?>

                    <div class="actual-form">
                        <div class="input-wrap">
                            <input type="text" name="giris_ad" minlength="4" class="input-field" autocomplete="off" required />
                            <label>Adınız</label>
                        </div>

                        <div class="input-wrap">
                            <input type="password" name="giris_sifre" minlength="4" class="input-field" autocomplete="off" required />
                            <label>Şifreniz</label>
                        </div>

                        <input type="submit" name="giris_btn" value="Giriş Yap" class="sign-btn" />

                        <p class="text">
                            Giriş yapamıyor musunuz? Şifrenizi mi unuttunuz?
                            <a href="#">Yardım Al</a>
                        </p>
                    </div>
                </form>

                <!-- ÜYE OL FORMU -->
                <form action="uye_ol.php" method="POST" autocomplete="off" class="sign-up-form">
                    <div class="logo"><h3>RuhBalance</h3></div>

                    <div class="heading">
                        <h2>Hadi Başlayalım!</h2>
                        <h6>Zaten bir hesabınız var mı?</h6>
                        <a href="#" class="toggle">Oturum Aç</a>
                    </div>

                    <?php if(isset($hata)): ?>
                        <div class="error-message" style="color: red; margin-bottom: 10px;"><?php echo $hata; ?></div>
                    <?php endif; ?>

                    <div class="actual-form">
                        <div class="input-wrap">
                            <input type="text" name="uye_ad" minlength="4" class="input-field" autocomplete="off" required />
                            <label>Adınız</label>
                        </div>

                        <div class="input-wrap">
                            <input type="email" name="uye_email" class="input-field" autocomplete="off" required />
                            <label>Email</label>
                        </div>

                        <div class="input-wrap">
                            <input type="password" name="uye_sifre" minlength="4" class="input-field" autocomplete="off" required />
                            <label>Şifreniz</label>
                        </div>

                        <input type="submit" name="uye_btn" value="Üye Ol" class="sign-btn" />

                        <p class="text">
                            Kaydolarak <a href="#">Hizmet Şartları</a> ve 
                            <a href="#">Gizlilik Politikası</a>'nı kabul etmiş oluyorum.
                        </p>
                    </div>
                </form>
            </div>

            <div class="carousel">
                <div class="images-wrapper">
                    <img src="image1.png" class="image img-1 show" alt="" />
                    <img src="image2.png" class="image img-2" alt="" />
                    <img src="image3.png" class="image img-3" alt="" />
                </div>

                <div class="text-slider">
                    <div class="text-wrap">
                        <div class="text-group">
                            <h2>Kendi yoga rutinini oluştur</h2>
                            <h2>Kendine en uygun hareketi seç!</h2>
                            <h2>Burada her şey senin için</h2>
                        </div>
                    </div>

                    <div class="bullets">
                        <span class="active" data-value="1"></span>
                        <span data-value="2"></span>
                        <span data-value="3"></span>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</main>

<script src="uye.js"></script>
</body>
</html>