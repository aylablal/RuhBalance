// Hamburger menü ikonu ve navbar seçicileri
const menuIcon = document.getElementById("menu-icon");
const navbar = document.querySelector(".navbar");

// Menü ikonuna tıklama olayını yönet
menuIcon.addEventListener("click", () => {
    navbar.classList.toggle("active");
});

// Sayfa kaydırıldığında header'a shadow ekleme
const header = document.querySelector("header");
window.addEventListener("scroll", () => {
    header.classList.toggle("shadow", window.scrollY > 0);
});

// Navbar'da bir bağlantıya tıklandığında menüyü kapat
document.querySelectorAll(".navbar a").forEach((link) => {
    link.addEventListener("click", () => {
        navbar.classList.remove("active");
    });
});

// Favori sistemi için gerekli elemanlar
const favoriteButtons = document.querySelectorAll('.favorite-btn');
const showFavoritesBtn = document.querySelector('.show-favorites-btn');
const favoritesSection = document.querySelector('.favorites-section');
const favoritesContainer = document.querySelector('.favorites-container');
const clearFavoritesBtn = document.querySelector('.clear-favorites');
const noFavoritesText = document.querySelector('.no-favorites');
const toast = document.getElementById('toast');
const favoritesCount = document.querySelector('.show-favorites-btn .count');

// Favorileri localStorage'tan al veya boş liste oluştur
let favorites = JSON.parse(localStorage.getItem('yogaFavorites')) || [];

// Sayfa yüklendiğinde favorileri göster
updateFavoritesUI();

// Her favori butonuna tıklama olayı ekle
favoriteButtons.forEach(btn => {
    const boxId = btn.closest('.box').dataset.id;

    // Mevcut favorileri işaretle
    if (favorites.includes(boxId)) {
        btn.classList.add('active');
        const icon = btn.querySelector('i');
        if (icon) {
            icon.classList.remove('bx-heart');
            icon.classList.add('bxs-heart');
        }
    }

    btn.addEventListener('click', () => {
        toggleFavorite(boxId, btn);
    });
});

// Favori ekleme/çıkarma işlemi
function toggleFavorite(id, button) {
    const index = favorites.indexOf(id);
    const icon = button.querySelector('i');

    if (index > -1) {
        // Favorilerden çıkar
        favorites.splice(index, 1);
        button.classList.remove('active');
        if (icon) {
            icon.classList.remove('bxs-heart');
            icon.classList.add('bx-heart');
        }
        showToast("Favorilerden çıkarıldı");
    } else {
        // Favorilere ekle
        favorites.push(id);
        button.classList.add('active');
        if (icon) {
            icon.classList.remove('bx-heart');
            icon.classList.add('bxs-heart');
        }
        showToast("Favorilere eklendi");
    }

    localStorage.setItem('yogaFavorites', JSON.stringify(favorites));
    updateFavoritesUI();
}

// Favori gösterme butonuna tıklanınca
showFavoritesBtn.addEventListener('click', () => {
    favoritesSection.classList.toggle('active');
    if (favoritesSection.classList.contains('active')) {
        favoritesSection.scrollIntoView({ behavior: 'smooth' });
    }
});

// Favorileri temizleme butonu
clearFavoritesBtn.addEventListener('click', () => {
    favorites = [];
    localStorage.setItem('yogaFavorites', JSON.stringify(favorites));

    // Tüm favori butonlarını sıfırla
    favoriteButtons.forEach(btn => {
        btn.classList.remove('active');
        const icon = btn.querySelector('i');
        if (icon) {
            icon.classList.remove('bxs-heart');
            icon.classList.add('bx-heart');
        }
    });

    updateFavoritesUI();
    showToast("Tüm favoriler temizlendi");
});

// Favorileri UI'da göster
function updateFavoritesUI() {
    favoritesContainer.innerHTML = '';

    if (favorites.length === 0) {
        noFavoritesText.style.display = 'block';
        favoritesCount.textContent = '0';
        return;
    }

    noFavoritesText.style.display = 'none';
    favoritesCount.textContent = favorites.length;

    favorites.forEach(id => {
        const originalBox = document.querySelector(`.box[data-id="${id}"]`);
        if (originalBox) {
            const clone = originalBox.cloneNode(true);
            const favBtn = clone.querySelector('.favorite-btn');
            if (favBtn) favBtn.remove();
            favoritesContainer.appendChild(clone);
        }
    });
}

// Basit toast mesajı göster
function showToast(message) {
    if (!toast) return;
    toast.textContent = message;
    toast.classList.add('show');
    setTimeout(() => {
        toast.classList.remove('show');
    }, 2000);
}
