$(document).ready(function () {
  $('.slick-container').slick({
    autoplay: true,
    arrows: true,
    centerMode: true,
    centerPadding: '60px',
    slidesToShow: 3,
    responsive: [{
        breakpoint: 800,
        settings: {
          arrows: true,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 2
        }
      },
      {
        breakpoint: 550,
        settings: {
          arrows: false,
          centerMode: true,
          centerPadding: '40px',
          slidesToShow: 1
        }
      }
    ]
  });

  $('.institucional-slide-container').slick({
    autoplay: true,
    arrows: true,
    dots: true,
    adaptiveHeight: true,
  });
});