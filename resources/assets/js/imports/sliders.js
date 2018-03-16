(function () {
  "use strict";

  if($("#top_slick_slider").length > 0) {
    $("#top_slick_slider").slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 1,
      adaptiveHeight: true,
      autoplay: false,
      autoplaySpeed: 3000
    })
  }

  if($("#bottom_slick_slider").length > 0) {
    $("#bottom_slick_slider").slick({
      dots: true,
      arrows: false,
      infinite: false,
      speed: 300,
      slidesToShow: 2,
      slidesToScroll: 2,
      adaptiveHeight: true,
      autoplay: false,
      autoplaySpeed: 3000,
      adaptiveHeight: true,
      responsive: [
        {
          breakpoint: 420,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
      ]
    })
  }

})();