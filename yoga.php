<?php

header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuhBalance Yoga</title>
    <link rel="stylesheet" href="styleess.css">
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

    <section class="places" id="places">
        <div class="heading">
            <h1>Birlikte Yoga Tekniklerine <br>Göz Gezdirelim</h1>
        </div>
        <div class="places-container">
            <div class="box" data-id="yoga1">
                <div class="place-img">
                    <img src="yoga1.jpg" alt="Yoga Teknikleri 1">
                    <div class="favorite-btn">
                        <i class='bx bx-heart'></i>
                    </div>
                </div>
                <div class="place-text">
                    <h3>Esneme Pozu</h3>
                    <p>Bu görseldeki birey esneme odaklı hareketler yapıyor. Bu tarz pozlar genellikle omurga, bacak kasları ve zihinsel odaklanmayı arttırmak içindir.</p>
                </div>
            </div>

            <div class="box" data-id="yoga2">
                <div class="place-img">
                    <img src="yoga2.jpg" alt="Yoga Teknikleri 2">
                    <div class="favorite-btn">
                        <i class='bx bx-heart'></i>
                    </div>
                </div>
                <div class="place-text">
                    <h3>Aşağı Bakan Köpek</h3>
                    <p>Bu poz aşağı bakan köpek pozisyonudur. Temel yoga pozlarından biridir. Omuzları ve bacakları esnetirken zihinsel bir sakinlik sağlar.</p>
                </div>
            </div>

            <div class="box" data-id="yoga3">
                <div class="place-img">
                    <img src="yoga3.jpg" alt="Yoga Teknikleri 3">
                    <div class="favorite-btn">
                        <i class='bx bx-heart'></i>
                    </div>
                </div>
                <div class="place-text">
                    <h3>Savaşçı Pozu</h3>
                    <p>Bu poz Savaşçı Pozudur. Duruş ve dengeyi geliştirmek için sıkça kullanılır.</p>
                </div>
            </div>

            <div class="box" data-id="yoga4">
                <div class="place-img">
                    <img src="yoga4.jpg" alt="Yoga Teknikleri 4">
                    <div class="favorite-btn">
                        <i class='bx bx-heart'></i>
                    </div>
                </div>
                <div class="place-text">
                    <h3>Ses Kasesi</h3>
                    <p>Bu görselde ses kasesi görüyoruz, meditasyon ve rahatlama sırasında kullanılan bir araçtır. Derin rahatlama sağlar.</p>
                </div>
            </div>

            <div class="box" data-id="yoga5">
                <div class="place-img">
                    <img src="yoga5.jpg" alt="Yoga Teknikleri 5">
                    <div class="favorite-btn">
                        <i class='bx bx-heart'></i>
                    </div>
                </div>
                <div class="place-text">
                    <h3>Çocuk Pozu</h3>
                    <p>Bu poz Çocuk Pozu olarak geçer ve yoga seansları sonunda gevşeme ve dinlenme için uygulanır.</p>
                </div>
            </div>

            <div class="box" data-id="yoga6">
                <div class="place-img">
                    <img src="yoga6.jpg" alt="Yoga Teknikleri 6">
                    <div class="favorite-btn">
                        <i class='bx bx-heart'></i>
                    </div>
                </div>
                <div class="place-text">
                    <h3>Güç Yoga</h3>
                    <p>Bu teknik, dayanıklılığı artırmaya yönelik yoğun hareketlerden oluşur.</p>
                </div>
            </div>

            <div class="box" data-id="yoga7">
                <div class="place-img">
                    <img src="yoga7.jpg" alt="Yoga Teknikleri 7">
                    <div class="favorite-btn">
                        <i class='bx bx-heart'></i>
                    </div>
                </div>
                <div class="place-text">
                    <h3>Havada Yoga</h3>
                    <p>Bu poz havada yogadır. Esneklik, denge ve güç geliştirmek için etkilidir ayrıca omurgayı rahatlatmaya yardımcı olur.</p>
                </div>
            </div>

            <div class="box" data-id="yoga8">
                <div class="place-img">
                    <img src="yoga8.jpg" alt="Yoga Teknikleri 8">
                    <div class="favorite-btn">
                        <i class='bx bx-heart'></i>
                    </div>
                </div>
                <div class="place-text">
                    <h3>Ters Duruş</h3>
                    <p>Bu poz Ters Duruş pozudur. Bu poz kan dolaşımını arttırır ve konsantrasyonu güçlendirir ve denge hissini geliştirir.</p>
                </div>
            </div>

            <div class="box" data-id="yoga9">
                <div class="place-img">
                    <img src="yoga9.jpg" alt="Yoga Teknikleri 9">
                    <div class="favorite-btn">
                        <i class='bx bx-heart'></i>
                    </div>
                </div>
                <div class="place-text">
                    <h3>Zihinsel Rahatlama</h3>
                    <p>Bu duruş zihinsel berraklık ve rahatlama için idealdir.</p>
                </div>
            </div>

            <div class="box" data-id="yoga10">
                <div class="place-img">
                    <img src="yoga10.jpg" alt="Yoga Teknikleri 10">
                    <div class="favorite-btn">
                        <i class='bx bx-heart'></i>
                    </div>
                </div>
                <div class="place-text">
                    <h3>Kobra Pozu</h3>
                    <p>Bu poz kobra pozuna benzer bir hareket yapılmıştır. Bu poz omurgayı güçlendirmek, sırt kaslarını çalıştırmak ve göğüs bölgesini açmak için uygundur.</p>
                </div>
            </div>
        </div>
    </section>
    
    <section class="favorites-section" id="favorites">
        <div class="favorites-header">
            <h2>Favori Yoga Pozlarınız</h2>
            <button class="clear-favorites">Favorileri Temizle</button>
        </div>
        <div class="favorites-container">
            <div class="no-favorites">Henüz favori yoga pozu eklemediniz.</div>
        </div>
    </section>


    <section class="about" id="about">
        <div class="about-text">
            <h1>🧘‍♀️ Yoga Nedir?</h1>
            <p>Yoga, beden, zihin ve ruh arasındaki dengeyi sağlamak amacıyla yapılan fiziksel, zihinsel ve nefes teknikleri içeren bir pratiktir.</p>
            <p>Düzenli yoga yapmak, esneklik, güç ve dengeyi artırırken, stresin azalmasına ve zihinsel netliğin artmasına yardımcı olur. 🧘‍♂️🧠✨</p>
            <p>Ayrıca, nefes kontrolü ve meditasyon teknikleri sayesinde, genel sağlığı iyileştirir, rahatlama sağlar ve duygusal dengeyi güçlendirir.</p>
            
            <h1>Yoga'nın Tarihçesi</h1>
            <p>Yoga, yaklaşık olarak 5.000 yıl öncesin Hindistan'a dayanır. İlk kez Vedik metinlerde ve çeşitli kutsal kitaplarda yer almıştır.</p>
            <p>Zamanla felsefi okullar ve öğretilerle şekillenmiştir. Modern yoga 19. yüzyıl sonlarında Hindistan'dan Batı'ya yayılmaya başlamış ve günümüzde dünya çapında popüler bir hal almıştır.</p>
        </div>

        <div class="about-img">
            <img src="namaste.jpg" alt="Yoga Meditation">
        </div>
    </section>

    <section class="footer">
        <div class="footer-box">
            <h2>RuhBalance</h2>
            <p>Bizi sosyal medya hesaplarımızdan takip et, ipuçlarını yakala hayata odaklan!</p>

            <div class="social">
                <a href="#"><i class='bx bxl-instagram'></i> Instagram</a>
                <a href="https://www.youtube.com/watch?v=X3-gKPNyrTA" target="_blank">
                    <i class='bx bxl-youtube'></i> Video 1
                </a>
                <a href="https://www.youtube.com/watch?v=WKK84yEBZoo" target="_blank">
                    <i class='bx bxl-youtube'></i> Video 2
                </a>
            </div>
        </div>
    </section>

    <div class="copyright">
        <p>&#169; RuhBalance Tüm Hakları Saklıdır.</p>
    </div>


    <div class="show-favorites-btn">
        <i class='bx bxs-heart'></i>
        <span class="count">0</span>
    </div>

    <div class="toast" id="toast"></div>
    <script src="yoga.js"></script>
</body>
</html>