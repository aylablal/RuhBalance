<?php
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuhBalance Blog</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
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

    <section class="home swiper" id="home">
        <div class="swiper-wrapper">
            <div class="swiper-slide container">
                <img src="yoga.jpg" alt="">
                <div class="slide-overlay"></div>
                <div class="home-text">
                    <span class="subtitle animate-slide">Ruh ve Beden Uyumunu Keşfedin</span>
                    <h1 class="animate-slide">Yoga ile İç Huzurunuzu Bulun</h1>
                    <p class="description animate-slide">Günlük yaşamın stresinden uzaklaşın, yoga teknikleriyle kendinizi yenileyin</p>
                    <a href="yoga.php" class="btn animate-slide">İncele</a>
                </div>
            </div>

            <div class="swiper-slide container">
                <img src="doğa.jpg" alt="">
                <div class="slide-overlay"></div>
                <div class="home-text">
                    <span class="subtitle animate-slide">Doğayla Bütünleşin</span>
                    <h1 class="animate-slide">Doğanın Şifa Gücünü Hissedin</h1>
                    <p class="description animate-slide">Doğal yaşamın sırlarını keşfedin, sağlıklı bir yaşam için ipuçları edinin</p>
                    <a href="blog.php" class="btn animate-slide">İncele</a>
                </div>
            </div>

            <div class="swiper-slide container">
                <img src="sağlık.jpg" alt="">
                <div class="slide-overlay"></div>
                <div class="home-text">
                    <span class="subtitle animate-slide">Sağlıklı Yaşam</span>
                    <h1 class="animate-slide">Bütünsel Sağlık Yaklaşımı</h1>
                    <p class="description animate-slide">Fiziksel ve ruhsal sağlığınız için uzman tavsiyeleri ve pratik çözümler</p>
                    <a href="blog.php" class="btn animate-slide">İncele</a>
                </div>
            </div>

            <div class="swiper-slide container">
                <img src="matcha.jpg" alt="">
                <div class="slide-overlay"></div>
                <div class="home-text">
                    <span class="subtitle animate-slide">Beslenme & Detoks</span>
                    <h1 class="animate-slide">Doğal Beslenme Sırları</h1>
                    <p class="description animate-slide">Vücudunuzu temizleyen, enerji veren süper gıdalar ve detoks önerileri</p>
                    <a href="blog.php" class="btn animate-slide">İncele</a>
                </div>
            </div>
        </div>

        <div class="swiper-pagination"></div>
    </section>

    <section class="places" id="places">
        <div class="heading">
            <span class="section-subtitle">Yoga Teknikleri</span>
            <h1>Birlikte Yoga Tekniklerine <br>Göz Gezdirelim</h1>
            <p class="section-description">Her seviyeden yoga severin keşfedebileceği teknikleri sizlerle buluşturuyoruz</p>
        </div>
        <div class="places-container">
            <div class="box">
                <div class="place-img">
                    <img src="yoga1.jpg" alt="">
                    <div class="overlay">
                        <h3>Hatha Yoga</h3>
                        <p>Temel pozlar</p>
                    </div>
                </div>
              
            </div>

            <div class="box">
                <div class="place-img">
                    <img src="yoga2.jpg" alt="">
                    <div class="overlay">
                        <h3>Vinyasa Flow</h3>
                        <p>Akışkan hareketler</p>
                    </div>
                </div>
               
            </div>

            <div class="box">
                <div class="place-img">
                    <img src="yoga3.jpg" alt="">
                    <div class="overlay">
                        <h3>Ashtanga</h3>
                        <p>Güçlü pratikler</p>
                    </div>
                </div>
                
            </div>

            <div class="box">
                <div class="place-img">
                    <img src="yoga4.jpg" alt="">
                    <div class="overlay">
                        <h3>Yin Yoga</h3>
                        <p>Derin gevşeme</p>
                    </div>
                </div>
               
            </div>
        </div>
    </section>

    <section class="about" id="about">
        <div class="about-text">
            <span class="section-subtitle">Hakkımızda</span>
            <h1>Bizim Hakkımızda Bilgi<br>Edinmek İçin</h1>
            <p>Aşağıdaki linke tıklayarak hakkımızdaki bilgilere ulaşabilirsiniz. 
            <br>Bizi sosyal medya hesaplarımızdan takip edebilirsiniz.<br></p>
            <a href="hakkimizda.php" class="btn">İncelemeye Başla</a>
        </div>

    </section>

    <section class="footer">
        <div class="footer-box">
            <h2>RuhBalance</h2>
            <p>Bizi sosyal medya hesaplarımızdan takip et ipuçlarını yakala hayata odaklan !</p>

            <div class="social">
                <a href="https://www.instagram.com/ruhbalance/"><i class='bx bxl-instagram'></i></a>
            </div>
        </div>
    </section>

    <div class="copyright">
    <p>&#169; RuhBalance Tüm Hakları Saklıdır.</p>
    </div>

    <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>
    <script src="app.js"></script>
</body>

</html>