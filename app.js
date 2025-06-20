 //scroll efekti
let header = document.querySelector('header');
let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');


window.addEventListener('scroll', () => {
    header.classList.toggle('shadow', window.scrollY > 0);
});

// Mobile menu toggle with improved animation
menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('active');
}


window.onscroll = () => {
    menu.classList.remove('bx-x');
    navbar.classList.remove('active');
}

// Enhanced Swiper configuration
var swiper = new Swiper(".home", {
    spaceBetween: 30,
    centeredSlides: true,
    autoplay: {
        delay: 4000,
        disableOnInteraction: false,
    },
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
        dynamicBullets: true,
    },
    effect: 'fade',
    fadeEffect: {
        crossFade: true
    },
    speed: 1000,
    loop: true,
    on: {
        slideChangeTransitionStart: function () {
            // Reset animations
            document.querySelectorAll('.animate-slide').forEach(el => {
                el.style.animation = 'none';
            });
        },
        slideChangeTransitionEnd: function () {
            // Restart animations for new slide
            document.querySelectorAll('.swiper-slide-active .animate-slide').forEach((el, index) => {
                el.style.animation = `fadeInUp 0.8s ease forwards`;
                el.style.animationDelay = `${0.2 + (index * 0.2)}s`;
            });
        }
    }
});

//ANİMASYON
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate');
        }
    });
}, observerOptions);


document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.places-container .box, .about-text, .about-img').forEach(el => {
        observer.observe(el);
    });
});


document.querySelectorAll('.places-container .box').forEach(box => {
    box.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-15px) scale(1.02)';
    });
    
    box.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) scale(1)';
    });
});


document.querySelectorAll('.navbar a').forEach(link => {
    link.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-3px)';
    });
    
    link.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0)';
    });
});


window.addEventListener('scroll', () => {
    const scrolled = window.pageYOffset;
    const parallaxElements = document.querySelectorAll('.about-img img');
    
    parallaxElements.forEach(element => {
        const speed = 0.3;
        const yPos = -(scrolled * speed);
        element.style.transform = `translateY(${yPos}px)`;
    });
});


document.querySelectorAll('.btn').forEach(btn => {
    btn.addEventListener('click', function(e) {
        const ripple = document.createElement('span');
        const rect = this.getBoundingClientRect();
        const size = Math.max(rect.width, rect.height);
        const x = e.clientX - rect.left - size / 2;
        const y = e.clientY - rect.top - size / 2;
        
        ripple.style.width = ripple.style.height = size + 'px';
        ripple.style.left = x + 'px';
        ripple.style.top = y + 'px';
        ripple.classList.add('ripple');
        
        this.appendChild(ripple);
        
        setTimeout(() => {
            ripple.remove();
        }, 600);
    });
});


document.querySelectorAll('.social a').forEach(socialLink => {
    socialLink.addEventListener('mouseenter', function() {
        this.style.transform = 'translateY(-5px) rotate(5deg)';
    });
    
    socialLink.addEventListener('mouseleave', function() {
        this.style.transform = 'translateY(0) rotate(0deg)';
    });
});


window.addEventListener('load', () => {
    document.body.classList.add('loaded');
    
  
    const logo = document.querySelector('.logo');
    logo.style.transform = 'scale(0)';
    setTimeout(() => {
        logo.style.transition = 'transform 0.5s cubic-bezier(0.68, -0.55, 0.265, 1.55)';
        logo.style.transform = 'scale(1)';
    }, 500);
});


const floatingElements = document.querySelectorAll('.floating-element');
floatingElements.forEach((element, index) => {
    element.style.animationDelay = `${index * 0.5}s`;
});


function animateCounter(element, target, duration = 2000) {
    let start = 0;
    const increment = target / (duration / 16);
    
    const timer = setInterval(() => {
        start += increment;
        element.textContent = Math.floor(start);
        
        if (start >= target) {
            element.textContent = target;
            clearInterval(timer);
        }
    }, 16);
}