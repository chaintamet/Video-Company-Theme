/* eslint-disable no-undef */
/* eslint-disable func-names */
// eslint-disable-next-line func-names
(function($) {
  const helper = {
    // custom helper function for debounce - how to work see https://codepen.io/Hyubert/pen/abZmXjm
    /**
     * Debounce
     * need for once call function
     *
     * @param { function } - callback function
     * @param { number } - timeout time (ms)
     * @return { function }
     */
    debounce(func, timeout) {
      let timeoutID;
      // eslint-disable-next-line no-param-reassign
      timeout = timeout || 200;
      return function() {
        const scope = this;
        // eslint-disable-next-line prefer-rest-params
        const args = arguments;
        clearTimeout(timeoutID);
        timeoutID = setTimeout(function() {
          func.apply(scope, Array.prototype.slice.call(args));
        }, timeout);
      };
    },
    /**
     * Helper if element exist then call function
     */
    isElementExist(_el, _cb, _argCb) {
      const elem = document.querySelector(_el);
      if (document.body.contains(elem)) {
        try {
          if (arguments.length <= 2) {
            _cb();
          } else {
            _cb(..._argCb);
          }
        } catch (e) {
          // eslint-disable-next-line no-console
          console.log(e);
        }
      }
    },

    /**
     *  viewportCheckerAnimate function
     *
     * @param whatElement - element name
     * @param whatClassAdded - class name if element is in viewport
     * @param classAfterAnimate - class name after element animates
     */
    viewportCheckerAnimate(whatElement, whatClassAdded, classAfterAnimate) {
      jQuery(whatElement)
        .addClass('a-hidden')
        .viewportChecker({
          classToRemove: 'a-hidden',
          classToAdd: `animated ${whatClassAdded}`,
          offset: 10,
          callbackFunction(elem) {
            if (classAfterAnimate) {
              elem.on('animationend', () => {
                elem.addClass('animation-end');
              });
            }
          }
        });
    },
    // helpler windowResize
    windowResize(functName) {
      const self = this;
      $(window).on('resize orientationchange', self.debounce(functName, 200));
    },
    /**
     * Init slick slider only on mobile device
     *
     * @param {DOM} $slider
     * @param {array} option - slick slider option
     */
    mobileSlider($slider, option) {
      if (window.matchMedia('(max-width: 768px)').matches) {
        if (!$slider.hasClass('slick-initialized')) {
          $slider.slick(option);
        }
      } else if ($slider.hasClass('slick-initialized')) {
        $slider.slick('unslick');
      }
    }
  };

  const theme = {
    /**
     * Main init function
     */
    init() {
      this.plugins(); // Init all plugins
      this.bindEvents(); // Bind all events
      this.initAnimations(); // Init all animations
    },

    /**
     * Init External Plugins
     */
    plugins() {
      // eslint-disable-next-line no-undef
      // $('img[data-src]').lazyload(); // Init Lazyload from https://cdn.jsdelivr.net/npm/lazyload@2.0.0-rc.2/lazyload.js
    },

    /**
     * Bind all events here
     *
     */
    bindEvents() {
      const self = this;
      /** * Run on Document Ready ** */
      $(document).on('ready', function() {
        self.smoothScrollLinks();
        helper.isElementExist('.cpt-list', theme.initCPT);
      });
      /** * Run on Window Load ** */
      $(window).on('scroll', function() {
        if ($(window).scrollTop() >= 50)
          $('.header').addClass('header--sticky');
        else $('.header').removeClass('header--sticky');
      });
    },

    /**
     * init scroll revealing animations function
     */
    initAnimations() {
      helper.viewportCheckerAnimate('.a-up', 'fadeInUp', true);
      helper.viewportCheckerAnimate('.a-down', 'fadeInDown');
      helper.viewportCheckerAnimate('.a-left', 'fadeInLeft');
      helper.viewportCheckerAnimate('.a-right', 'fadeInRight');
      helper.viewportCheckerAnimate('.a-op', 'fade');
    },

    /**
     * Smooth Scroll link
     */
    smoothScrollLinks() {
      $('a[href^="#"').on('click touchstart', function() {
        const target = $(this).attr('href');
        if (target !== '#' && $(target).length > 0) {
          const offset = $(target).offset().top - $('header').outerHeight();
          $('html, body').animate(
            {
              scrollTop: offset
            },
            500
          );
        }
        return false;
      });
    },

    initCPT() {
      const $list = $('.cpt-list');
      const $pagination = $('.pagination');
      function ajaxCPT() {
        const cat = $list.attr('data-cat');
        const post_type = $list.attr('data-post-type');
        const paged = $list.attr('data-paged');
        const posts_per_page = $list.attr('data-posts-per-page');
        const search = $list.attr('data-search');
        const individual = $list.attr('data-individual');
        const sort = $list.attr('data-sort');
        $.ajax({
          url: ajaxurl,
          type: 'POST',
          data: {
            action: 'ajax_cpt',
            post_type,
            sort,
            cat,
            individual,
            posts_per_page
          },
          beforeSend() {
            $('.cpt-projects').css('display', 'none');
            $('.cpt-intelligences').css('display', 'none');
            $list.html(
              '<span class="loader"></span>'
            );
            $pagination.hide();
          },
          success(res) {
            const data = JSON.parse(res);
            $list.html(data.output);
            if (data.max_num_pages > 1) {
              $pagination.html(data.pagination);
              $pagination.show();
            }
            // helper.viewportCheckerAnimate('.a-up', 'fadeInUp', true);
          }
        });
      }

      $('.filter-category').find('.option').on('click', function() {
        $('.filter-dropdown').removeClass('active')
        const text = $(this)[0].innerText;
        const attribute = $(this).attr('value');
        $(this).parent().prev().attr('data-value', attribute)
        $(this).parent().prev().text(text)
        $list.attr('data-cat', attribute);
        // $list.attr('data-sort', $('.filter-sort').find('.filter-btn').attr('data-value'));
        ajaxCPT();
      })
      $('.filter-sort').find('.option').on('click', function() {
        $('.filter-dropdown').removeClass('active')
        const text = $(this)[0].innerText;
        const attribute = $(this).attr('value');
        $(this).parent().prev().attr('data-value', attribute)
        $(this).parent().prev().text(text)
        $list.attr('data-sort', attribute);
        ajaxCPT();
      })
      $('.filter-type').find('.option').on('click', function() {
        $('.filter-dropdown').removeClass('active')
        const text = $(this)[0].innerText;
        const attribute = $(this).attr('value');
        $(this).parent().prev().attr('data-value', attribute)
        $(this).parent().prev().text(text)
        $('.cpt-heading__title').text(text);
        $list.attr('data-post-type', $('.filter-type').find('.filter-btn').attr('data-value'));
        ajaxCPT();
      })
    }
  };

  //Banner Carousel
  if($('.banner').attr('data-count') > 1) {
    $('.banner-carousel').slick({
        dots: true,
        slidesToScroll: 1,
        slidesToShow: 1,
        autoplay: true,
        autoplaySpeed: 3000,
    })
  }

  //Talent
  // window.addEventListener('click', function(e) {
  //   console.log($('.loop-talent__modal.active').find('.loop-talent__modal__content'))
  //   if(!$('.loop-talent__modal.active').find('.loop-talent__modal__content').contains(e.target)) {
  //     $('.loop-talent__modal').removeClass('active');
  //     console.log(2)
  //   }
  // }) 

  $('.loop-talent__plus').on('click', function() {
    $(this).parent().parent().next().toggleClass('active');
  })

  $('.loop-talent__modal__plus').on('click', function() {
    $(this).parent().parent().parent().parent().toggleClass('active');
  })

  //Our Team Carousel
  $('.loop-member__plus').on('click', function() {
    const f = $(this).parent().parent().hasClass('active');
    $('.loop-member__wrapper').removeClass('active');
    if(!f) $(this).parent().parent().addClass('active');
  })

  $('.our-team__carousel').slick({
    dots: true,
    slidesToScroll: 1,
    slidesToShow: 4,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToScroll: 1,
          centerMode: true,
          slidesToShow: 2,
        }
      },
      {
        breakpoint: 640,
        settings: {
          slidesToScroll: 1,
          centerMode: true,
          slidesToShow: 1,
        }
      }
    ]
  })

  //SpotArticles tab
  $('.spotlight-articles__item__title').on('click', function() {

    $('.spotlight-articles__item__content').removeClass('show');
    $(this).next().toggleClass('show');
  })

  if(document.querySelectorAll('.spotlight-articles__item__title').length >= 1)
    document.querySelectorAll('.spotlight-articles__item__title').item(document.querySelectorAll('.spotlight-articles__item__title').length - 1).style.borderBottom = 'none';

  //Most popular carousel
  $('.most-popular__carousel').slick({
    dots: true,
    slidesToScroll: 1,
    slidesToShow: 1,
  })

  //Header hamburger
  $('.header').find('.hamburger').on('click', function() {
    $('.header').toggleClass('is-opened');
  })

  //Projects Carousel

  $('.projects-carousel').slick({
    slidesToScroll: 1,
    slidesToShow: 4,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToScroll: 1,
          centerMode: true,
          slidesToShow: 3,
        }
      },
      {
        breakpoint: 640,
        settings: {
          slidesToScroll: 1,
          centerMode: true,
          slidesToShow: 1,
        }
      }
    ]
  })

  //Intelligence open
  $('.intelligence-normal').on('click', function() {
    $('.intelligence-normal').removeClass('active');
    $(this).addClass('active');
    $('.intelligence-hover').removeClass('active')
    $(this).next().addClass('active');
  })
  $('.intelligence-hover__content').find('.close').on('click', function() {
    $(this).parent().parent().removeClass('active')
    $(this).parent().parent().prev().removeClass('active')
  })

  //Legal accordion
  $('.legal-content__accordion__left__title').on('click', function() {
    $('.legal-content__accordion__left__title').removeClass('active');
    $(this).addClass('active');
    const ind = $(this).attr('title-ind')
    $('.legal-content__accordion__title').removeClass('active');
    $('.legal-content__accordion__content').removeClass('active');
    $(`.legal-content__accordion__title.title_${ind}`).addClass('active');
    $(`.legal-content__accordion__content.content_${ind}`).addClass('active');
  })

  $('.legal-content__accordion__title').on('click', function() {
    const flag = $(this).hasClass('active');
    $('.legal-content__accordion__title').removeClass('active')
    $('.legal-content__accordion__content').removeClass('active')
    if(!flag) {
      $(this).addClass('active');
      $(this).next().addClass('active');
    }
  });

  //Faq Accordion
  $('.faq-title').on('click', function() {
    $('.faq-title').removeClass('active');
    $(this).addClass('active');
    const ind = $(this).attr('tab-index')
    $('.faq-tab__title').removeClass('active')
    $('.faq-tab__accordion').removeClass('active')
    $(`.faq-tab__title.title_${ind}`).addClass('active')
    $(`.faq-tab__accordion.content_${ind}`).addClass('active')
  })
  $('.faq-tab__accordion__title').on('click', function() {
    const is_open = $(this).hasClass('active')
    $('.faq-tab__accordion__title').removeClass('active');
    $('.faq-tab__accordion__content').slideUp('normal');
    if(!is_open) {
      $(this).addClass('active');
      $(this).next().slideToggle('normal');
    }
  })

  //Filter
  $(document).click(function (e) {
    e.stopPropagation();
    const filter = $(".filter");
    const search = $('.header-search');

    //check if the clicked area is dropDown or not
    if ( filter.has(e.target).length === 0 ) {
      $('.filter-dropdown').removeClass('active');
    }
    if ( search.has(e.target).length === 0 ) {
      $('.header-search').removeClass('active');
    }
  })

  $('.filter-btn').on('click', function() {
      $('.filter-dropdown').removeClass('active');
      $(this).next().toggleClass('active');
  })

  //Header Search Form
  $('.header-search__icon').on('click', function() {
    $('.header-search').addClass('active');
  })
  

  // Initialize Theme
  theme.init();
})(jQuery);
