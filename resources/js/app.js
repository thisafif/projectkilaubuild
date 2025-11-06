import Alpine from 'alpinejs'

window.Alpine = Alpine

Alpine.start()

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