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

const portofolioSliderEl = document.querySelector('.card-portofolio');

if (portofolioSliderEl) {
        const slideCount = Number(portofolioSliderEl.dataset.slideCount ?? 0);
        const hasMultipleSlides = slideCount > 1;
        const enableLoop = slideCount > 2;

        new Swiper(portofolioSliderEl, {
                modules: [Navigation, Pagination, EffectCoverflow],
                effect: enableLoop ? 'coverflow' : 'slide',
                grabCursor: hasMultipleSlides,
                centeredSlides: hasMultipleSlides,
                loop: enableLoop,
                slidesPerView: enableLoop ? 'auto' : 1,
                observer: true,
                observeParents: true,
                loopAdditionalSlides: enableLoop ? Math.min(slideCount, 5) : 0,
                allowTouchMove: hasMultipleSlides,

                coverflowEffect: {
                        rotate: enableLoop ? 30 : 0,
                        stretch: 0,
                        depth: 100,
                        modifier: 1,
                        slideShadows: enableLoop,
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
}

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
