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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: "Poppins", sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            list-style: none;
            text-decoration: none;
            scroll-padding-top: 2rem;
            scroll-behavior: smooth;
        }

        :root {
            --text-color: #021f2a;
            --bg-color: #fff;
        }

        html::-webkit-scrollbar {
            width: 0.5rem;
        }

        html::-webkit-scrollbar-track {
            background: transparent;
        }

        html::-webkit-scrollbar-thumb {
            background: var(--text-color);
            border-radius: 5rem;
        }

        section {
            padding: 50px 100px;
        }

        header {
            position: fixed;
            width: 100%;
            top: 0;
            right: 0;
            z-index: 1000;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 30px 100px;
            transition: 0.5s;
            background: #B395D4;
            height: 149px;
        }

        header.shadow {
            background: #D6CDEA;
        }

        header.shadow .logo {
            color: var(--bg-color);
            box-shadow: 0 0 4px rgb(14 55 54 / 15%);
        }

        header.shadow .navbar a {
            color: var(--bg-color);
        }

        header.shadow .navbar a::after {
            background: var(--bg-color);
        }

        .logo {
            font-size: 1rem;
            font-weight: 600;
            color: var(--bg-color);
        }

        .navbar {
            display: flex;
            column-gap: 5rem;
        }

        .navbar li {
            position: relative;
        }

        .navbar a {
            font-size: 1rem;
            font-weight: 500;
            color: var(--bg-color);
        }

        .navbar a::after {
            content: '';
            width: 0%;
            height: 2px;
            background: var(--bg-color);
            position: absolute;
            bottom: -4px;
            left: 0;
            transition: 0.4s;
        }

        .navbar a:hover::after,
        .navbar .home-active::after {
            width: 100%;
        }

        #menu-icon {
            font-size: 24px;
            cursor: pointer;
            z-index: 100001;
            display: none;
            color: var(--bg-color);
        }

        body {
            margin-top: 149px;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 40px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            margin-bottom: 40px;
        }

        h1 {
            font-size: 2.5em;
            margin-bottom: 20px;
            color: #333;
            background: linear-gradient(45deg, #B395D4, #D6CDEA);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        p {
            font-size: 1.2em;
            margin-bottom: 30px;
            color: #666;
        }

        form label {
            display: block;
            font-size: 1.3em;
            margin: 20px 0;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        form label:hover {
            background: #e9ecef;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        form label:has(input:checked) {
            background: #B395D4;
            color: white;
            border-color: #9575cd;
        }

        input[type="radio"] {
            margin-right: 10px;
            transform: scale(1.2);
        }

        button {
            background: linear-gradient(45deg, #B395D4, #D6CDEA);
            color: white;
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            cursor: pointer;
            font-size: 1.2em;
            font-weight: 600;
            transition: all 0.3s ease;
            margin-top: 20px;
            box-shadow: 0 8px 25px rgba(179, 149, 212, 0.3);
        }

        button:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 35px rgba(179, 149, 212, 0.4);
        }

        button:active {
            transform: translateY(-1px);
        }

        .result-box {
            margin-top: 30px;
            padding: 30px;
            border-radius: 20px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
            text-align: center;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.8s ease;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .result-box.fade-in {
            opacity: 1;
            transform: translateY(0);
        }

        .result-box img {
            width: 120px;
            height: 120px;
            margin-bottom: 20px;
            border-radius: 50%;
            border: 4px solid rgba(255,255,255,0.3);
            object-fit: cover;
        }

        .result-box h3 {
            margin: 15px 0 10px;
            font-size: 1.8em;
            color: white;
        }

        .result-box p {
            font-size: 1.1em;
            color: rgba(255,255,255,0.9);
            line-height: 1.6;
        }

        .istatistik-box {
            background: white;
            padding: 30px;
            margin: 40px auto;
            border-radius: 20px;
            width: 90%;
            max-width: 500px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.1);
        }

        .istatistik-box h2 {
            text-align: center;
            margin-bottom: 25px;
            color: #333;
            font-size: 1.8em;
        }

        .istatistik-box ul {
            list-style: none;
            padding: 0;
            transition: all 0.3s ease;
        }

        .istatistik-box li {
            font-size: 1.2em;
            padding: 12px 0;
            border-bottom: 1px solid #eee;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .istatistik-box li:last-child {
            border-bottom: none;
        }

        .istatistik-box li strong {
            color: #B395D4;
            font-weight: 600;
        }

        .footer {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, auto));
            gap: 1rem;
            color: var(--text-color);
            padding: 50px 100px;
            background: #f8f9fa;
        }

        .footer-box h2 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .footer-box p {
            font-size: 0.938rem;
            margin-bottom: 10px;
        }

        .social {
            display: flex;
            align-items: center;
        }

        .social a {
            font-size: 24px;
            color: var(--text-color);
            margin-right: 1rem;
            transition: color 0.3s ease;
        }

        .social a:hover {
            color: #B395D4;
        }

        .copyright {
            padding: 20px;
            text-align: center;
            color: var(--text-color);
            background: #e9ecef;
        }

        /* Loading Animation */
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 991px) {
            section {
                padding: 50px 20px;
            }
            
            header {
                padding: 30px 20px;
                height: 80px;
            }
            
            body {
                margin-top: 80px;
            }
            
            .navbar {
                position: fixed;
                top: 80px;
                right: 100%;
                width: 100%;
                height: calc(100vh - 80px);
                background: #B395D4;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: flex-start;
                padding-top: 50px;
                transition: 0.5s;
                column-gap: 0;
            }
            
            .navbar.active {
                right: 0;
            }
            
            .navbar li {
                margin: 20px 0;
            }
            
            .navbar a {
                font-size: 1.2rem;
                padding: 10px 20px;
                display: block;
                border-radius: 10px;
                transition: background 0.3s ease;
            }
            
            .navbar a:hover {
                background: rgba(255, 255, 255, 0.1);
            }
            
            #menu-icon {
                display: block;
            }
            
            .logo {
                font-size: 1.2rem;
            }
            
            .footer {
                padding: 30px 20px;
            }
        }

        @media (max-width: 768px) {
            .container {
                margin: 20px;
                padding: 30px 20px;
                max-width: calc(100% - 40px);
            }
            
            h1 {
                font-size: 2em;
            }
            
            p {
                font-size: 1.1em;
            }
            
            form label {
                font-size: 1.1em;
                padding: 12px;
                margin: 15px 0;
            }
            
            button {
                font-size: 1.1em;
                padding: 12px 30px;
            }
            
            .result-box {
                padding: 20px;
                margin: 20px;
                max-width: calc(100% - 40px);
            }
            
            .result-box h3 {
                font-size: 1.5em;
            }
            
            .istatistik-box {
                margin: 20px;
                padding: 20px;
                width: calc(100% - 40px);
            }
            
            .istatistik-box h2 {
                font-size: 1.5em;
            }
            
            .istatistik-box li {
                font-size: 1.1em;
                padding: 10px 0;
            }
        }

        @media (max-width: 480px) {
            header {
                padding: 20px 15px;
                height: 70px;
            }
            
            body {
                margin-top: 70px;
            }
            
            .navbar {
                top: 70px;
                height: calc(100vh - 70px);
                padding-top: 30px;
            }
            
            .navbar li {
                margin: 15px 0;
            }
            
            .navbar a {
                font-size: 1.1rem;
            }
            
            .logo {
                font-size: 1.1rem;
            }
            
            .container {
                margin: 15px;
                padding: 20px 15px;
                max-width: calc(100% - 30px);
            }
            
            h1 {
                font-size: 1.8em;
                margin-bottom: 15px;
            }
            
            p {
                font-size: 1em;
                margin-bottom: 20px;
            }
            
            form label {
                font-size: 1em;
                padding: 10px;
                margin: 12px 0;
            }
            
            button {
                font-size: 1em;
                padding: 10px 25px;
            }
            
            .result-box {
                padding: 15px;
                margin: 15px;
                max-width: calc(100% - 30px);
            }
            
            .result-box h3 {
                font-size: 1.3em;
            }
            
            .result-box p {
                font-size: 1em;
            }
            
            .istatistik-box {
                margin: 15px;
                padding: 15px;
                width: calc(100% - 30px);
            }
            
            .istatistik-box h2 {
                font-size: 1.3em;
                margin-bottom: 20px;
            }
            
            .istatistik-box li {
                font-size: 1em;
                padding: 8px 0;
                flex-direction: column;
                text-align: center;
                gap: 5px;
            }
            
            .footer {
                padding: 20px 15px;
            }
            
            .footer-box h2 {
                font-size: 1.1rem;
            }
            
            .footer-box p {
                font-size: 0.9rem;
            }
            
            .social a {
                font-size: 20px;
                margin-right: 0.8rem;
            }
            
            .copyright p {
                font-size: 0.9rem;
            }
        }

        /* Ultra small screens */
        @media (max-width: 360px) {
            .container {
                margin: 10px;
                padding: 15px 10px;
                max-width: calc(100% - 20px);
            }
            
            h1 {
                font-size: 1.6em;
            }
            
            .result-box, .istatistik-box {
                margin: 10px;
                padding: 12px;
                max-width: calc(100% - 20px);
                width: calc(100% - 20px);
            }
        }

        /* Landscape orientation fixes for mobile */
        @media (max-height: 500px) and (orientation: landscape) {
            .navbar {
                padding-top: 20px;
            }
            
            .navbar li {
                margin: 10px 0;
            }
            
            .navbar a {
                font-size: 1rem;
                padding: 8px 15px;
            }
        }
    </style>
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

    <div class="container">
        <h1>🧘‍♀️ Bugün Nasıl Hissediyorsun?</h1>
        <p>Aşağıdaki seçeneklerden birini seç ve ruh halini öğren!</p>
        <form id="moodForm">
            <label>
                <input type="radio" name="mood" value="mutlu"> Mutlu 😊
            </label>
            <label>
                <input type="radio" name="mood" value="üzgün"> Üzgün 😢
            </label>
            <label>
                <input type="radio" name="mood" value="enerjik"> Enerjik ⚡
            </label>
            <label>
                <input type="radio" name="mood" value="stresli"> Stresli 😰
            </label>
            <button type="button" id="submitBtn">✨ Yoga Önerisini Al</button>
        </form>
        <div id="result" class="result-box"></div>
    </div>

    <div class="istatistik-box">
        <h2>📊 Kullanıcı Ruh Hali İstatistikleri</h2>
        <ul>
            <li><span>😊 Mutlu</span> <strong>45 kişi</strong></li>
            <li><span>😢 Üzgün</span> <strong>12 kişi</strong></li>
            <li><span>⚡ Enerjik</span> <strong>38 kişi</strong></li>
            <li><span>😰 Stresli</span> <strong>23 kişi</strong></li>
        </ul>
    </div>

    <section class="footer">
        <div class="footer-box">
            <h2>RuhBalance</h2>
            <p>Bizi sosyal medya hesaplarımızdan takip et, ipuçlarını yakala, hayata odaklan!</p>
            <div class="social">
                <a href="https://www.instagram.com/ruhbalance/"><i class='bx bxl-instagram'></i></a>
            </div>
        </div>
    </section>
    
    <div class="copyright">
        <p>&#169; RuhBalance Tüm Hakları Saklıdır.</p>
    </div>

    <script>
        // Yapay Zeka destekli öneriler ve gerçek zamanlı istatistik güncelleme
        document.getElementById('submitBtn').addEventListener('click', async function () {
            const mood = document.querySelector('input[name="mood"]:checked');
            const result = document.getElementById('result');
            const submitBtn = this;
            
            // Animation reset
            result.classList.remove('fade-in');
            void result.offsetWidth;
            
            if (mood) {
                // Loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = '🧠 AI analiz ediyor...';
                result.innerHTML = `
                    <div style="padding: 40px; text-align: center;">
                        <div style="width: 40px; height: 40px; border: 4px solid #f3f3f3; border-top: 4px solid #B395D4; border-radius: 50%; animation: spin 1s linear infinite; margin: 0 auto 20px;"></div>
                        <p>Yapay zeka veri setini analiz ediyor...</p>
                    </div>
                `;
                result.classList.add('fade-in');
                
                try {
                    // Gerçek AI API çağrısı - CSV verilerini analiz ediyor
                    const aiRecommendation = await getRealAIRecommendation(mood.value);
                    
                    const content = `
                        <div style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 2px; border-radius: 20px;">
                            <div style="background: white; border-radius: 18px; padding: 30px; color: #333;">
                                <div style="text-align: center; margin-bottom: 20px;">
                                    <div style="width: 100px; height: 100px; background: ${aiRecommendation.color}; border-radius: 50%; margin: 0 auto 15px; display: flex; align-items: center; justify-content: center; font-size: 40px;">
                                        ${aiRecommendation.emoji}
                                    </div>
                                    <h3 style="color: #333; margin-bottom: 10px;">${aiRecommendation.pose}</h3>
                                    <div style="background: #f8f9fa; padding: 8px 16px; border-radius: 20px; display: inline-block; margin-bottom: 15px;">
                                        <small>🤖 AI Güven Skoru: <strong>${Math.round(aiRecommendation.confidence)}%</strong></small>
                                    </div>
                                </div>
                                
                                <p style="color: #555; margin-bottom: 20px; line-height: 1.6;">
                                    ${aiRecommendation.description}
                                </p>
                                
                                <div style="background: #f8f9fa; padding: 20px; border-radius: 15px; margin-bottom: 20px;">
                                    <h4 style="color: #333; margin-bottom: 10px;">🎯 Kişiselleştirilmiş Faydalar:</h4>
                                    <div style="display: flex; flex-wrap: wrap; gap: 10px;">
                                        ${aiRecommendation.benefits.map(benefit => 
                                            `<span style="background: #B395D4; color: white; padding: 8px 12px; border-radius: 20px; font-size: 0.9em;">${benefit}</span>`
                                        ).join('')}
                                    </div>
                                </div>
                                
                                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 15px; margin-top: 20px;">
                                    <div style="text-align: center; padding: 15px; background: #e3f2fd; border-radius: 10px;">
                                        <div style="font-size: 1.5em; margin-bottom: 5px;">👥</div>
                                        <small style="color: #666;">Benzer kullanıcılar</small><br>
                                        <strong style="color: #1976d2;">${aiRecommendation.userCount} kişi</strong>
                                    </div>
                                    <div style="text-align: center; padding: 15px; background: #f3e5f5; border-radius: 10px;">
                                        <div style="font-size: 1.5em; margin-bottom: 5px;">📊</div>
                                        <small style="color: #666;">Toplam analiz</small><br>
                                        <strong style="color: #7b1fa2;">${aiRecommendation.totalUsers} kişi</strong>
                                    </div>
                                </div>
                                
                                <div style="margin-top: 20px; padding: 15px; background: linear-gradient(45deg, #B395D4, #D6CDEA); border-radius: 10px; color: white; text-align: center;">
                                    <strong>💡 AI Önerisi:</strong> ${aiRecommendation.aiTip}
                                </div>
                            </div>
                        </div>
                    `;
                    
                    result.innerHTML = content;
                    
                    // ÖNEMLİ: İstatistikleri güncelle - Bu çok önemli kısım!
                    await updateLiveStatistics();
                    
                } catch (error) {
                    console.error('AI analizi başarısız:', error);
                    result.innerHTML = `
                        <div style="padding: 30px; text-align: center; color: #e74c3c;">
                            <h3>⚠️ Bağlantı Hatası</h3>
                            <p>AI analizi şu anda kullanılamıyor. Lütfen daha sonra tekrar deneyin.</p>
                        </div>
                    `;
                }
                
                result.classList.add('fade-in');
                
            } else {
                result.innerHTML = "<p>🤔 Lütfen bir ruh hali seç ve kendini keşfet!</p>";
                result.classList.add('fade-in');
            }
            
            // Button'u resetle
            submitBtn.disabled = false;
            submitBtn.innerHTML = '✨ Yoga Önerisini Al';
        });

        // Gerçek AI API çağrısı - CSV verilerinizi kullanıyor
        async function getRealAIRecommendation(mood) {
            try {
                const response = await fetch('api/mood-prediction.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify({
                        mood: mood,
                        timestamp: new Date().toISOString()
                    })
                });
                
                if (!response.ok) {
                    throw new Error('API çağrısı başarısız');
                }
                
                const data = await response.json();
                
                // AI sonuçlarını güzel bir formata dönüştür
                return {
                    pose: data.pose || getDefaultPose(mood),
                    emoji: getEmojiForMood(mood),
                    color: getColorForMood(mood),
                    description: `AI analizi: ${data.userCount} kişilik veri setinde ${mood} hisseden kullanıcıların %${Math.round(data.confidence)} oranında bu pozdan fayda gördüğü tespit edildi.`,
                    benefits: getBenefitsForMood(mood),
                    confidence: data.confidence || 0,
                    userCount: data.userCount || 0,
                    totalUsers: data.totalUsers || 0,
                    aiTip: getAITipForMood(mood)
                };
                
            } catch (error) {
                console.error('AI API hatası:', error);
                throw error;
            }
        }

        // GERÇEK ZAMANLI İSTATİSTİK GÜNCELLEMESİ - ANA ÖZELLİK!
        async function updateLiveStatistics() {
            try {
                const response = await fetch('api/get-current-stats.php');
                
                if (!response.ok) {
                    throw new Error('İstatistik çekme başarısız');
                }
                
                const stats = await response.json();
                
                // İstatistik kutusunu animasyonlu güncelle
                const statBox = document.querySelector('.istatistik-box ul');
                if (statBox) {
                    // Fade out effect
                    statBox.style.opacity = '0.5';
                    statBox.style.transform = 'scale(0.95)';
                    
                    setTimeout(() => {
                        statBox.innerHTML = `
                            <li><span>😊 Mutlu</span> <strong>${stats.mutlu || 0} kişi</strong></li>
                            <li><span>😢 Üzgün</span> <strong>${stats.üzgün || 0} kişi</strong></li>
                            <li><span>⚡ Enerjik</span> <strong>${stats.enerjik || 0} kişi</strong></li>
                            <li><span>😰 Stresli</span> <strong>${stats.stresli || 0} kişi</strong></li>
                        `;
                        
                        // Fade in effect
                        statBox.style.opacity = '1';
                        statBox.style.transform = 'scale(1)';
                        
                        // Başlığı da güncelle
                        const title = document.querySelector('.istatistik-box h2');
                        if (title) {
                            title.innerHTML = `📊 Anlık Kullanıcı İstatistikleri <span style="color: #28a745; font-size: 0.8em;">● CANLI</span>`;
                        }
                        
                        console.log('İstatistikler başarıyla güncellendi:', stats);
                        
                    }, 300);
                }
                
            } catch (error) {
                console.error('İstatistik güncelleme hatası:', error);
            }
        }

        // Yardımcı fonksiyonlar
        function getDefaultPose(mood) {
            const poses = {
                'mutlu': 'Güneşe Selam Sekansı',
                'üzgün': 'Restoratif Yoga Serisi',
                'enerjik': 'Güç Yoga Akışı',
                'stresli': 'Nefes Odaklı Yin Yoga'
            };
            return poses[mood] || 'Temel Yoga Pozları';
        }

        function getEmojiForMood(mood) {
            const emojis = {
                'mutlu': '☀️',
                'üzgün': '🕊️',
                'enerjik': '⚡',
                'stresli': '🧘‍♀️'
            };
            return emojis[mood] || '🧘‍♀️';
        }

        function getColorForMood(mood) {
            const colors = {
                'mutlu': '#FFD700',
                'üzgün': '#9CB4D8',
                'enerjik': '#FF6347',
                'stresli': '#4C63D2'
            };
            return colors[mood] || '#B395D4';
        }

        function getBenefitsForMood(mood) {
            const benefits = {
                'mutlu': ['Enerji Artışı', 'Endorfin Salınımı', 'Kas Tonifikasyonu', 'Zihinsel Berraklık'],
                'üzgün': ['Duygusal Denge', 'Stres Azaltma', 'İç Huzur', 'Uyku Kalitesi'],
                'enerjik': ['Kas Kuvveti', 'Odaklanma', 'Enerji Kontrolü', 'Dayanıklılık'],
                'stresli': ['Stres Azaltma', 'Kortizol Dengesi', 'Derin Rahatlama', 'Zihin Sakinliği']
            };
            return benefits[mood] || ['Genel Sağlık', 'Zihinsel Denge'];
        }

        function getAITipForMood(mood) {
            const tips = {
                'mutlu': 'Pozitif enerjinizi korumak için sabah rutininize ekleyin',
                'üzgün': 'Duygusal dengeyi sağlamak için yavaş nefes teknikleriyle birleştirin',
                'enerjik': 'Yüksek enerjinizi kontrollü şekilde kanalize edin',
                'stresli': 'Günde 15 dakika düzenli uygulama ile stres seviyenizi %40 azaltabilirsiniz'
            };
            return tips[mood] || 'Düzenli uygulama ile en iyi sonuçları alacaksınız';
        }

        // Sayfa yüklendiğinde mevcut istatistikleri getir
        document.addEventListener('DOMContentLoaded', function() {
            updateLiveStatistics();
            
            // İsteğe bağlı: Her 30 saniyede bir istatistikleri güncelle
            // setInterval(updateLiveStatistics, 30000);
        });

        // Header scroll effect
        window.addEventListener('scroll', function() {
            const header = document.querySelector('header');
            if (window.scrollY > 0) {
                header.classList.add('shadow');
            } else {
                header.classList.remove('shadow');
            }
        });

        // Mobile menu toggle
        const menuIcon = document.getElementById('menu-icon');
        const navbar = document.querySelector('.navbar');

        if (menuIcon && navbar) {
            menuIcon.addEventListener('click', function() {
                navbar.classList.toggle('active');
            });
        }
    </script>
</body>
</html>