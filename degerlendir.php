<?php

header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "u165807241_ayla";
$password = "aylaKesan22";
$dbname = "u165807241_ruhbalance";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

$rating = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
$opinion = isset($_POST['opinion']) ? $_POST['opinion'] : "";

// Gelişmiş kötü yorum kontrol fonksiyonu
function yorumKontrol($yorum) {
    // Metni küçük harfe çevir ve özel karakterleri temizle
    $temizYorum = mb_strtolower($yorum, 'UTF-8');
    $temizYorum = preg_replace('/[^a-züğşıöçA-ZÜĞŞİÖÇ0-9\s]/', '', $temizYorum);
    
    // Kapsamlı Türkçe küfür ve argo kelimeleri listesi
    $turkceKufurler = [
        // Temel küfürler
        'amk', 'amına', 'amq', 'aq', 'amcık', 'amcığı', 'amcıq', 'amc', 'amk',
        'sikim', 'sikik', 'sik', 'sikm', 'sktir', 'siktir', 'siktr', 'sktm',
        'götü', 'göt', 'götün', 'götüne', 'gotun', 'gotu', 'got',
        'yarrak', 'yarrağı', 'yarram', 'yarraq', 'yarak', 'yarag',
        'taşak', 'taşşak', 'tasak', 'tassak', 'daşşak', 'daşak',
        'piç', 'pic', 'pici', 'picin', 'pezevenk', 'pezeveng',
        'orospu', 'orospusu', 'oruspu', 'orsbı', 'orsp', 'orbs',
        'kahpe', 'kahbe', 'kancık', 'kancik', 'sürtük', 'surtuk',
        'fahişe', 'fahise', 'kaltak', 'kaltag', 'kevaşe', 'kevase',
        
        // Hayvan isimleriyle hakaret
        'köpek', 'kopek', 'it', 'domuz', 'eşek', 'esek', 'katır', 'katir',
        'dana', 'inek', 'boğa', 'boga', 'öküz', 'okuz', 'koyun', 'keçi', 'keci',
        
        // Organ isimleri (kötü kullanım)
        'pipim', 'pipin', 'penis', 'amcık', 'vajina', 'meme', 'göğüs', 'gogus',
        
        // Ağır hakaretler
        'gerizekalı', 'gerzek', 'salak', 'aptal', 'mal', 'dangalak', 'dangalag',
        'ahmak', 'budala', 'embesil', 'moron', 'geri zekali', 'beyinsiz',
        'kafasız', 'kafasiz', 'kafa', 'kafası', 'kafasi', 'beynin',
        
        // Diğer argo ifadeler
        'bok', 'boktan', 'bokum', 'pislik', 'pislig', 'rezil', 'rezalet',
        'lanet', 'allah', 'allahını', 'allahini', 'tanrı', 'tanri', 'tanrını', 'tanrini',
        'din', 'dini', 'dinini', 'imam', 'hoca', 'müezzin', 'muezzin',
        'çişim', 'cisim', 'sidik', 'idrar', 'kaka', 'kaça',
        'serefsiz', 'şerefsiz', 'namussuz', 'namusuz', 'alçak', 'alcak',
        'hain', 'katil', 'öldür', 'oldur', 'gebertmek', 'gebersin',
        
        // Cinsel içerikli kelimeler
        'seks', 'sex', 'cinsel', 'ilişki', 'iliski', 'sevişmek', 'sevismek',
        'mastürbasyon', 'masturbasyon', '31', 'otuz bir', 'otuzbir',
        
        // Kısa formlar ve yaygın yazım şekilleri
        'mk', 'mq', 'sg', 'gg', 'amg', 'aw', 'yq', 'yg', 'pg', 'pq',
        'götveren', 'got veren', 'götlek', 'gotlek', 'sikici', 'sikici',
        
        // Bölgesel argo
        'dangoz', 'dıngıl', 'dingil', 'şıllık', 'sillik', 'boşnak', 'bosnak',
        'kürt', 'kurd', 'çingene', 'cingen', 'roman', 'ermeni', 'rum',
        
        // Diğer yaygın küfürler
        'defol', 'defolsun', 'kaybol', 'siktirsin', 'siktirgit', 'siktir git',
        'kapak', 'kapag', 'susun', 'susun', 'kesin sesini', 'kesin sesin',
        'çeneni', 'ceneni', 'kapa çeneni', 'kapa ceneni'
    ];
    
    // İngilizce küfürler
    $ingilizceKufurler = [
        'fuck', 'fucking', 'fucker', 'fucked', 'fck', 'fcking', 'fking',
        'shit', 'shitty', 'crap', 'crappy', 'damn', 'damned', 'hell',
        'bitch', 'bitchy', 'bastard', 'asshole', 'ass', 'arse',
        'cock', 'dick', 'pussy', 'cunt', 'whore', 'slut', 'hoe',
        'nigga', 'nigger', 'fag', 'faggot', 'retard', 'retarded',
        'stupid', 'idiot', 'moron', 'dumb', 'dumbass', 'jackass',
        'piss', 'pissed', 'wtf', 'stfu', 'gtfo', 'bullshit', 'bs'
    ];
    
    // Tüm kelimeleri birleştir
    $tumKufurler = array_merge($turkceKufurler, $ingilizceKufurler);
    
    // Her küfür için kontrol et
    foreach ($tumKufurler as $kufur) {
        // Tam kelime eşleşmesi ve benzer yazım şekilleri için regex
        $pattern = '/\b' . preg_quote($kufur, '/') . '\b/ui';
        if (preg_match($pattern, $temizYorum)) {
            return false;
        }
        
        // Harf değişiklikleri ile yazılan küfürler için (ö->o, ü->u, ı->i, ş->s, ç->c, ğ->g)
        $normalizedKufur = str_replace(
            ['ö', 'ü', 'ı', 'ş', 'ç', 'ğ', 'İ', 'Ö', 'Ü', 'Ş', 'Ç', 'Ğ'],
            ['o', 'u', 'i', 's', 'c', 'g', 'i', 'o', 'u', 's', 'c', 'g'],
            $kufur
        );
        $pattern2 = '/\b' . preg_quote($normalizedKufur, '/') . '\b/ui';
        if (preg_match($pattern2, $temizYorum)) {
            return false;
        }
    }
    
    // Özel desenler için ek kontroller
    $ozelDesener = [
        // Çok fazla büyük harf kullanımı kontrolü (sinirli yazım)
        '/[A-ZĞÜŞİÖÇ]{5,}/u',
        
        // Aşırı noktalama işareti kullanımı kontrolü  
        '/[!?]{3,}/',
        
        // Tekrarlayan karakterler (öfkeli yazım)
        '/(.)\1{4,}/',
        
        // Sayılarla yazılan küfürler
        '/3\s*1|0\s*t\s*u\s*z\s*b\s*i\s*r/i',
        
        // Boşluklarla gizlenmeye çalışılan küfürler
        '/s\s*i\s*k\s*t\s*i\s*r|a\s*m\s*k|g\s*ö\s*t/i',
        
        // Özel karakterlerle gizlenmeye çalışılan küfürler
        '/[s$]\s*[i1]\s*[k]\s*[t]\s*[i1]\s*[r]/i',
        '/[a@]\s*[m]\s*[k]/i',
        '/[g]\s*[ö0]\s*[t]/i'
    ];
    
    foreach ($ozelDesener as $desen) {
        if (preg_match($desen, $yorum)) {
            return false;
        }
    }
    
    // Pozitif kelime kontrolü - eğer yorum sadece pozitif kelimelerden oluşuyorsa geçir
    $pozitifKelimeler = ['güzel', 'harika', 'muhteşem', 'mükemmel', 'süper', 'amazing', 'great', 'good', 'excellent', 'wonderful', 'fantastic', 'awesome', 'perfect', 'love', 'like', 'best', 'nice', 'cool', 'amazing'];
    $kelimeler = explode(' ', $temizYorum);
    $pozitifSayac = 0;
    
    foreach ($kelimeler as $kelime) {
        if (in_array(trim($kelime), $pozitifKelimeler)) {
            $pozitifSayac++;
        }
    }
    
    // Eğer yorumun %70'i pozitif kelimelerden oluşuyorsa geçir
    if (count($kelimeler) > 0 && ($pozitifSayac / count($kelimeler)) >= 0.7) {
        return true;
    }
    
    return true; // Hiçbir olumsuz durum tespit edilmediyse yorumu geçir
}

// Form gönderildiğinde
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($rating > 0 && !empty($opinion)) {
        // Yorumu kontrol et
        if (yorumKontrol($opinion)) {
            // Yorum temiz, veritabanına ekle
            $sql = "INSERT INTO yorumlar (rating, opinion) VALUES (?, ?)";
            
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("is", $rating, $opinion);
            
            if ($stmt->execute()) {
                // Başarılı mesajı için JavaScript alert kullan
                echo "<script>
                    alert('Yorumunuz başarıyla kaydedildi! Değerlendirmeniz için teşekkür ederiz.');
                    window.location.href = 'bizidegerlendir.php';
                </script>";
                exit();
            } else {
                $hata = "Veritabanı hatası: " . $stmt->error;
            }
            
            $stmt->close();
        } else {
            // Kötü yorum tespit edildi
            $hata = "Yorumunuz uygunsuz içerik nedeniyle reddedildi. Lütfen saygılı bir dil kullanarak yorumunuzu yeniden yazın.";
        }
    } else {
        $hata = "Lütfen yorum yazın ve yıldız derecelendirmesi yapın.";
    }
}

$conn->close();

// Eğer hata varsa, onu göster ve 5 saniye sonra sayfaya geri yönlendir
if (isset($hata)) {
    echo "<script>
        alert('$hata');
        setTimeout(function() {
            window.location.href = 'bizidegerlendir.php';
        }, 5000); // 5000 milisaniye = 5 saniye
    </script>";
}
?>