// Tüm yıldız ikonlarını seç
const allStar = document.querySelectorAll('.rating .star');

// Gizli input alanını seç (rating değeri burada tutulacak)
const ratingInput = document.querySelector('input[name="rating"]');

// Her bir yıldıza tıklama olayını tanımla
allStar.forEach((item, idx) => {
    item.addEventListener('click', () => {
        // Tıklama sırasında animasyon sıralaması için sayaç başlat
        let click = 0;

        // Tüm yıldızları sıfırla (boş yıldız yap ve stil sıfırla)
        allStar.forEach(i => {
            i.classList.replace('bxs-star', 'bx-star'); // Dolu → Boş
            i.classList.remove('active');
            i.style.removeProperty('--i');
        });

        // Tıklanan yıldıza kadar olanları doldur (aktif yap ve stil uygula)
        for (let i = 0; i <= idx; i++) {
            allStar[i].classList.replace('bx-star', 'bxs-star'); // Boş → Dolu
            allStar[i].classList.add('active');
            allStar[i].style.setProperty('--i', click);
            click++;
        }

        // ⭐ Seçilen yıldız sayısını gizli input'a yaz
        ratingInput.value = idx + 1;
    });
});
