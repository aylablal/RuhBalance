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

// Kullanıcı ve hareket ID'lerini al
$kullanici_id = $_SESSION['kullanici_id'];
$hareket_id = isset($_GET['hareket_id']) ? intval($_GET['hareket_id']) : 0;

if ($hareket_id > 0) {
    try {
        // Favorilerden kaldır
        $stmt = $conn->prepare("DELETE FROM kullanici_favori_hareketler WHERE kullanici_id = ? AND hareket_id = ?");
        $stmt->execute([$kullanici_id, $hareket_id]);
        
        // Profil sayfasına yönlendir
        header("Location: profil.php#favori-hareketler");
        exit();
    } catch (PDOException $e) {
        echo "Hata: " . $e->getMessage();
        exit();
    }
} else {
    // Hareket ID'si geçersizse profil sayfasına yönlendir
    header("Location: profil.php");
    exit();
}
?>