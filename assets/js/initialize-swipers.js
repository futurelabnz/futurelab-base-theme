/* Initialize our various swiper blocks */

/* Sliders (use default container class ) */
var swiperSliders = new Swiper('.swiper-container', {
    slidesPerView: 1,
    spaceBetween: 30,
    loop: true,
    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },
    pagination: '.swiper-pagination'
});

/* Carousels */
var swiperCarousels = new Swiper('.swiper-carousel-container', {
    pagination: {
        el: '.swiper-pagination',
    },
});

/* Galleries */
var swiperGalleries = new Swiper('.swiper-gallery-container', {
    pagination: {
        el: '.swiper-pagination',
    },
});