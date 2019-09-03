/* Initialize our various swiper blocks */

// scolldown arrow for header event listener
(function($) {
  "use strict";

  /**
   * init sliders
   *  */

  // init top slider
  var swiperContainer = document.querySelector(".swiper-container");

  // check if swiperContainer div exist
  if (typeof swiperContainer !== "undefined" && swiperContainer !== null) {
    // get values for create instance
    // If is autoSlide
    var isSlide = $.parseJSON(
      $(".wp-block-futurelab-block-fl-block-slider2 .swiper-wrapper").attr(
        "data-isslide"
      )
    );
    // If is autoplaySpeed
    var autoplaySpeed = $.parseJSON(
      $(".wp-block-futurelab-block-fl-block-slider2 .swiper-wrapper").attr(
        "data-autoplayspeed"
      )
    );
    // If is infiniteLoop
    var infiniteLoop = $.parseJSON(
      $(".wp-block-futurelab-block-fl-block-slider2 .swiper-wrapper").attr(
        "data-infiniteloop"
      )
    );
    // If is show pagination
    var isshowpagination = $.parseJSON(
      $(".wp-block-futurelab-block-fl-block-slider2 .swiper-wrapper").attr(
        "data-isshowpagination"
      )
    );

    // create slider instance
    var swiperSliders = new Swiper(".swiper-container", {
      slidesPerView: 1,
      autoplay: {
        delay: isSlide ? autoplaySpeed : 99999999 // is not autoslide, set delay for 99999999
      },
      spaceBetween: 30,
      loop: infiniteLoop,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
      },
      pagination: {
        el: isshowpagination ? ".swiper-pagination" : "",
        clickable: true
      }
    });
  }

  // init swiperCarousel
  var swiperCarouselContainer = document.querySelector(
    ".swiper-carousel-container"
  );
  // check if swiperContainer div exist
  if (
    typeof swiperCarouselContainer !== "undefined" &&
    swiperCarouselContainer !== null
  ) {
    // get values for create instance
    // If is autoSlide
    var isSlide = $.parseJSON(
      $(".swiper-carousel-container .swiper-wrapper").attr("data-isslide")
    );
    // If is autoplaySpeed
    var autoplaySpeed = $.parseJSON(
      $(".swiper-carousel-container .swiper-wrapper").attr("data-autoplayspeed")
    );
    // If is infiniteLoop
    var infiniteLoop = $.parseJSON(
      $(".swiper-carousel-container .swiper-wrapper").attr("data-infiniteloop")
    );
    // If is show pagination
    var isshowpagination = $.parseJSON(
      $(".swiper-carousel-container .swiper-wrapper").attr(
        "data-isshowpagination"
      )
    );

    console.log(isSlide, autoplaySpeed, infiniteLoop, isshowpagination);
    var swiperCarousels = new Swiper(".swiper-carousel-container", {
      slidesPerView: 1,
      autoplay: {
        delay: isSlide ? autoplaySpeed : 99999999 // is not autoslide, set delay for 99999999
      },
      spaceBetween: 30,
      loop: infiniteLoop,
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev"
      },
      pagination: {
        el: isshowpagination ? ".swiper-pagination" : "",
        clickable: true
      }
    });
  }

  // init swiperCarousel
  var swiperGalleriesContainer = document.querySelector(
    ".swiper-gallery-container"
  );
  // check if swiperContainer div exist
  if (
    typeof swiperGalleriesContainer !== "undefined" &&
    swiperGalleriesContainer !== null
  ) {
    var swiperGalleries = new Swiper(".swiper-gallery-container", {
      pagination: {
        el: ".swiper-pagination",
        clickable: true
      }
    });
  }

  /**
   * When the user scrolls the page, execute addStickyClass
   *  */

  window.onscroll = function() {
    addStickyClass();
  };
  // Get the header
  var header = document.getElementById("masthead");
  // Get the offset position of the navbar
  var sticky = header.offsetTop;
  // Add the sticky class to the header when you reach its scroll position. Remove "sticky" when you leave the scroll position
  function addStickyClass() {
    if (window.pageYOffset > sticky) {
      header.classList.add("sticky-header");
    } else {
      header.classList.remove("sticky-header");
    }
  }

  /**
   * event listener for scroll down in not home page
   *  */
  try {
    var btnScrollDown = document.querySelector(".down-arrow-container");
    var slider = document.querySelector(".banner-header-image");
    // check if element exist
    if (typeof slider !== "undefined" && slider !== null) {
      var scrollDownHeight = slider.clientHeight;
      function scrollDown() {
        (function scroll() {
          // window.scrollTo desnot support IE
          window.scrollTo({
            top: scrollDownHeight - 100,
            left: 0,
            behavior: "smooth"
          });
        })();
      }
      btnScrollDown.addEventListener("click", scrollDown);
    }
  } catch (error) {
    // console.log("slider frontend.js error", error);
  }
})(jQuery);
