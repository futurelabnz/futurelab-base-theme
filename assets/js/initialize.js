/* Initialize our various swiper blocks */

// scolldown arrow for header event listener
(function($) {
  "use strict";

  /**
   * init sliders
   *  */

  // init top slider
  var swiperSliders = $(".wp-block-futurelab-block-fl-block-slider2");

  // check if swiperContainer div exist
  if (typeof swiperSliders !== "undefined" && swiperSliders !== null) {
    $.each(
      $(".wp-block-futurelab-block-fl-block-slider2 .swiper-container"),
      function() {
        // get user configured value for create instance
        // If is autoSlide
        var isSlide = $(this)
          .children(".swiper-wrapper")
          .data("isslide");

        // If is autoplaySpeed
        var autoplaySpeed = $(this)
          .children(".swiper-wrapper")
          .data("autoplayspeed");

        // If is infiniteLoop
        var infiniteLoop = $(this)
          .children(".swiper-wrapper")
          .data("infiniteloop");

        // If is show pagination
        var isshowpagination = $(this)
          .children(".swiper-wrapper")
          .data("isshowpagination");

        var swiper = new Swiper($(this), {
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
    );
  }

  // init swiperCarousel
  var swiperCarousels = document.querySelector(
    ".wp-block-futurelab-block-fl-content-carousel"
  );
  // check if swiperContainer div exist
  if (typeof swiperCarousels !== "undefined" && swiperCarousels !== null) {
    $.each(
      $(
        ".wp-block-futurelab-block-fl-content-carousel .swiper-carousel-container"
      ),
      function() {
        // get user configured value for create instance
        // If is autoSlide
        var isSlide = $(this)
          .children(".swiper-wrapper")
          .data("isslide");

        // If is autoplaySpeed
        var autoplaySpeed = $(this)
          .children(".swiper-wrapper")
          .data("autoplayspeed");

        // If is infiniteLoop
        var infiniteLoop = $(this)
          .children(".swiper-wrapper")
          .data("infiniteloop");

        // If is show pagination
        var isshowpagination = $(this)
          .children(".swiper-wrapper")
          .data("isshowpagination");

        var swiperCarousels = new Swiper($(this), {
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
    );
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

  // Get the header
  var header = document.getElementById("masthead");
  // Get the content
  var content = document.getElementById("content");
  // Get the offset position of the navbar
  var sticky = header.offsetTop;
  var headerHeight = header.offsetHeight;
  var contentHeight = content.offsetHeight;
  var windowInnerHeight = window.innerHeight;

  window.onscroll = function() {
    // if content height greater than window height, if user scroll, add sticky header.
    if (headerHeight + contentHeight > windowInnerHeight) {
      addStickyClass();
    }
  };

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
