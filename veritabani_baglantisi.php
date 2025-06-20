<?php


header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');



$servername = "localhost";
$username = "u165807241_ayla";
$password = "aylaKesan22";
$dbname = "u165807241_ruhbalance";


// Veritabanı bağlantısını oluştur
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Veritabanı bağlantı hatası: " . $e->getMessage();
    die();
}