<?php

header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>RuhBalance Hakkimizda</title>
    <link rel="stylesheet" href="styles.css">
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
    <section class="about">
        <div class="content">
            <img src="ruhbalance.jpg" alt="">
            <div class="text">
                <h1>Hakkımızda</h1>
             <p>RuhBalance insanların anlık ruh hallerine göre tavsiyeler alabileceği yaşadığı ruh halinde ona en iyi gelicek şekilde geri dönüşler alıp,çeşitli meditasyon,yoga ve benzeri hareketler hakkında bilgi alıp aldığı bu bilgileri de anlık olarak insanlarla paylaştığı bir web sitesidir.</p>


             <a href="ekibimiz.php">
                <button>Ekip Arkadaşlarımızı Tanımak İçin Lütfen Tıklayınız...</button>
            </a>
            </div>
        </div>
    </section>






<script src="hakkimizda.js"></script>

</body>

</html>