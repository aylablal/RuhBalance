<?php
header('X-Frame-Options: SAMEORIGIN');
header('X-Content-Type-Options: nosniff');

?>



<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RuhBalance İletişim</title>
    <link rel="stylesheet" href="styyle.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <header>
        <a href="index.php" class="logo">RuhBalance</a>
        <ul class="navbar">
            <li><a href="index.php" class="home-active">Anasayfa</a></li>
            <li><a href="hakkimizda.php">Hakkımızda</a></li>
            <li><a href="yoga.php">Yoga</a></li>
            <li><a href="blog.php">Blog</a></li>
            <li>
                <a href="">İletişim <i class="fa fa-caret-down"></i></a>
                <ul class="dropdown">
                    <li><a href="uye_ol.php">Üye Ol / Giriş Yap</a></li>
                    <li><a href="bizidegerlendir.php">Bizi Değerlendir</a></li>
                </ul>
            </li>
        </ul>
    </header>

    <div class="container">
        <div class="background-elements">
            <div class="floating-circle circle-1"></div>
            <div class="floating-circle circle-2"></div>
            <div class="floating-circle circle-3"></div>
            <div class="wave-bg"></div>
        </div>
        
        <div class="form">
            <div class="contact-info">
                <div class="info-header">
                    <h3 class="title">Bizimle İletişime Geçin</h3>
                    <p class="text">Sağlıklı vücut için hadi bizimle iletişime geç!</p>
                </div>
                
                <div class="info-cards">
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div class="info-content">
                            <h4>Adres</h4>
                            <p>Teşvikiye<br>34365 Şişli/İstanbul</p>
                        </div>
                    </div>
                    
                    <div class="info-card">
                        <div class="info-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="info-content">
                            <h4>Email</h4>
                            <p><a href="mailto:ruhbalance@gmail.com" class="email-link">ruhbalance@gmail.com</a></p>
                        </div>
                    </div>
                    
                </div>
                
                <div class="social-media">
                    <div class="social-icons">
                        <a href="https://www.instagram.com/ruhbalance/" class="social-icon">
                            <i class="fab fa-instagram"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="contact-form">
                <div class="form-decoration">
                    <span class="circle one"></span>
                    <span class="circle two"></span>
                    <span class="circle three"></span>
                </div>
                
                <form action="iletisim_kaydet.php" method="POST" id="contactForm">
                    <h3 class="title">İletişim Formu</h3>
                    
                    <div class="input-group">
                        <div class="input-container">
                            <input type="text" name="name" class="input" required>
                            <label>Adınız Soyadınız</label>
                            <span class="focus-border"></span>
                        </div>
                        
                        <div class="input-container">
                            <input type="email" name="email" class="input" required>
                            <label>Email Adresiniz</label>
                            <span class="focus-border"></span>
                        </div>
                    </div>
                    
                    <div class="input-container">
                        <input type="tel" name="phone" class="input" required>
                        <label>Telefon Numaranız</label>
                        <span class="focus-border"></span>
                    </div>
                    
                    <div class="input-container textarea">
                        <textarea name="message" class="input" required></textarea>
                        <label>Mesajınız</label>
                        <span class="focus-border"></span>
                    </div>
                    
                    <div id="error-message" class="error-message" style="display: none;">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Mesajınızda uygunsuz kelimeler bulunmaktadır. Lütfen düzenleyiniz.</span>
                    </div>
                    
                    <div id="success-message" class="success-message" style="display: none;">
                        <i class="fas fa-check-circle"></i>
                        <span>Mesajınız başarıyla gönderildi!</span>
                    </div>
                    
                    <button type="submit" class="btn">
                        <span class="btn-text">Mesaj Gönder</span>
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script src="iletisim.js"></script>
</body>
</html>