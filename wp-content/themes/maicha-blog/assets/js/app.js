 $ = jQuery.noConflict();

 extendnav();
// Menu dropdown on hover
function extendnav() {
    jQuery('#primary-nav .dropdown').hover(function () {
        // Use show(), hide() instead of fade(), fadeOut().
        // Fade causes dropdown to wobble if mouse hover activity is faster..
        // Not a bug cause fade takes time to show() or hide() the element.
        // But show(), hide() does not take time to handle the same event
        $(this).children('.dropdown-menu').stop(true, true).show().addClass('slow fadeIn');
        $(this).toggleClass('open');
    }, function () {
        $(this).children('.dropdown-menu').stop(true, true).hide().removeClass('slow fadeIn');
        $(this).toggleClass('open');
    });
}

$('.top-article').slick({
    infinite: true,
    autoplaySpeed: 7000,
    arrows: false,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [
        {
          breakpoint: 990,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            infinite: true,
          }
        },
        {
          breakpoint: 768,
          settings: {
            slidesToShow: 2,
            slidesToScroll: 2
          }
        },
        {
          breakpoint: 600,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1
          }
        }
    ]
  });


$('.split-slider-wrap').slick({
    dots: false,
    infinite: true,
    speed: 500,
    arrows: false,
   centerMode: false,
  slidesToShow: 1,
  autoplay: true,
});

$('.editor-picks').slick({
    dots: false,
    infinite: true,
    speed: 500,
    arrows: false,
});


$('.bottom-slider-nav').slick({
  slidesToShow: 3,
  slidesToScroll: 1,
  dots: false,
  arrows: false,
  vertical: true,
  focusOnSelect: true
});

$('.product-slider-wrap').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    speed: 500,
    arrows: false
});


$('.post-format-gallery').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    speed: 500,
    autoplay: true,
    arrows: false,
});

$('.small-banner-wrap.fourcolumn').slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    speed: 500,
    autoplay: true,
    arrows: false,
    responsive: [
        {
            breakpoint: 990,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});

$('.small-banner-wrap.threecolumn').slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    speed: 500,
    autoplay: true,
    arrows: false,
    responsive: [
        {
            breakpoint: 990,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});

$('.small-banner-wrap.twocolumn').slick({
    slidesToShow: 2,
    slidesToScroll: 1,
    speed: 500,
    autoplay: true,
    arrows: false,
    responsive: [
        {
            breakpoint: 990,
            settings: {
                slidesToShow: 3,
                slidesToScroll: 1,
                infinite: true,
            }
        },
        {
            breakpoint: 768,
            settings: {
                slidesToShow: 2,
                slidesToScroll: 1
            }
        },
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});



  /*****Load function start*****/
  $(window).load(function(){
jQuery(".slides .slide:first-child").addClass("slide--current");


  });

jQuery(window).scroll(function() {
  if (jQuery(this).scrollTop() > 100) {
        jQuery('.scroll-to-top').fadeIn();
    } else {
      jQuery('.scroll-to-top').fadeOut();
    }
});

jQuery('.scroll-to-top').on('click', function(e) {
  e.preventDefault();
    jQuery('html, body').animate({scrollTop : 0}, 800);
});
