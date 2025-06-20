<?php
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Bizi Değerlendirin</title>
    <link rel="stylesheet" href="degerlendir.css">
</head>
<body>
    <header>
        <a href="index.php" class="logo">RuhBalance</a>
        <div class="bx bx-menu" id="menu-icon"></div>
        
        <ul class="navbar">
            <li><a href="index.php" class="home-active">Anasayfa</a></li>
            <li><a href="hakkimizda.php">Hakkımızda</a></li>
            <li><a href="yoga.php">Yoga</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="iletişim.php">İletişim</a></li>
        </ul>
    </header>
    
    <div class="wrapper">
        <h3>Fikirlerinizi bizimle paylaşın.</h3>
        
        <form action="degerlendir.php" method="POST">
            <div class="rating">
                <input type="number" name="rating" hidden>
                <i class='bx bx-star star' style="--i:0;"></i>
                <i class='bx bx-star star' style="--i:1;"></i>
                <i class='bx bx-star star' style="--i:2;"></i>
                <i class='bx bx-star star' style="--i:3;"></i>
                <i class='bx bx-star star' style="--i:4;"></i>
            </div>
            <textarea name="opinion" cols="30" rows="5" placeholder="Yorumunuzu buraya yazın..."></textarea>
            <div class="btn-group">
                <button type="submit" class="btn submit">Gönder</button>
                <button type="button" class="btn cancel" onclick="window.location.href='index.php'">Vazgeç</button>
            </div>
        </form>
    </div>
    
    <script src="degerlendir.js"></script>
</body>
</html>