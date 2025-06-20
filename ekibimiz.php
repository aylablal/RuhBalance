<?php
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
?>


<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuhBalance - Ekibimiz</title>
    <link rel="stylesheet" href="ekib.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />

</head>
<body>
    <header>
        <a href="index.php" class="logo"> RuhBalance</a>
        <div class="bx bx-menu" id="menu-icon"><i class="fas fa-bars"></i></div>
        <ul class="navbar">
            <li><a href="index.php" class="home-active">Anasayfa</a></li>
            <li><a href="hakkimizda.php">Hakkımızda</a></li>
            <li><a href="yoga.php">Yoga</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li><a href="iletişim.php">İletişim</a></li>
        </ul>
    </header>

    <!-- Team Section -->
    <section class="team-section">
        <div class="container">
            <h2 class="section-title">Ekibimiz</h2>
            
            <div class="card-list">
                <!-- Team Member 1 -->
                <div class="card-item">
                    <img src="img1.jpg" alt="Ayla Bilal" class="user-image">
                    <h3 class="user-name">Ayla Bilal</h3>
                    <p class="user-profession">Front-End Developer</p>
                    <div class="social-links">
                       <a href="https://github.com/aylablal" class="social-link github" target="_blank" rel="noopener noreferrer"><i class="fab fa-github"></i></a>
                    </div>
                </div>
                
                <!-- Team Member 2 -->
                <div class="card-item">
                    <img src="img2.jpg" alt="Zeynep Keşanoğlu" class="user-image">
                    <h3 class="user-name">Zeynep Keşanoğlu</h3>
                    <p class="user-profession">Front-End Developer</p>
                    <div class="social-links">
                        <a href="https://github.com/zynpksnoglu" class="social-link github"><i class="fab fa-github"></i></a>
                    </div>
                </div>
                
                <!-- Team Member 3 -->
                <div class="card-item">
                    <img src="img3.jpg" alt="Arda Güler" class="user-image">
                    <h3 class="user-name">Arda Güler</h3>
                    <p class="user-profession">Front-End Developer</p>
                    <div class="social-links">
                        <a href="https://github.com/ardagulerr" class="social-link github"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer">
            <div class="footer-box">
                <h2>RuhBalance</h2>
                <p>Bizi sosyal medya hesaplarımızdan takip et ipuçlarını yakala hayata odaklan!</p>
                <div class="social">
                    <a href="https://www.instagram.com/ruhbalance/"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="copyright">
            <p>© RuhBalance Tüm Haklari Saklidir.</p>
        </div>
    </footer>
    
    <script src="ekib.js"></script>
</body>
</html>