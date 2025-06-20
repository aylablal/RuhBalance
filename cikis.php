<?php
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');

// Oturumu başlat
session_start();

// Tüm oturum verilerini temizle
$_SESSION = array();

// Çerezi temizle
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), '', time()-42000, '/');
}

// Oturumu sonlandır
session_destroy();

// Ana sayfaya yönlendir
header("Location: index.php");
exit();
?>