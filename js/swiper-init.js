const swiper = new Swiper('.swiper', {

  effect: "fade",
  fadeEffect: { crossFade: true },
  speed: 1500,
  slidesPerView: 1,
  autoplay: { delay: 5000 },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },

});