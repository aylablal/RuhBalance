<?php
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuhBalance Yoga</title>
    <link rel="stylesheet" href="stylles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
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

    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Blog</h1>
            <p>Denge, Huzur ve Sağlıklı Yaşam İçin İpuçları</p>
        </div>
    </div>

    <section class="blog-posts" id="places">
        <div class="container">
            <div class="blog-grid">
                <div class="blog-card">
                    <div class="blog-img">
                        <img src="bilmem.jpg" alt="Türk Hekimler" loading="lazy">
                        <div class="blog-date"><span>10</span>May</div>
                    </div>
                    <div class="blog-content">
                        <span class="feature-tag">Öne Çıkan</span>
                        <h3>Türk Hekimlerde Yoga ile Tükenmişlikten Kurtulma</h3>
                        <p>Bir çalışmada, Türk hekimlerinin Sudarshan Kriya Yoga (SKY) uygulamaları sayesinde tükenmişlik sendromu, stres, depresyon ve uykusuzluğu büyük ölçüde azalttığı ortaya çıktı. Yoga, sağlık çalışanlarının ruhsal ve fiziksel sağlığını iyileştirerek, zorlu meslek hayatlarında denge bulmalarına yardımcı oldu.</p>
                    </div>
                </div>

                <div class="blog-card">
                    <div class="blog-img">
                        <img src="yürü.jpg" alt="Doğa Yürüyüşleri" loading="lazy">
                        <div class="blog-date"><span>14</span>May</div>
                    </div>
                    <div class="blog-content">
                        <h3>İstanbul'da Bu Ay Kaçırmaman Gereken Doğa Yürüyüşleri</h3>
                        <p>Nisan ayı doğanın uyanış zamanı! İstanbulda Belgrad Ormanı'nda sessiz bir yürüyüş, Polonezköy'de kuş sesleriyle dolu patikalar, Atatürk Arboretumu'nda renk çümbüşü... Haftada bir gününü doğaya ayır; zihnin yavaşlasın, bedenin dinlensin. Yanına bir termos çay ve bir hırka almayı da unutma.</p>
                    </div>
                </div>

                <div class="blog-card">
                    <div class="blog-img">
                        <img src="sahil.jpg" alt="Yoga Pozları" loading="lazy">
                        <div class="blog-date"><span>12</span>May</div>
                    </div>
                    <div class="blog-content">
                        <h3>Yeni Başlayanlar İçin 5 Basit Yoga Pozu</h3>
                        <p>Yoga karmaşık olmak zorunda değil. Yeni başlayanlar için oldukça basit pozisyonlar var bunlar: çocuk pozu, ağaç pozu, köprü pozu gibi. Sende hemen yoga sayfamızdan bu hareketlere bakıp yapmaya başla, sadece 10 dakikanı ayırman yeterli.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="wellness-recipes">
        <div class="container">
            <div class="section-header">
                <h2>Sağlıklı Tarifler</h2>
                <p class="subtitle">Beden ve zihin sağlığınız için özel tarifler</p>
            </div>
            
            <div class="recipe-box">
                <div class="recipe-content">
                    <h3>Huzur Veren Gece İçeceği</h3>
                    <p class="recipe-quote">"Gecenin içinden geçerken, kendine bir fincan huzur ver."</p>
                    <p>Bazı akşamlar uykuya dalmakta zorlanırsın. Zihnin susmaz, bedenin yorgun olsada zihnin hala seninle tartışıyordur. İşte bu tarif tam o gecelere özel:</p>
                    <div class="recipe-ingredients">
                        <h4>Malzemeler:</h4>
                        <ul>
                            <li>1 su bardağı bitkisel süt (tercih tamamen sana ait)</li>
                            <li>1 çay kaşığı toz zerdeçal</li>
                            <li>1 çay kaşığı tarçın</li>
                            <li>1 tatlı kaşığı bal</li>
                        </ul>
                    </div>
                    <div class="recipe-instructions">
                        <h4>Hazırlanışı:</h4>
                        <p>Tüm malzemeleri ufak bir tencereye al ve ısıt, dikkat et kaynamasın!</p>
                    </div>
                    <div class="recipe-benefits">
                        <p>Zerdeçal iltihap sökücü, tarçın sakinleştirici. Bu içecek sadece uyumana değil, içsel olarak yumuşamana da yardımcı olur. Yanında loş bir ışık ve biraz da lo-fi müzik.</p>
                    </div>
                </div>
                <div class="recipe-image">
                    <img src="su.jpg" alt="Huzur Veren Gece İçeceği" loading="lazy">
                </div>
            </div>
            
            <div class="recipe-box reverse">
                <div class="recipe-image">
                    <img src="su.jpg" alt="Enerji Topları" loading="lazy">
                </div>
                <div class="recipe-content">
                    <h3>Enerji Veren Atıştırmalık Toplar</h3>
                    <p class="recipe-quote">"Bir ısırık, biraz enerji, bir gülümseme."</p>
                    <p>Modun düşükse, gün içinde enerjin düşmeye başladıysa ama tatlıya da yönelmek istemiyorsan bu tarif tam senlik!</p>
                    <div class="recipe-ingredients">
                        <h4>Malzemeler:</h4>
                        <ul>
                            <li>1 su bardağı yulaf</li>
                            <li>5 adet hurma (suda beklet biraz yumuşasın)</li>
                            <li>2 yemek kaşığı fıstık ezmesi</li>
                            <li>1 yemek kaşığı kakao</li>
                            <li>1 çay kaşığı tarçın</li>
                            <li>Hindistan cevizi (topçuk yapıp bulamak için rendesi)</li>
                        </ul>
                    </div>
                    <div class="recipe-instructions">
                        <h4>Hazırlanışı:</h4>
                        <p>Tüm malzemeleri rondoda çek. Hafif yapışkan bir kıvam elde ettikten sonra küçük toplar yap, hindistan cevizine bulayıp buzdolabında dinlendir. 15-20 dakika sonra yemeğe hazır.</p>
                    </div>
                    <div class="recipe-benefits">
                        <p>Hurma tatlı krizini bastırır, kakao serotonin seviyesini artırır. Küçük ama mutlu eden lokmalar bunlar.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="events-section">
        <div class="container">
            <div class="section-header">
                <h2>İstanbul'da Yoga Etkinlikleri</h2>
                <p class="subtitle">Hadi birlikte inceleyelim</p>
            </div>
            
            <div class="events-grid">
                <div class="event-card">
                    <div class="event-icon">
                        <i class='bx bx-sun'></i>
                    </div>
                    <div class="event-details">
                        <h3>Gün Doğumu Yogası - Fenerbahçe Parkı</h3>
                        <p>Haftanın belirli günleri sabah saat 06.30'da deniz manzaralı çim alanda yapılan bu etkinlik, gün doğumunun huzur verici etkisiyle yoga yapma imkanı sunuyor. Katılım ücretsiz, matınızı getirmeniz yeterli.</p>
                    </div>
                </div>
                
                <div class="event-card">
                    <div class="event-icon">
                        <i class='bx bx-buildings'></i>
                    </div>
                    <div class="event-details">
                        <h3>Rooftop Yoga - Nişantaşı Terrace</h3>
                        <p>Her cumartesi akşamı 18.30'da başlayan bu etkinlik, gün batımında şehir manzarası eşliğinde yoga deneyimi sunuyor. Kontenjan sınırlı, online kayıt gereklidir.</p>
                    </div>
                </div>
                
                <div class="event-card">
                    <div class="event-icon">
                        <i class='bx bx-headphone'></i>
                    </div>
                    <div class="event-details">
                        <h3>Sessiz Yoga (Silent Yoga) - Bebek Sahili</h3>
                        <p>Katılımcılara bluetooth kulaklık verilir, müzik ve eğitmen sesi kulaklıkta dinlenir. Özellikle dikkat dağınıklığı yaşayanlar için önerilir. Kayıt zorunludur, sınırlı kontenjanlıdır.</p>
                    </div>
                </div>
                
                <div class="event-card">
                    <div class="event-icon">
                        <i class='bx bx-water'></i>
                    </div>
                    <div class="event-details">
                        <h3>Vinyasa Flow Yoga - Akasya Açık Alan Etkinlikleri</h3>
                        <p>Nisan-Ekim ayları boyunca her hafta perşembe günü açık alanda gerçekleşir. Her seviyeye açık, su ve mat getirilmesi önerilir. Katılım ücretsizdir.</p>
                    </div>
                </div>
            </div>
            
            <div class="cta-center">
                <a href="nasılhissediyorum.php" class="btn-go">Bugün Nasıl Hissediyorsun?</a>
            </div>
        </div>
    </section>

    <section class="sleep-wellness">
        <div class="container">
            <div class="wellness-grid">
                <div class="wellness-content">
                    <h2>Bahar Döneminde Uyku</h2>
                    <p class="feature-quote">Daha iyi bir uyku için neler yapmalıyız?</p>
                    
                    <p>Bahar uykusu terimi, kışın soğuk günlerinin ardından gelen ılıman hava ile birlikte insanlar üzerinde gözlemlenen uyku değişimlerini tanımlar. İyi bir uyku, sağlıklı bir yaşamın temeli olduğu için, bu dönemde uyku düzenini iyileştirmek oldukça önemlidir.</p>
                    
                    <h3>Bahar Uykusunu Yönetmenin Yolları</h3>
                    
                    <div class="tips-list">
                        <div class="tip-item">
                            <span class="tip-title">Günlük Uyku Rutini Oluşturun:</span>
                            <p>Yatış ve kalkış saatlerinizi sabit tutarak vücudunuzun biyolojik ritmini düzenli hale gelmesini sağlayabilirsiniz.</p>
                        </div>
                        
                        <div class="tip-item">
                            <span class="tip-title">Uyku Öncesi Rahatlatıcı Aktiviteler:</span>
                            <p>Yatmadan önce hafif meditasyon, yoga, sıcak duş uykuya geçişi kolaylaştırabilir. Yoga Hareketleri için menüde bulunan yoga kategorisinden yoga pozlarına ulaşabilirsiniz.</p>
                        </div>
                        
                        <div class="tip-item">
                            <span class="tip-title">Bedeninizi Dinleyin Ve Zihninizi Sakinleştirin:</span>
                            <p>Günlük stres, kaygı veya endişeler uyku kalitesini olumsuz etkileyebilir. Bu nedenle zihinsel rahatlama, uyku düzenini olumlu yönde etkiler. Bunlardan biri meditasyon zihninizi sakinleştirerek uykuya geçişi kolaylaştırır. Bir diğeri ise nefes egzersizidir derin nefes almak, bedeni gevşetir ve uykuya geçişi hızlandırır.</p>
                        </div>
                    </div>
                    
                    <p class="cta-text"><strong>Aşağıdaki kutucuğa tıklayarak nefes egzersizi sayfamıza göz atabilir ve nefes egzersizinizi buradan yapabilirsiniz.</strong></p>
                    
                    <a href="egzersiz.php" class="btn-go">Nefes Egzersizine Başla</a>
                </div>
                
                <div class="wellness-image">
                    <img src="uyku.jpg" alt="Bahar ve Uyku" loading="lazy">
                </div>
            </div>
        </div>
    </section>
    
    <!-- playlist spotify -->
    <section class="mood-playlist-section">
        <div class="container">
            <div class="section-header">
                <h2>Sporify şarkı önerisi</h2>
                <p class="subtitle">Kendini müziğin huzuruna bırak</p>
            </div>
            
          
            <div class="playlist-container" id="playlistContainer">
                <div class="playlist-loading" id="playlistLoading">
                    <div class="loading-spinner"></div>
                </div>
                <iframe id="spotifyPlayer"
                    style="border-radius:12px" 
                    src="https://open.spotify.com/embed/playlist/37i9dQZF1DX3Ogo9pFvBkY?utm_source=generator&theme=0" 
                    width="100%" 
                    height="380" 
                    frameBorder="0" 
                    allowfullscreen="" 
                    allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" 
                    loading="lazy">
                </iframe>
            </div>
        </div>
    </section>

    <section class="footer">
        <div class="footer-box">
            <h2>RuhBalance</h2>
            <p>Bizi sosyal medya hesaplarimizdan takip et ipuçlarini yakala hayata odaklan!</p>

            <div class="social">
                <a href="https://www.instagram.com/ruhbalance/" aria-label="Instagram"><i class='bx bxl-instagram'></i></a>
            </div>
        </div>
    </section>

    <div class="copyright">
        <p>&#169; RuhBalance Tüm Haklari Saklidir.</p>
    </div>

    <script src="blog.js"></script>
</body>
</html>