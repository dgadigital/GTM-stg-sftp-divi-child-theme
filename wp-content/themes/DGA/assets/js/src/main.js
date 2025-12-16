// Default JS entry file
// Default JS entry file
import $ from 'jquery';
import 'slick-carousel';

// ===============================================================
// 🔥 Divi Scroll Hijacker Killer (FINAL WORKING VERSION)
// ===============================================================


(function($){
    const _slick = $.fn.slick;
    $.fn.slick = function(settings){
        if (!this.length) {
            console.warn("⚠ Slick skipped — no element for selector:", this.selector);
            return this;
        }
        return _slick.call(this, settings);
    };
})(jQuery);


// 🧹 Prevent multiple Bootstrap event bindings
if (!window._bootstrapCollapsePatched) {
  window._bootstrapCollapsePatched = true;

  document.addEventListener('DOMContentLoaded', () => {
    const nav = document.getElementById('mobileNav');
    if (!nav) return;

    // Ensure only one collapse instance exists
    const existingInstance = bootstrap.Collapse.getInstance(nav);
    if (existingInstance) existingInstance.dispose();

    // Reinitialize cleanly (Bootstrap still honors data attributes)
    const collapseInstance = new bootstrap.Collapse(nav, { toggle: false });

    // Debug events (will now fire once each)
    nav.addEventListener('show.bs.collapse', () => console.log('opening'));
    nav.addEventListener('hide.bs.collapse', () => console.log('closing'));

    // Inline style cleanup for animation
    nav.addEventListener('shown.bs.collapse', e => (e.target.style.height = ''));
    nav.addEventListener('hide.bs.collapse', e => (e.target.style.height = ''));
    nav.addEventListener('hidden.bs.collapse', e => {
      e.target.classList.remove('show');
      e.target.style.height = '';
    });
  });
}


jQuery(document).ready(function($) {
  const $navbar = $('.navbar');
  if (!$navbar.length) return;

  let scrolledOnce = false;

  $(window).on('scroll', function() {
    if ($(this).scrollTop() > 50) { // threshold for when effect starts
      $navbar.addClass('scrolled');
      scrolledOnce = true;
    } else if (scrolledOnce) {
      $navbar.removeClass('scrolled');
    }
  });
});



// ==========================================================================
// Desktop & Mobile Dropdown Handling (Scoped for Mobile Structure)
// ==========================================================================

jQuery(function ($) {

  const $mobileNav = $('.navbar.d-lg-none');
  if (!$mobileNav.length) return;

  // ---------- LEVEL 1: Toggle main dropdown (About Us, Services, etc.) ----------
  $mobileNav.on('click', '> .container-fluid .dropdown-wrapper > .dropdown-toggle', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const $toggle = $(this);
    const $item   = $toggle.closest('.nav-item.dropdown');
    const $menu   = $item.children('.dropdown-menu.box-style');

    if ($menu.length) {
      // Close other open level-1 menus
      $item.siblings('.nav-item.dropdown').find('.dropdown-menu.show')
        .removeClass('show')
        .slideUp(200);

      // Toggle this menu
      $menu.stop(true, true).slideToggle(200).toggleClass('show');

      // Update aria-expanded
      $toggle.attr('aria-expanded', $menu.hasClass('show'));
    }
  });

  // ---------- LEVEL 2: Toggle submenus (PR - Australia → Sydney, etc.) ----------
  $mobileNav.on('click', '.dropdown-item-inner > .dropdown-toggle', function (e) {
    e.preventDefault();
    e.stopPropagation();

    const $toggle  = $(this);
    const $wrapper = $toggle.closest('.dropdown-item-wrapper');
    const $submenu = $wrapper.children('.dropdown-submenu');

    if ($submenu.length) {
      // Close other submenus at same level
      $wrapper.siblings('.dropdown-item-wrapper')
        .find('.dropdown-submenu.show')
        .removeClass('show')
        .slideUp(200);

      // Toggle this submenu
      $submenu.stop(true, true).slideToggle(200).toggleClass('show');

      // Update aria-expanded
      $toggle.attr('aria-expanded', $submenu.hasClass('show'));
    }
  });

  // ---------- GLOBAL: Close everything when clicking outside ----------
  $(document).on('click', function (e) {
    if (!$(e.target).closest('.navbar.d-lg-none .dropdown, .navbar.d-lg-none .dropdown-menu').length) {
      $('.navbar.d-lg-none .dropdown-menu.show, .navbar.d-lg-none .dropdown-submenu.show')
        .removeClass('show')
        .slideUp(200);
      $('.navbar.d-lg-none .dropdown-toggle[aria-expanded="true"]').attr('aria-expanded', 'false');
    }
  });
});




document.addEventListener("DOMContentLoaded", function () {
  const nav = document.getElementById("mobileNav");

  if (nav) {
    // clean up Bootstrap inline styles so animation can finish
    nav.addEventListener("shown.bs.collapse", (e) => {
      e.target.style.height = "";
    });

    nav.addEventListener("hide.bs.collapse", (e) => {
      // remove Bootstrap’s inline height so CSS can animate close
      e.target.style.height = "";
    });

    nav.addEventListener("hidden.bs.collapse", (e) => {
      // safety net — force it back to real closed state
      e.target.classList.remove("show");
      e.target.style.height = "";
    });
  }
});

jQuery(document).ready(function($) {
  if (!$('.logoslider').length) return;

  $('.logoslider').each(function() {
    const $slider = $(this);
    const rows = parseInt($slider.data('rows')) || 1; // default 1 row

    $slider.slick({
      slidesToShow: 6,
      slidesToScroll: 3,
      arrows: false,
      dots: true,
      autoplay: true,
      autoplaySpeed: 2000,
      infinite: true,
      rows: rows, // 👈 dynamic rows support
      responsive: [
        {
          breakpoint: 991,
          settings: {
            slidesToShow: 3,
            slidesToScroll: 3,
            rows: rows
          }
        },
        {
          breakpoint: 767,
          settings: {
            slidesToShow: 1,
            slidesToScroll: 1,
            rows: 1 // usually single row on mobile
          }
        }
      ]
    });
  });
});

jQuery(document).ready(function ($) {
  if (!$('.hover-slider').length) return;

  $('.hover-slider').slick({
    dots: false,
    arrows: false,
    infinite: true,
    speed: 400,
    slidesToShow: 3,
    slidesToScroll: 3,
    rows: 2,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2,
          rows: 2
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1,
          rows: 1
        }
      }
    ]
  });
});



function applySlickInner(e, slick) {
  const $slider = $(slick.$slider);
  // Let Slick finish DOM tweaks this tick
  requestAnimationFrame(() => {
    $slider.find('.slick-track .slick-slide').each(function () {
      $(this).children('div').each(function () {
        const $child = $(this);
        if (!$child.attr('class')) {
          $child.addClass('slick-inner');
        }
      });
    });
  });
}

function moveSlickArrows(e, slick) {
  const $slider = slick.$slider; // the specific carousel instance

  // Run after Slick’s DOM changes for this tick
  requestAnimationFrame(() => {
    // Reuse or create wrapper right after THIS slider
    let $wrapper = $slider.next('.button-wrapper');
    if (!$wrapper.length) {
      $wrapper = $('<div class="button-wrapper"></div>').insertAfter($slider);
    }

    // Move the actual arrows Slick knows about
    if (slick.$prevArrow && slick.$prevArrow.length) {
      slick.$prevArrow.appendTo($wrapper);
    }
    if (slick.$nextArrow && slick.$nextArrow.length) {
      slick.$nextArrow.appendTo($wrapper);
    }
  });
}






// Attach BEFORE init
jQuery(document).ready(function ($) {
  const $carousels = $('.carousel');
  if (!$carousels.length) return;

  $carousels.each(function () {
    const $carousel = $(this);
    const layout = $carousel.data('layout') || '1x3';

    // Parse layout (example: "2x3")
    const [rows, cols] = layout.split('x').map(Number);

    // Defaults
    const rowsFinal = rows || 1;
    const colsFinal = cols || 3;

    // Attach slick event hooks
    $carousel
      .on('init reInit breakpoint setPosition', applySlickInner)   // ← HERE
      .on('init reInit breakpoint setPosition', moveSlickArrows)  // ← HERE
      .slick({
        rows: rowsFinal,
        slidesToShow: colsFinal,
        slidesToScroll: 1,
        prevArrow:
          '<button type="button" class="slick-prev">swipe left to navigate</button>',
        nextArrow:
          '<button type="button" class="slick-next">swipe right to navigate</button>',
        responsive: [
          {
            breakpoint: 992,
            settings: {
              slidesToShow: Math.min(colsFinal, 1),
            }
          },
          {
            breakpoint: 776,
            settings: {
              slidesToShow: 1,
              rows: 1
            }
          }
        ]
      });
  });
});


jQuery(function($) {
  $('.section-card-slider').slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    infinite: true,
    arrows: false,
    dots: false,
    swipe: true,
    mobileFirst: true,
  });
});


// ==================================================================================================


jQuery(document).ready(function ($) {
  // Shared slider settings
  const testimonial_slickSettings = {
    dots: true,
    arrows: false,
    slidesToShow: 2,
    slidesToScroll: 1,
    adaptiveHeight: true,
    infinite: true,
    autoplay: false,
    responsive: [
      {
        breakpoint: 767,
        settings: { slidesToShow: 1 }
      }
    ]
  };

  const case_study_slickSettings = {
    dots: true,
    arrows: false,
    slidesToShow: 3,
    slidesToScroll: 1,
    adaptiveHeight: true,
    infinite: true,
    autoplay: false,
    responsive: [
      {
        breakpoint: 991,
        settings: { slidesToShow: 2 }
      },
      {
        breakpoint: 767,
        settings: { slidesToShow: 1 }
      }
    ]
  };

  // Initialize Testimonial Slider
  if ($('.testimonial-slider').length && !$('.testimonial-slider').hasClass('slick-initialized')) {
    $('.testimonial-slider').slick(testimonial_slickSettings);
  }
  // Initialize Testimonial Slider
  

  

  

  // Initialize Case Study Slider
  if ($('.case-study-slider').length && !$('.case-study-slider').hasClass('slick-initialized')) {
    $('.case-study-slider').slick(case_study_slickSettings);
  }
});


document.querySelectorAll('.grid-section .item').forEach(item => {
  const video = item.querySelector('.bg-video');
  if (!video) return;

  item.addEventListener('mouseenter', () => {
    video.play();
  });

  item.addEventListener('mouseleave', () => {
    video.pause();
  });
});


jQuery(document).ready(function ($) {
  const $leadershipSlider = $('.leadership-fullwidth-automatic-slider .is-slider');

  if ($leadershipSlider.length && !$leadershipSlider.hasClass('slick-initialized')) {
    $leadershipSlider.slick({
      slidesToShow: 5.35,           // 5 full + right-side peek
      slidesToScroll: 1,
      infinite: true,              // ✅ infinite loop stays on
      autoplay: true,
      autoplaySpeed: 3000,
      speed: 600,
      cssEase: 'ease',
      arrows: false,
      dots: false,
      pauseOnHover: true,
      centerMode: false,           // ❗ disable centering
      variableWidth: false,        // keep equal widths
      responsive: [
        { breakpoint: 992,  settings: { slidesToShow: 2.5 } },
        { breakpoint: 768,  settings: { slidesToShow: 1.5 } },
        { breakpoint: 480,  settings: { slidesToShow: 1 } }
      ]
    });
  }
});


document.querySelectorAll('.hero-video-banner').forEach(section => {
  const video  = section.querySelector('.hero-bg-video');
  const button = section.querySelector('.video-toggle');
  if (!video || !button) return;

  // Keep the class in sync with the real video state
  const sync = () => {
    const isPlaying = !video.paused && !video.ended && video.currentTime > 0;
    section.classList.toggle('playing', isPlaying);
  };

  // Initial sync after metadata is ready (duration/currentTime available)
  if (video.readyState >= 1) {
    sync();
  } else {
    video.addEventListener('loadedmetadata', sync, { once: true });
  }

  // Also handle common playback state events
  video.addEventListener('playing',  sync);
  video.addEventListener('play',     sync);
  video.addEventListener('pause',    sync);
  video.addEventListener('ended',    sync);

  // Button toggles play/pause
  button.addEventListener('click', () => {
    if (video.paused) {
      const p = video.play();
      if (p && typeof p.catch === 'function') p.catch(() => {}); // ignore autoplay block errors
    } else {
      video.pause();
    }
  });
});



jQuery(function ($) {

    

    /* ===========================================================
       1) INITIALISE SLIDER (1 active card at a time)
    ============================================================ */
    if (!$('.two-column-card-slider').length) return;
    const slider = $('.two-column-card-slider');

    /**  ⛔ Prevent Slick init if slider not present */
    
    

    slider.slick({
        dots: true,
        arrows: false,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true,
        infinite: true,
        autoplay: false
    });



    /* ===========================================================
       2) GLOBAL STOP ALL VIDEOS + RESET CLASSES
    ============================================================ */
    function pauseAll() {
        $('.testimonial-video').each(function () {
            this.pause();
            $(this)
                .closest('.video-wrapper')
                .removeClass('playing')
                .addClass('paused');
        });
    }



    /* ===========================================================
       3) CLICK HANDLER — ONLY ACTIVE SLIDE CAN PLAY
    ============================================================ */
    slider.on('click', '.video-wrapper', function () {

        const wrap  = $(this);                          // element clicked
        const video = wrap.find('video')[0];            // video inside
        const slide = wrap.closest('.slick-slide');     // slide wrapper

        if (!video) return;

        // ❌ ignore cloned or inactive slides
        if (!slide.hasClass('slick-current') || slide.hasClass('slick-cloned')) {
            console.log("⛔ Blocked — Slide not active or is cloned");
            return;
        }

        // ▶ play or ⏸ pause logic
        if (video.paused) {
            pauseAll();
            video.play();
            wrap.addClass('playing').removeClass('paused');
            console.log("▶ PLAY");
        } else {
            video.pause();
            wrap.removeClass('playing').addClass('paused');
            console.log("⏸ PAUSE");
        }
    });



    /* ===========================================================
       4) SLIDE EVENTS — STOP EVERYTHING WHEN SLIDE MOVES
    ============================================================ */
    slider.on('beforeChange', function(e, slick, currentIndex, nextIndex){
        console.log(`⚠ beforeChange | ${currentIndex} → ${nextIndex}`);
        pauseAll();                                   // required behaviour
        console.log("📌 slide changed → all paused");
    });

    slider.on('afterChange', function(e, slick, currentIndex){
        console.log(`✅ afterChange | now active index = ${currentIndex}`);
    });

});





jQuery(function ($) {

  // OPEN FIRST ITEM ON LOAD
  const $first = $(".accordion-item").first().find(".accordion-content");
  const firstHeight = $first[0].scrollHeight;
  $first.css("height", firstHeight + "px").addClass("show")
        .prev(".accordion-header").addClass("open");


  $(".accordion-header").on("click", function () {
    const $header = $(this);
    const $panel = $header.next(".accordion-content");
    const $container = $header.closest(".accordion-container");

    // close others
    $container.find(".accordion-content.show").not($panel).each(function () {
      slideUp($(this));
      $(this).prev(".accordion-header").removeClass("open");
    });

    // toggle this one
    if ($panel.hasClass("show")) {
      slideUp($panel);
      $header.removeClass("open");
    } else {
      slideDown($panel);
      $header.addClass("open");
    }
  });


function slideDown($el) {
  $el.addClass("show");

  // Step 1: get initial height
  let startHeight = $el[0].scrollHeight;
  $el.css("height", startHeight + "px");

  // Step 2: wait for CSS padding transition to apply, then re-measure
  setTimeout(() => {
    let fullHeight = $el[0].scrollHeight;  // now includes padding
    $el.css("height", fullHeight + "px");
  }, 150); // tweak if needed (0.15s syncs perfectly with .35s ease)
}


  function slideUp($el) {
    const height = $el[0].scrollHeight;
    $el.css("height", height + "px");

    requestAnimationFrame(() => {
      $el.css("height", "0px");
    });

    $el.removeClass("show");
  }

});

