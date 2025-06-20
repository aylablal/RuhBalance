<?php


header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');


ini_set('session.gc_maxlifetime', 86400); // 1 gün (saniye olarak)
ini_set('session.cookie_lifetime', 86400); // 1 gün (saniye olarak)

// Oturum başlat (henüz başlamadıysa)
if (session_status() === PHP_SESSION_NONE) {
    session_start([
        'cookie_lifetime' => 86400,
        'gc_maxlifetime' => 86400,
        'cookie_secure' => true, 
        'cookie_httponly' => true,
        'use_strict_mode' => true
    ]);
}

// Oturum çerezini yenile (her sayfada oturum süresini uzatmak için)
if (isset($_COOKIE[session_name()])) {
    setcookie(session_name(), $_COOKIE[session_name()], time() + 86400, '/');
}