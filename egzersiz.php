<?php
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="egzersiz.css">
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

    <div class="main-container">
        <h1>Nefes Egzersizi</h1>
        <p class="subtitle">Derin nefes alarak rahatlayın ve anın tadını çıkarın</p>

        <div class="breathing-container">
            <div class="circle">
                <div class="inner-circle">
                    <span class="breathing-text">Hazır mısın?</span>
                </div>
                <div class="dot" id="dot"></div>
            </div>
        </div>

        <div class="instructions" id="instruction">
            <p>Rahatlamak ve zihnini temizlemek için nefes egzersizine başla</p>
        </div>

        <button id="startBtn">Haydi Başlayalım</button>

        <div class="info-box">
            <div class="info-item">
                <i class="fas fa-heart"></i>
                <span>Stres seviyenizi azaltır</span>
            </div>
            <div class="info-item">
                <i class="fas fa-brain"></i>
                <span>Odaklanmanızı artırır</span>
            </div>
            <div class="info-item">
                <i class="fas fa-bed"></i>
                <span>Daha iyi uyku sağlar</span>
            </div>
        </div>
    </div>


    <script src="egzer.js"></script>
</body>
</html>