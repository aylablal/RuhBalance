console.log("Blog.js yüklendi");

// Playlist URL'leri - Spotify'dan alınan gerçek playlist'ler
const PLAYLISTS = {
    calm: "https://open.spotify.com/embed/playlist/37i9dQZF1DX3Ogo9pFvBkY?utm_source=generator&theme=0",
    happy: "https://open.spotify.com/embed/playlist/37i9dQZF1DXdPec7aLTmlC?utm_source=generator&theme=0", 
    stressed: "https://open.spotify.com/embed/playlist/37i9dQZF1DWXe9gFZP0gtP?utm_source=generator&theme=0",
    focus: "https://open.spotify.com/embed/playlist/37i9dQZF1DX8NTLI2TtZa6?utm_source=generator&theme=0"
};

// Mood playlist descriptions
const MOOD_DESCRIPTIONS = {
    calm: "Bu sakin playlist ile zihinsel huzuru yakala. Meditasyon ve yoga seansların için mükemmel.",
    happy: "Enerjini artır ve pozitif hissetet! Bu neşeli şarkılar ruhunu canlandıracak.",
    stressed: "Stresin ağırlığını üzerinden at. Bu yumuşak melodiler seni rahatlatacak.",
    focus: "Odaklanmaya ihtiyacın var mı? Bu playlist ile konsantrasyonunu artır."
};

// DOM tamamen yüklendiğinde çalışacak kod
document.addEventListener('DOMContentLoaded', function() {
    console.log("DOM yüklendi");
    
    // Ana işlevleri başlat
    initializeNavigation();
    initializeMoodPlaylist();
    initializeScrollEffects();
    initializeLazyLoading();
});

/**
 * Navigasyon menüsü işlevselliği
 */
function initializeNavigation() {
    const menuIcon = document.getElementById('menu-icon');
    const navbar = document.querySelector('.navbar');
    
    if (!menuIcon || !navbar) {
        console.error("Menü ikonu veya navbar bulunamadı!");
        return;
    }
    
    console.log("Navigasyon başlatıldı");
    
    // Menü ikonuna tıklama olayı
    menuIcon.addEventListener('click', function(e) {
        e.preventDefault();
        toggleMobileMenu();
    });
    
    // Sayfaya tıklandığında menüyü kapat
    document.addEventListener('click', function(e) {
        if (!navbar.contains(e.target) && !menuIcon.contains(e.target)) {
            closeMobileMenu();
        }
    });
    
    // ESC tuşu ile menüyü kapat
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMobileMenu();
        }
    });
}

/**
 * Mobil menüyü aç/kapat
 */
function toggleMobileMenu() {
    const navbar = document.querySelector('.navbar');
    const menuIcon = document.getElementById('menu-icon');
    
    navbar.classList.toggle('active');
    menuIcon.classList.toggle('bx-x');
    
    // Accessibility için aria-expanded attribute
    const isExpanded = navbar.classList.contains('active');
    menuIcon.setAttribute('aria-expanded', isExpanded);
    
    console.log("Menü durumu:", isExpanded ? "açık" : "kapalı");
}

/**
 * Mobil menüyü kapat
 */
function closeMobileMenu() {
    const navbar = document.querySelector('.navbar');
    const menuIcon = document.getElementById('menu-icon');
    
    if (navbar.classList.contains('active')) {
        navbar.classList.remove('active');
        menuIcon.classList.remove('bx-x');
        menuIcon.setAttribute('aria-expanded', 'false');
    }
}

/**
 * Scroll efektleri
 */
function initializeScrollEffects() {
    let ticking = false;
    
    window.addEventListener('scroll', function() {
        if (!ticking) {
            requestAnimationFrame(function() {
                handleScroll();
                ticking = false;
            });
            ticking = true;
        }
    });
}

/**
 * Scroll işlemleri
 */
function handleScroll() {
    // Mobil menüyü kapat
    closeMobileMenu();
    
    // Header arka plan efekti
    updateHeaderBackground();
    
    // Scroll to top butonu (varsa)
    updateScrollToTopButton();
}

/**
 * Header arka plan güncellemesi
 */
function updateHeaderBackground() {
    const header = document.querySelector('header');
    if (!header) return;
    
    if (window.scrollY > 50) {
        header.style.background = 'rgba(179, 149, 212, 0.95)';
        header.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
        header.style.backdropFilter = 'blur(10px)';
    } else {
        header.style.background = '#B395D4';
        header.style.boxShadow = 'none';
        header.style.backdropFilter = 'none';
    }
}

/**
 * Scroll to top butonu güncellemesi
 */
function updateScrollToTopButton() {
    const scrollBtn = document.querySelector('.scroll-to-top');
    if (!scrollBtn) return;
    
    if (window.scrollY > 300) {
        scrollBtn.classList.add('visible');
    } else {
        scrollBtn.classList.remove('visible');
    }
}

/**
 * Mood playlist işlevselliği
 */
function initializeMoodPlaylist() {
    const moodCards = document.querySelectorAll('.mood-card');
    const playlistContainer = document.getElementById('playlistContainer');
    const spotifyPlayer = document.getElementById('spotifyPlayer');
    
    if (moodCards.length === 0 || !playlistContainer || !spotifyPlayer) {
        console.log("Mood playlist elementleri bulunamadı");
        return;
    }
    
    console.log("Mood playlist sistemi başlatıldı");
    
    // Her mood card'a click event listener ekle
    moodCards.forEach(card => {
        card.addEventListener('click', function() {
            const mood = this.getAttribute('data-mood');
            if (mood && PLAYLISTS[mood]) {
                selectMood(mood, moodCards);
                changePlaylist(mood, spotifyPlayer);
            }
        });
        
        // Keyboard accessibility
        card.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.click();
            }
        });
    });
    
    // İlk playlist'i yükle
    hideLoadingSpinner();
}

/**
 * Mood seçimi
 */
function selectMood(selectedMood, moodCards) {
    // Tüm card'lardan active class'ını kaldır
    moodCards.forEach(card => {
        card.classList.remove('active');
        card.setAttribute('aria-selected', 'false');
    });
    
    // Seçilen card'a active class ekle
    const selectedCard = document.querySelector(`[data-mood="${selectedMood}"]`);
    if (selectedCard) {
        selectedCard.classList.add('active');
        selectedCard.setAttribute('aria-selected', 'true');
    }
    
    console.log(`Mood seçildi: ${selectedMood}`);
}

/**
 * Playlist değiştirme
 */
function changePlaylist(mood, playerElement) {
    if (!mood || !playerElement || !PLAYLISTS[mood]) {
        console.error("Geçersiz mood veya playlist bulunamadı:", mood);
        return;
    }
    
    showLoadingSpinner();
    
    // Smooth transition için setTimeout
    setTimeout(() => {
        try {
            playerElement.src = PLAYLISTS[mood];
            
            // Playlist yüklendiğinde loading'i gizle
            playerElement.onload = function() {
                hideLoadingSpinner();
                showPlaylistInfo(mood);
            };
            
            // Hata durumunda loading'i gizle
            playerElement.onerror = function() {
                hideLoadingSpinner();
                showPlaylistError();
            };
            
        } catch (error) {
            console.error("Playlist yükleme hatası:", error);
            hideLoadingSpinner();
            showPlaylistError();
        }
    }, 300);
}

/**
 * Loading spinner göster
 */
function showLoadingSpinner() {
    const loading = document.getElementById('playlistLoading');
    if (loading) {
        loading.style.display = 'flex';
    }
}

/**
 * Loading spinner gizle
 */
function hideLoadingSpinner() {
    const loading = document.getElementById('playlistLoading');
    if (loading) {
        loading.style.display = 'none';
    }
}

/**
 * Playlist bilgisi göster
 */
function showPlaylistInfo(mood) {
    const description = MOOD_DESCRIPTIONS[mood];
    if (description) {
        // Geçici bilgi mesajı göster (isteğe bağlı)
        showToast(description);
    }
}

/**
 * Playlist hata mesajı göster
 */
function showPlaylistError() {
    showToast("Playlist yüklenirken bir hata oluştu. Lütfen daha sonra tekrar deneyin.", "error");
}

/**
 * Toast mesaj göster
 */
function showToast(message, type = "info") {
    // Mevcut toast varsa kaldır
    const existingToast = document.querySelector('.toast');
    if (existingToast) {
        existingToast.remove();
    }
    
    // Yeni toast oluştur
    const toast = document.createElement('div');
    toast.className = `toast toast-${type}`;
    toast.innerHTML = `
        <div class="toast-content">
            <i class='bx ${getToastIcon(type)}'></i>
            <span>${message}</span>
        </div>
    `;
    
    // Toast'ı sayfaya ekle
    document.body.appendChild(toast);
    
    // Animasyon için timeout
    setTimeout(() => {
        toast.classList.add('show');
    }, 100);
    
    // 4 saniye sonra kaldır
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => {
            if (toast.parentNode) {
                toast.remove();
            }
        }, 300);
    }, 4000);
}

/**
 * Toast ikonu al
 */
function getToastIcon(type) {
    const icons = {
        info: 'bx-info-circle',
        error: 'bx-error-circle',
        success: 'bx-check-circle',
        warning: 'bx-error'
    };
    return icons[type] || icons.info;
}

/**
 * Lazy loading için intersection observer
 */
function initializeLazyLoading() {
    const images = document.querySelectorAll('img[loading="lazy"]');
    
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.classList.add('fade-in');
                    observer.unobserve(img);
                }
            });
        });
        
        images.forEach(img => imageObserver.observe(img));
    }
}

/**
 * Smooth scroll için utility fonksiyon
 */
function smoothScrollTo(element, duration = 1000) {
    const targetPosition = element.offsetTop - 100; // Header yüksekliği için offset
    const startPosition = window.pageYOffset;
    const distance = targetPosition - startPosition;
    let startTime = null;
    
    function animation(currentTime) {
        if (startTime === null) startTime = currentTime;
        const timeElapsed = currentTime - startTime;
        const run = ease(timeElapsed, startPosition, distance, duration);
        window.scrollTo(0, run);
        if (timeElapsed < duration) requestAnimationFrame(animation);
    }
    
    function ease(t, b, c, d) {
        t /= d / 2;
        if (t < 1) return c / 2 * t * t + b;
        t--;
        return -c / 2 * (t * (t - 2) - 1) + b;
    }
    
    requestAnimationFrame(animation);
}

/**
 * Blog card'larına hover efektleri ekle
 */
function initializeBlogCardEffects() {
    const blogCards = document.querySelectorAll('.blog-card');
    
    blogCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px)';
            this.style.boxShadow = '0 20px 40px rgba(0,0,0,0.1)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
            this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.08)';
        });
    });
}

/**
 * Mood card'larına animasyon efektleri
 */
function initializeMoodCardAnimations() {
    const moodCards = document.querySelectorAll('.mood-card');
    
    moodCards.forEach((card, index) => {
        // Sayfa yüklendiğinde sıralı animasyon
        setTimeout(() => {
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 150);
        
        // Hover efektleri
        card.addEventListener('mouseenter', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateY(-5px) scale(1.02)';
            }
        });
        
        card.addEventListener('mouseleave', function() {
            if (!this.classList.contains('active')) {
                this.style.transform = 'translateY(0) scale(1)';
            }
        });
    });
}

/**
 * Klavye navigasyonu için accessibility
 */
function initializeKeyboardNavigation() {
    // Mood card'lar için klavye navigasyonu
    const moodCards = document.querySelectorAll('.mood-card');
    
    moodCards.forEach((card, index) => {
        card.setAttribute('tabindex', '0');
        card.setAttribute('role', 'button');
        card.setAttribute('aria-label', `${card.querySelector('h3').textContent} mood playlist'ini seç`);
        
        card.addEventListener('keydown', function(e) {
            switch(e.key) {
                case 'ArrowRight':
                case 'ArrowDown':
                    e.preventDefault();
                    const nextCard = moodCards[index + 1] || moodCards[0];
                    nextCard.focus();
                    break;
                    
                case 'ArrowLeft':
                case 'ArrowUp':
                    e.preventDefault();
                    const prevCard = moodCards[index - 1] || moodCards[moodCards.length - 1];
                    prevCard.focus();
                    break;
                    
                case 'Home':
                    e.preventDefault();
                    moodCards[0].focus();
                    break;
                    
                case 'End':
                    e.preventDefault();
                    moodCards[moodCards.length - 1].focus();
                    break;
            }
        });
    });
}

/**
 * Error handling için global error listener
 */
function initializeErrorHandling() {
    window.addEventListener('error', function(e) {
        console.error('JavaScript Hatası:', e.error);
        
        // Kullanıcıya dostane hata mesajı göster (isteğe bağlı)
        if (e.error.message.includes('playlist') || e.error.message.includes('spotify')) {
            showToast("Müzik servisi geçici olarak kullanılamıyor.", "warning");
        }
    });
}

/**
 * Performance monitoring
 */
function initializePerformanceMonitoring() {
    // Sayfa yükleme süresini ölç
    window.addEventListener('load', function() {
        const loadTime = performance.now();
        console.log(`Sayfa yükleme süresi: ${Math.round(loadTime)}ms`);
        
        // 3 saniyeden fazla sürdüyse uyarı ver
        if (loadTime > 3000) {
            console.warn('Sayfa yükleme süresi normalden uzun');
        }
    });
}

// Sayfa tamamen yüklendiğinde ek işlevleri başlat
window.addEventListener('load', function() {
    initializeBlogCardEffects();
    initializeMoodCardAnimations();
    initializeKeyboardNavigation();
    initializeErrorHandling();
    initializePerformanceMonitoring();
    
    console.log("Tüm blog işlevselliği başarıyla yüklendi");
});