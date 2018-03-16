(function () {
  "use strict";

  $(document).on("scroll", e => {
    const scrollPosition = $(window).scrollTop();
    if (scrollPosition > 500) {
        $('#back-to-top').stop().animate({
            'bottom': '62px',
            'opacity': 1
        }, 300, "easeOutQuart");
    } else if (scrollPosition < 500) {
        $('#back-to-top').stop().animate({
            'bottom': '-40px',
            'opacity': 0
        }, 300, "easeInQuart");
    }
  });

  $('.animate-top').on('click', e => {
      e.preventDefault();
      $('body,html').animate({ scrollTop: 0 }, 800, 'easeOutCubic');
  });

  $("#language_selector").bind("change", (e) => {
    const locale = $(e.currentTarget).val();
    let current_url = window.location.pathname;
    const parts = current_url.split("/");
    const a_name = parts[1] ? parts[2] : "";
    let url = "/" + locale + "/" + a_name;
    if(typeof(a_name) === 'undefined') {
        url = "/" + locale;
    }
    location.href = url;
  });


  $('.v-animation').each((i, v) => {
    let animatedItem = $(v),
        itemAnimation = animatedItem.data('animation'),
        itemDelay = animatedItem.data('delay');
    animatedItem.appear(() => {
        if (itemAnimation == 'fade-from-left') {
            animatedItem.delay(itemDelay).animate({
                'opacity': 1,
                'left': '0px'
            }, 600, 'easeOutCubic');
        } else if (itemAnimation == 'fade-from-right') {
            animatedItem.delay(itemDelay).animate({
                'opacity': 1,
                'right': '0px'
            }, 600, 'easeOutCubic');
        } else if (itemAnimation == 'fade-from-bottom') {
            {
                animatedItem.delay(itemDelay).animate({
                    'opacity': 1,
                    'bottom': '0px'
                }, 600, 'easeOutCubic');
            }
        } else if (itemAnimation == 'fade-in') {
            animatedItem.delay(itemDelay).animate({
                'opacity': 1
            }, 600, 'easeOutCubic');
        } else if (itemAnimation == 'grow') {
            setTimeout(function () {
                animatedItem.addClass('v-animate');
            }, itemDelay);
        } else {
            setTimeout(function () {
                animatedItem.addClass('v-animate');
            }, itemDelay);
        }
    }, { accX: 0, accY: -150 }, 'easeInCubic');

    });

})();