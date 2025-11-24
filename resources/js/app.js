import Alpine from "alpinejs";
window.Alpine = Alpine;

Alpine.start();
// DETEK PEMILIK SCROLLBAR
function detectScrollbarOwner() {
    document.querySelectorAll('*').forEach(el => {
        el.addEventListener('scroll', () => {
            console.log('Scrollbar punya elemen ini:', el);
            el.style.outline = '3px solid cyan'; // Kasih highlight biar kelihatan
        }, { passive: true });
    });
}

document.addEventListener('alpine:init', () => {
    queueMicrotask(() => detectScrollbarOwner());
});



import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
    once: true,
    duration: 800,
});

import Swiper from 'swiper';
import { Navigation, Pagination, EffectCoverflow } from 'swiper/modules';

import 'swiper/css';
import 'swiper/css/navigation';
import 'swiper/css/pagination';
import 'swiper/css/effect-coverflow'; 

const swiper1 = new Swiper('.card-portofolio', {
    modules: [Navigation, Pagination, EffectCoverflow],
    effect: 'coverflow',
    grabCursor: true,
    centeredSlides: true,
    loop: true,
    slidesPerView: 'auto',
    
    coverflowEffect: {
      rotate: 50,
      stretch: 0,
      depth: 100,
      modifier: 1,
      slideShadows: true,
    },

    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },
    
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
});

import { EffectCards } from 'swiper/modules'; 

import 'swiper/css';
import 'swiper/css/effect-cards'; 

const swiper2 = new Swiper('.card-testimoni', {
    modules: [EffectCards], 
    effect: 'cards',
    grabCursor: true,
    
    cardsEffect: {
      perSlideOffset: 8,
      perSlideRotate: 2,
      rotate: true,
      slideShadows: true,
    },
});

document.addEventListener("alpine:init", () => {
    const btn = document.getElementById("scrollDown");
    const target = document.getElementById("about");
    const navbar = document.querySelector("nav"); 
    
    if (btn && target && navbar) {
        btn.addEventListener("click", () => {
            const navHeight = navbar.offsetHeight; 
            const targetPos = target.getBoundingClientRect().top + window.pageYOffset;

            window.scrollTo({
                top: targetPos - navHeight,
                behavior: "smooth"
            });
        });
    }
});


document.addEventListener("DOMContentLoaded", () => {
    const hero = document.getElementById("hero");
    if (hero) {
        hero.classList.add("show");
        document.body.style.overflowY = 'hidden';
        setTimeout(() => {
            document.body.style.overflowY = 'auto';
        }, 1800);
    }
});
