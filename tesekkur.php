<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teşekkürler - RuhBalance</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #333;
        }

        .thank-you-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 60px 40px;
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
            text-align: center;
            max-width: 600px;
            width: 90%;
            backdrop-filter: blur(10px);
            animation: slideIn 0.6s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #4CAF50, #45a049);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 30px;
            animation: bounce 0.6s ease-out 0.3s both;
        }

        @keyframes bounce {
            0%, 20%, 53%, 80%, 100% {
                transform: translate3d(0,0,0);
            }
            40%, 43% {
                transform: translate3d(0,-15px,0);
            }
            70% {
                transform: translate3d(0,-7px,0);
            }
            90% {
                transform: translate3d(0,-3px,0);
            }
        }

        .success-icon::before {
            content: '✓';
            color: white;
            font-size: 40px;
            font-weight: bold;
        }

        h1 {
            color: #2c3e50;
            font-size: 2.5em;
            margin-bottom: 20px;
            font-weight: 300;
        }

        .message {
            font-size: 1.2em;
            line-height: 1.6;
            color: #666;
            margin-bottom: 30px;
        }

        .highlight {
            color: #667eea;
            font-weight: 600;
        }

        .buttons {
            display: flex;
            gap: 20px;
            justify-content: center;
            flex-wrap: wrap;
            margin-top: 40px;
        }

        .btn {
            padding: 15px 30px;
            border: none;
            border-radius: 50px;
            font-size: 1em;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
        }

        .btn-primary {
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: #667eea;
            border: 2px solid #667eea;
        }

        .btn-secondary:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
        }

        .contact-info {
            background: #f8f9fa;
            padding: 25px;
            border-radius: 15px;
            margin-top: 30px;
            border-left: 4px solid #667eea;
        }

        .contact-info h3 {
            color: #2c3e50;
            margin-bottom: 15px;
            font-size: 1.3em;
        }

        .contact-info p {
            color: #666;
            margin-bottom: 8px;
        }

        .auto-redirect {
            font-size: 0.9em;
            color: #888;
            margin-top: 30px;
            font-style: italic;
        }

        @media (max-width: 768px) {
            .thank-you-container {
                padding: 40px 25px;
                margin: 20px;
            }
            
            h1 {
                font-size: 2em;
            }
            
            .buttons {
                flex-direction: column;
                align-items: center;
            }
            
            .btn {
                width: 200px;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <div class="thank-you-container">
        <div class="success-icon"></div>
        
        <h1>Teşekkür Ederiz!</h1>
        
        <div class="message">
            <p>Mesajınız <span class="highlight">başarıyla</span> alınmıştır.</p>
            <p>En kısa sürede size geri dönüş yapacağız.</p>
            <p><strong>Sağlıklı günler dileriz! 🌟</strong></p>
        </div>

        <div class="contact-info">
            <h3>📞 Acil Durumlar İçin</h3>
            <p><strong>Telefon:</strong> +90 (543) 554 89 98</p>
            <p><strong>Email:</strong> ruhbalance@gmail.com</p>
            <p><strong>Çalışma Saatleri:</strong> Pazartesi - Cuma: 09:00 - 18:00</p>
        </div>

        <div class="buttons">
            <a href="index.php" class="btn btn-primary">
                🏠 Ana Sayfaya Dön
            </a>
        </div>

        <div class="auto-redirect">
            <p>5 saniye sonra otomatik olarak ana sayfaya yönlendirileceksiniz...</p>
        </div>
    </div>

    <script>
        // 5 saniye sonra ana sayfaya yönlendir
        setTimeout(function() {
            window.location.href = 'index.php';
        }, 5000);

        // Sayfa yüklendiğinde animasyon efekti
        document.addEventListener('DOMContentLoaded', function() {
            const container = document.querySelector('.thank-you-container');
            container.style.opacity = '0';
            container.style.transform = 'translateY(30px)';
            
            setTimeout(function() {
                container.style.transition = 'all 0.6s ease-out';
                container.style.opacity = '1';
                container.style.transform = 'translateY(0)';
            }, 100);
        });

        // Tıklama ses efekti (isteğe bağlı)
        document.querySelectorAll('.btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                // Buton tıklama animasyonu
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 150);
            });
        });
    </script>
</body>
</html>