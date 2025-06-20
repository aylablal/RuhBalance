// DOM yüklendiğinde çalışacak fonksiyonlar
document.addEventListener('DOMContentLoaded', function() {
    initializeForm();
    initializeInputAnimations();
});

// Form işlevselliğini başlatma
function initializeForm() {
    const form = document.getElementById('contactForm');
    const errorMessage = document.getElementById('error-message');
    const successMessage = document.getElementById('success-message');
    
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Mesaj alanını kontrol et
            const messageField = form.querySelector('textarea[name="message"]');
            const message = messageField.value.trim();
            
            // Basit küfür kontrolü
            if (containsInappropriateWords(message)) {
                showMessage(errorMessage, 'Mesajınızda uygunsuz kelimeler bulunmaktadır. Lütfen düzenleyiniz.');
                hideMessage(successMessage);
                return;
            }
            
            // Form verilerini kontrol et
            if (validateForm(form)) {
                // Başarı mesajı göster
                showMessage(successMessage, 'Mesajınız başarıyla gönderildi!');
                hideMessage(errorMessage);
                
                // Formu temizle
                setTimeout(() => {
                    form.reset();
                    resetInputAnimations();
                    hideMessage(successMessage);
                }, 3000);
            }
        });
    }
}

// Input animasyonlarını başlatma
function initializeInputAnimations() {
    const inputs = document.querySelectorAll('.input');
    
    inputs.forEach(input => {
        const container = input.closest('.input-container');
        
        // Focus olayları
        input.addEventListener('focus', function() {
            container.classList.add('focus');
        });
        
        input.addEventListener('blur', function() {
            if (!input.value.trim()) {
                container.classList.remove('focus');
            }
        });
        
        // Başlangıçta dolu alanları kontrol et
        if (input.value.trim()) {
            container.classList.add('focus');
        }
        
        // Input değişimi
        input.addEventListener('input', function() {
            if (input.value.trim()) {
                container.classList.add('focus');
            } else {
                container.classList.remove('focus');
            }
        });
    });
}

// Form doğrulama
function validateForm(form) {
    const name = form.querySelector('input[name="name"]').value.trim();
    const email = form.querySelector('input[name="email"]').value.trim();
    const phone = form.querySelector('input[name="phone"]').value.trim();
    const message = form.querySelector('textarea[name="message"]').value.trim();
    
    // Basit doğrulama
    if (!name || !email || !phone || !message) {
        showMessage(document.getElementById('error-message'), 'Lütfen tüm alanları doldurunuz.');
        return false;
    }
    
    // Email formatı kontrolü
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(email)) {
        showMessage(document.getElementById('error-message'), 'Geçerli bir email adresi giriniz.');
        return false;
    }
    
    return true;
}

// Uygunsuz kelime kontrolü
function containsInappropriateWords(text) {
    const inappropriateWords = [
        'küfür1', 'küfür2', 'spam', 'test'
        // Gerçek kullanımda daha kapsamlı bir liste olmalı
    ];
    
    const lowerText = text.toLowerCase();
    return inappropriateWords.some(word => lowerText.includes(word));
}

// Mesaj gösterme
function showMessage(element, text) {
    if (element) {
        const span = element.querySelector('span');
        if (span) {
            span.textContent = text;
        }
        element.style.display = 'flex';
        
        // Animasyon için
        element.style.opacity = '0';
        element.style.transform = 'translateY(-10px)';
        
        setTimeout(() => {
            element.style.transition = 'all 0.3s ease';
            element.style.opacity = '1';
            element.style.transform = 'translateY(0)';
        }, 10);
    }
}

// Mesaj gizleme
function hideMessage(element) {
    if (element) {
        element.style.transition = 'all 0.3s ease';
        element.style.opacity = '0';
        element.style.transform = 'translateY(-10px)';
        
        setTimeout(() => {
            element.style.display = 'none';
        }, 300);
    }
}

// Input animasyonlarını sıfırlama
function resetInputAnimations() {
    const containers = document.querySelectorAll('.input-container');
    containers.forEach(container => {
        container.classList.remove('focus');
    });
}

// Smooth scroll için (navbar linkleri için)
function smoothScroll(target) {
    const element = document.querySelector(target);
    if (element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    }
}

// Sayfa yüklenme animasyonları
window.addEventListener('load', function() {
    // Form container'ı görünür yap
    const form = document.querySelector('.form');
    if (form) {
        form.style.opacity = '1';
        form.style.transform = 'translateY(0)';
    }
    
    // Floating circle animasyonlarını başlat
    const circles = document.querySelectorAll('.floating-circle');
    circles.forEach((circle, index) => {
        setTimeout(() => {
            circle.style.opacity = '0.1';
            circle.style.animation = `float ${6 + index}s ease-in-out infinite`;
        }, index * 200);
    });
});

// Klavye kısayolları
document.addEventListener('keydown', function(e) {
    // Ctrl + Enter ile form gönderme
    if (e.ctrlKey && e.key === 'Enter') {
        const form = document.getElementById('contactForm');
        if (form && document.activeElement.tagName === 'TEXTAREA') {
            form.dispatchEvent(new Event('submit'));
        }
    }
    
    // Escape ile mesajları gizleme
    if (e.key === 'Escape') {
        hideMessage(document.getElementById('error-message'));
        hideMessage(document.getElementById('success-message'));
    }
});

// Telefon numarası formatı
function formatPhoneNumber(input) {
    // Türkiye telefon numarası formatı için
    let value = input.value.replace(/\D/g, '');
    if (value.length > 0) {
        if (value.length >= 10) {
            value = value.substring(0, 10);
            value = value.replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
        } else if (value.length >= 6) {
            value = value.replace(/(\d{3})(\d{3})/, '($1) $2');
        } else if (value.length >= 3) {
            value = value.replace(/(\d{3})/, '($1)');
        }
    }
    input.value = value;
}

// Telefon input'una format uygulama
document.addEventListener('DOMContentLoaded', function() {
    const phoneInput = document.querySelector('input[name="phone"]');
    if (phoneInput) {
        phoneInput.addEventListener('input', function() {
            formatPhoneNumber(this);
        });
    }
});

// Form gönderme işlemi (gerçek backend bağlantısı için)
function submitForm(formData) {
    // Bu fonksiyon gerçek bir backend'e bağlanacak
    // Şimdilik simüle ediyoruz
    return new Promise((resolve, reject) => {
        setTimeout(() => {
            // %90 başarı oranı simülasyonu
            if (Math.random() > 0.1) {
                resolve({
                    success: true,
                    message: 'Mesajınız başarıyla gönderildi!'
                });
            } else {
                reject({
                    success: false,
                    message: 'Bir hata oluştu. Lütfen tekrar deneyiniz.'
                });
            }
        }, 1000);
    });
}

// Loading animasyonu
function showLoading(button) {
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Gönderiliyor...';
    button.disabled = true;
    
    return function hideLoading() {
        button.innerHTML = originalText;
        button.disabled = false;
    };
}

// Gelişmiş form gönderme
function enhancedFormSubmit(form) {
    const button = form.querySelector('.btn');
    const hideLoading = showLoading(button);
    
    const formData = new FormData(form);
    
    submitForm(formData)
        .then(response => {
            showMessage(document.getElementById('success-message'), response.message);
            hideMessage(document.getElementById('error-message'));
            
            // Formu temizle
            setTimeout(() => {
                form.reset();
                resetInputAnimations();
                hideMessage(document.getElementById('success-message'));
            }, 3000);
        })
        .catch(error => {
            showMessage(document.getElementById('error-message'), error.message);
            hideMessage(document.getElementById('success-message'));
        })
        .finally(() => {
            hideLoading();
        });
}