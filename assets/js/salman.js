(function ($) {

  "use strict";



  /*-- Checkout Accoradin --*/

  if ($(".checkout-page__payment__title").length) {

    $(".checkout-page__payment__item")

      .find(".checkout-page__payment__content")

      .hide();

    $(".checkout-page__payment__item--active")

      .find(".checkout-page__payment__content")

      .show();

    $(".checkout-page__payment__title").on("click", function (e) {

      e.preventDefault();

      $(this)

        .parents(".checkout-page__payment")

        .find(".checkout-page__payment__item")

        .removeClass("checkout-page__payment__item--active");

      $(this)

        .parents(".checkout-page__payment")

        .find(".checkout-page__payment__content")

        .slideUp();

      $(this).parent().addClass("checkout-page__payment__item--active");

      $(this).parent().find(".checkout-page__payment__content").slideDown();

    });

  }



  let dynamicyearElm = $(".dynamic-year");

  if (dynamicyearElm.length) {

    let currentYear = new Date().getFullYear();

    dynamicyearElm.html(currentYear);

  }



  // Date Picker

  if ($(".growim-datepicker").length) {

    $(".growim-datepicker").each(function () {

      $(this).datepicker();

    });

  }



  // Popular Causes Progress Bar

  if ($(".count-bar").length) {

    $(".count-bar").appear(

      function () {

        var el = $(this);

        var percent = el.data("percent");

        $(el).css("width", percent).addClass("counted");

      }, {

        accY: -50

      }

    );

  }



  //Fact Counter + Text Count

  if ($(".count-box").length) {

    $(".count-box").appear(

      function () {

        var $t = $(this),

          n = $t.find(".count-text").attr("data-stop"),

          r = parseInt($t.find(".count-text").attr("data-speed"), 10);



        if (!$t.hasClass("counted")) {

          $t.addClass("counted");

          $({

            countNum: $t.find(".count-text").text()

          }).animate({

            countNum: n

          }, {

            duration: r,

            easing: "linear",

            step: function () {

              $t.find(".count-text").text(Math.floor(this.countNum));

            },

            complete: function () {

              $t.find(".count-text").text(this.countNum);

            }

          });

        }

      }, {

        accY: 0

      }

    );

  }



  // custom coursor

  if ($(".custom-cursor").length) {

    var cursor = document.querySelector(".custom-cursor__cursor");

    var cursorinner = document.querySelector(".custom-cursor__cursor-two");

    var a = document.querySelectorAll("a");



    document.addEventListener("mousemove", function (e) {

      var x = e.clientX;

      var y = e.clientY;

      cursor.style.transform = `translate3d(calc(${e.clientX}px - 50%), calc(${e.clientY}px - 50%), 0)`;

    });



    document.addEventListener("mousemove", function (e) {

      var x = e.clientX;

      var y = e.clientY;

      cursorinner.style.left = x + "px";

      cursorinner.style.top = y + "px";

    });



    document.addEventListener("mousedown", function () {

      cursor.classList.add("click");

      cursorinner.classList.add("custom-cursor__innerhover");

    });



    document.addEventListener("mouseup", function () {

      cursor.classList.remove("click");

      cursorinner.classList.remove("custom-cursor__innerhover");

    });



    a.forEach((item) => {

      item.addEventListener("mouseover", () => {

        cursor.classList.add("custom-cursor__hover");

      });

      item.addEventListener("mouseleave", () => {

        cursor.classList.remove("custom-cursor__hover");

      });

    });

  }



  if ($(".contact-form-validated").length) {

    $(".contact-form-validated").validate({

      // initialize the plugin

      rules: {

        name: {

          required: true

        },

        email: {

          required: true,

          email: true

        },

        message: {

          required: true

        },

        subject: {

          required: true

        }

      },

      submitHandler: function (form) {

        // sending value with ajax request

        $.post(

          $(form).attr("action"),

          $(form).serialize(),

          function (response) {

            $(form).parent().find(".result").append(response);

            $(form).find('input[type="text"]').val("");

            $(form).find('input[type="email"]').val("");

            $(form).find("textarea").val("");

          }

        );

        return false;

      }

    });

  }



  // mailchimp form

  if ($(".mc-form").length) {

    $(".mc-form").each(function () {

      var Self = $(this);

      var mcURL = Self.data("url");

      var mcResp = Self.parent().find(".mc-form__response");



      Self.ajaxChimp({

        url: mcURL,

        callback: function (resp) {

          // appending response

          mcResp.append(function () {

            return '<p class="mc-message">' + resp.msg + "</p>";

          });

          // making things based on response

          if (resp.result === "success") {

            // Do stuff

            Self.removeClass("errored").addClass("successed");

            mcResp.removeClass("errored").addClass("successed");

            Self.find("input").val("");



            mcResp.find("p").fadeOut(10000);

          }

          if (resp.result === "error") {

            Self.removeClass("successed").addClass("errored");

            mcResp.removeClass("successed").addClass("errored");

            Self.find("input").val("");



            mcResp.find("p").fadeOut(10000);

          }

        }

      });

    });

  }



  if ($(".video-popup").length) {

    $(".video-popup").magnificPopup({

      type: "iframe",

      mainClass: "mfp-fade",

      removalDelay: 160,

      preloader: true,



      fixedContentPos: false

    });

  }



  if ($(".img-popup").length) {

    var groups = {};

    $(".img-popup").each(function () {

      var id = parseInt($(this).attr("data-group"), 10);



      if (!groups[id]) {

        groups[id] = [];

      }



      groups[id].push(this);

    });



    $.each(groups, function () {

      $(this).magnificPopup({

        type: "image",

        closeOnContentClick: true,

        closeBtnInside: false,

        gallery: {

          enabled: true

        }

      });

    });

  }



  function dynamicCurrentMenuClass(selector) {

    let FileName = window.location.href.split("/").reverse()[0];



    selector.find("li").each(function () {

      let anchor = $(this).find("a");

      if ($(anchor).attr("href") == FileName) {

        $(this).addClass("current");

      }

    });

    // if any li has .current elmnt add class

    selector.children("li").each(function () {

      if ($(this).find(".current").length) {

        $(this).addClass("current");

      }

    });

    // if no file name return

    if ("" == FileName) {

      selector.find("li").eq(0).addClass("current");

    }

  }



  if ($(".main-menu__list").length) {

    // dynamic current class

    let mainNavUL = $(".main-menu__list");

    dynamicCurrentMenuClass(mainNavUL);

  }



  if ($(".main-menu").length && $(".mobile-nav__container").length) {

    let navContent = document.querySelector(".main-menu").innerHTML;

    let mobileNavContainer = document.querySelector(".mobile-nav__container");

    mobileNavContainer.innerHTML = navContent;

  }



  if ($(".sticky-header").length) {

    $(".sticky-header")

      .clone()

      .insertAfter(".sticky-header")

      .addClass("sticky-header--cloned");

  }



  if ($(".mobile-nav__container .main-menu__list").length) {

    let dropdownAnchor = $(

      ".mobile-nav__container .main-menu__list .dropdown > a"

    );

    dropdownAnchor.each(function () {

      let self = $(this);

      let toggleBtn = document.createElement("BUTTON");

      toggleBtn.setAttribute("aria-label", "dropdown toggler");

      toggleBtn.innerHTML = "<i class='fa fa-angle-down'></i>";

      self.append(function () {

        return toggleBtn;

      });

      self.find("button").on("click", function (e) {

        e.preventDefault();

        let self = $(this);

        self.toggleClass("expanded");

        self.parent().toggleClass("expanded");

        self.parent().parent().children("ul").slideToggle();

      });

    });

  }

  if ($(".popup-nav__container .main-menu__list").length) {

    let dropdownAnchor = $(

      ".popup-nav__container .main-menu__list .dropdown > a"

    );

    dropdownAnchor.each(function () {

      let self = $(this);

      let toggleBtn = document.createElement("BUTTON");

      toggleBtn.setAttribute("aria-label", "dropdown toggler");

      toggleBtn.innerHTML = "<i class='flaticon-right-angle'></i>";

      self.append(function () {

        return toggleBtn;

      });

      self.find("button").on("click", function (e) {

        e.preventDefault();

        let self = $(this);

        self.toggleClass("expanded");

        self.parent().toggleClass("expanded");

        self.parent().parent().children("ul").slideToggle();

      });

    });

  }



  //Show Popup menu

  $(document).on("click", ".megamenu-clickable--toggler > a", function (e) {

    $("body").toggleClass("megamenu-popup-active");

    $(this).parent().find("ul").toggleClass("megamenu-clickable--active");

    e.preventDefault();

  });

  $(document).on("click", ".megamenu-clickable--close", function (e) {

    $("body").removeClass("megamenu-popup-active");

    $(".megamenu-clickable--active").removeClass("megamenu-clickable--active");

    e.preventDefault();

  });



  if ($(".mobile-nav__toggler").length) {

    $(".mobile-nav__toggler").on("click", function (e) {

      e.preventDefault();

      $(".mobile-nav__wrapper").toggleClass("expanded");

      $("body").toggleClass("locked");

    });

  }

  if ($(".popup-nav__toggler").length) {

    $(".popup-nav__toggler").on("click", function (e) {

      e.preventDefault();

      $(".popup-nav__wrapper").toggleClass("expanded");

      $("body").toggleClass("locked");

    });

  }



  if ($(".search-toggler").length) {

    $(".search-toggler").on("click", function (e) {

      e.preventDefault();

      $(".search-popup").toggleClass("active");

      $(".mobile-nav__wrapper, .popup-nav__wrapper").removeClass("expanded");

      $("body").toggleClass("locked");

    });

  }

  if ($(".mini-cart__toggler").length) {

    $(".mini-cart__toggler").on("click", function (e) {

      e.preventDefault();

      $(".mini-cart").toggleClass("expanded");

      $(".mobile-nav__wrapper, .popup-nav__wrapper").removeClass("expanded");

      $("body").toggleClass("locked");

    });

  }

  if ($(".odometer").length) {

    $(".odometer").appear(function (e) {

      var odo = $(".odometer");

      odo.each(function () {

        var countNumber = $(this).attr("data-count");

        $(this).html(countNumber);

      });

    });

  }



  if ($(".wow").length) {

    var wow = new WOW({

      boxClass: "wow", // animated element css class (default is wow)

      animateClass: "animated", // animation css class (default is animated)

      mobile: true, // trigger animations on mobile devices (default is true)

      live: true // act on asynchronously loaded content (default is true)

    });

    wow.init();

  }



  if ($("#donate-amount__predefined").length) {

    let donateInput = $("#donate-amount");

    $("#donate-amount__predefined")

      .find("li")

      .on("click", function (e) {

        e.preventDefault();

        let amount = $(this).find("a").text();

        donateInput.val(amount);

        $("#donate-amount__predefined").find("li").removeClass("active");

        $(this).addClass("active");

      });

  }



  //accrodion

  if ($(".growim-accrodion").length) {

    var accrodionGrp = $(".growim-accrodion");

    accrodionGrp.each(function () {

      var accrodionName = $(this).data("grp-name");

      var Self = $(this);

      var accordion = Self.find(".accrodion");

      Self.addClass(accrodionName);

      Self.find(".accrodion .accrodion-content").hide();

      Self.find(".accrodion.active").find(".accrodion-content").show();

      accordion.each(function () {

        $(this)

          .find(".accrodion-title")

          .on("click", function () {

            if ($(this).parent().hasClass("active") === false) {

              $(".growim-accrodion." + accrodionName)

                .find(".accrodion")

                .removeClass("active");

              $(".growim-accrodion." + accrodionName)

                .find(".accrodion")

                .find(".accrodion-content")

                .slideUp();

              $(this).parent().addClass("active");

              $(this).parent().find(".accrodion-content").slideDown();

            }

          });

      });

    });

  }



  $(".add").on("click", function () {

    if ($(this).prev().val() < 999) {

      $(this)

        .prev()

        .val(+$(this).prev().val() + 1);

    }

  });



  $(".sub").on("click", function () {

    if ($(this).next().val() > 0) {

      if ($(this).next().val() > 0)

        $(this)

        .next()

        .val(+$(this).next().val() - 1);

    }

  });



  if ($(".tabs-box").length) {

    $(".tabs-box .tab-buttons .tab-btn").on("click", function (e) {

      e.preventDefault();

      var target = $($(this).attr("data-tab"));



      if ($(target).is(":visible")) {

        return false;

      } else {

        target

          .parents(".tabs-box")

          .find(".tab-buttons")

          .find(".tab-btn")

          .removeClass("active-btn");

        $(this).addClass("active-btn");

        target

          .parents(".tabs-box")

          .find(".tabs-content")

          .find(".tab")

          .fadeOut(0);

        target

          .parents(".tabs-box")

          .find(".tabs-content")

          .find(".tab")

          .removeClass("active-tab");

        $(target).fadeIn(300);

        $(target).addClass("active-tab");

      }

    });

  }



  if ($(".range-slider-price").length) {

    var priceRange = document.getElementById("range-slider-price");



    noUiSlider.create(priceRange, {

      start: [30, 150],

      limit: 200,

      behaviour: "drag",

      connect: true,

      range: {

        min: 10,

        max: 200

      }

    });



    var limitFieldMin = document.getElementById("min-value-rangeslider");

    var limitFieldMax = document.getElementById("max-value-rangeslider");



    priceRange.noUiSlider.on("update", function (values, handle) {

      (handle ? $(limitFieldMax) : $(limitFieldMin)).text(values[handle]);

    });

  }



  function thmOwlInit() {

    // owl slider

    let growimowlCarousel = $(".growim-owl__carousel");

    if (growimowlCarousel.length) {

      growimowlCarousel.each(function () {

        let elm = $(this);

        let options = elm.data("owl-options");

        let thmOwlCarousel = elm.owlCarousel(

          "object" === typeof options ? options : JSON.parse(options)

        );

        elm.find("button").each(function () {

          $(this).attr("aria-label", "carousel button");

        });

      });

    }

    let growimowlCarouselNav = $(".growim-owl__carousel--custom-nav");

    if (growimowlCarouselNav.length) {

      growimowlCarouselNav.each(function () {

        let elm = $(this);

        let owlNavPrev = elm.data("owl-nav-prev");

        let owlNavNext = elm.data("owl-nav-next");

        $(owlNavPrev).on("click", function (e) {

          elm.trigger("prev.owl.carousel");

          e.preventDefault();

        });



        $(owlNavNext).on("click", function (e) {

          elm.trigger("next.owl.carousel");

          e.preventDefault();

        });

      });

    }



    let growimowlCarouselWithCounter = $(

      ".growim-owl__carousel--with-counter"

    );

    if (growimowlCarouselWithCounter.length) {

      growimowlCarouselWithCounter.each(function () {

        let elm = $(this);

        let options = elm.data("owl-options");



        function addLeadingZero(num, size) {

          num = num.toString();

          while (num.length < size) num = "0" + num;

          return num;

        }

        elm

          .on("initialized.owl.carousel", function (event) {

            var idx = event.item.index;

            var carousel = event.relatedTarget;

            var carouselCount = carousel.items().length;



            if (!event.namespace) {

              return;

            }



            elm.append(

              '<div class="growim-owl__carousel__counter"><span class="growim-owl__carousel__counter__current"></span><span class="growim-owl__carousel__counter__total"></span></div>'

            );

            elm

              .find(".growim-owl__carousel__counter__current")

              .text(

                addLeadingZero(carousel.relative(carousel.current()) + 1, 2)

              );

            elm

              .find(".growim-owl__carousel__counter__total")

              .text(addLeadingZero(carouselCount, 2));

          })

          .owlCarousel(

            "object" === typeof options ? options : JSON.parse(options)

          )

          .on("changed.owl.carousel", function (event) {

            var carousel = event.relatedTarget;

            elm

              .find(".growim-owl__carousel__counter__current")

              .text(

                addLeadingZero(carousel.relative(carousel.current()) + 1, 2)

              );

          });

      });

    }

  }



  function thmTinyInit() {

    // tiny slider

    const tinyElm = document.querySelectorAll(".thm-tiny__slider");

    tinyElm.forEach(function (tinyElm) {

      const tinyOptions = JSON.parse(tinyElm.dataset.tinyOptions);

      let thmTinySlider = tns(tinyOptions);

    });

  }  



  function growimSlickInit() {

    // slick slider

    let growimslickCarousel = $(".growim-slick__carousel");

    if (growimslickCarousel.length) {

      growimslickCarousel.each(function () {

        let elm = $(this);

        let options = elm.data("slick-options");

        let growimslickCarousel = elm.slick(

          "object" === typeof options ? options : JSON.parse(options)

        );

      });

    }

  }

  /*-- Flipster Carousel --*/
// این کد را در یک فایل جدید به نام flipster-fix.js ذخیره کنید
// و آن را قبل از salman.js در صفحه خود وارد کنید

(function() {
  // تعریف یک تابع کمکی برای بررسی اینکه آیا یک متغیر تعریف شده است
  function isDefined(variable) {
      return typeof variable !== 'undefined' && variable !== null;
  }
  
  // وقتی صفحه کاملاً بارگذاری شد
  window.addEventListener('DOMContentLoaded', function() {
      // بررسی اینکه jQuery موجود است
      if (isDefined(window.jQuery)) {
          // اگر پلاگین flipster وجود ندارد، یک نسخه جایگزین ایجاد کنید
          if (!isDefined(jQuery.fn.flipster)) {
              // ایجاد یک تابع flipster جایگزین که هیچ کاری انجام نمی‌دهد
              jQuery.fn.flipster = function(options) {
                  // نمایش پیام هشدار (می‌توانید این خط را حذف کنید اگر نمی‌خواهید هیچ پیامی نمایش داده شود)
                  console.log('پلاگین Flipster بارگذاری نشده است. المان‌ها بدون افکت نمایش داده می‌شوند.');
                  
                  // اگر قصد دارید برخی از المان‌ها را نمایش دهید، می‌توانید کد زیر را اضافه کنید:
                  this.css('display', 'block'); // یا هر استایل دیگری که مناسب است
                  
                  // یا می‌توانید جایگزینی ساده برای اسلایدر ایجاد کنید:
                  /*
                  this.addClass('simple-slider');
                  this.find('li, .item').css({
                      'display': 'inline-block',
                      'margin': '0 10px'
                  });
                  */
                  
                  // برگرداندن شیء jQuery برای زنجیره‌سازی
                  return this;
              };
              
              // همچنین می‌توانید رویدادهای مرتبط با flipster را تعریف کنید
              jQuery.fn.flipster.methods = {};
          }
          
          // مخفی کردن خطاهای مرتبط با flipster در کنسول
          const originalConsoleError = console.error;
          console.error = function() {
              // تبدیل آرگومان‌ها به یک رشته برای بررسی آسان‌تر
              const errorString = Array.from(arguments).join(' ');
              
              // اگر این خطا مربوط به flipster است، آن را نمایش ندهید
              if (errorString.includes('flipster is not a function')) {
                  return;
              }
              
              // سایر خطاها را به روش معمول نمایش دهید
              return originalConsoleError.apply(console, arguments);
          };
          
          // جایگزینی برای توابع مرتبط با flipster که ممکن است در salman.js فراخوانی شوند
          const originalPortfolioFourCarousel = $('#portfolio-four__carousel');
          if (originalPortfolioFourCarousel.length) {
              // اینجا می‌توانید در صورت نیاز تنظیمات ساده‌ای را اعمال کنید
              originalPortfolioFourCarousel.css({
                  'display': 'flex',
                  'flex-wrap': 'wrap',
                  'justify-content': 'center'
              });
              
              originalPortfolioFourCarousel.find('.item, li').css({
                  'flex': '0 0 auto',
                  'margin': '0 15px 15px',
                  'max-width': '300px'
              });
          }
      }
  });
})();
/**
 * Main JavaScript File
 * 
 * Contains common functions and initialization code
 * 
 * @package Salman Educational Complex
 * @version 5.0
 */

(function ($) {
  "use strict";

  // Handle page loader
  $(window).on('load', function() {
      // Hide preloader
      $('.page-loader').fadeOut(500, function() {
          $(this).remove();
      });
  });

  // Initialize WOW.js for animations
  if (typeof WOW === 'function') {
      new WOW().init();
  }

  // Back to top button
  var backToTopButton = document.getElementById("backToTop");
  if (backToTopButton) {
      window.addEventListener("scroll", function() {
          if (window.pageYOffset > 300) {
              backToTopButton.classList.add("active");
          } else {
              backToTopButton.classList.remove("active");
          }
      });

      backToTopButton.addEventListener("click", function() {
          window.scrollTo({
              top: 0,
              behavior: "smooth"
          });
      });
  }

  // Custom cursor
  if ($('.custom-cursor').length) {
      var cursor = document.querySelector('.custom-cursor__cursor');
      var cursorTwo = document.querySelector('.custom-cursor__cursor-two');
      var links = document.querySelectorAll('a, button');

      document.addEventListener('mousemove', function(e) {
          cursor.style.transform = `translate3d(calc(${e.clientX}px - 50%), calc(${e.clientY}px - 50%), 0)`;
          cursorTwo.style.transform = `translate3d(calc(${e.clientX}px - 50%), calc(${e.clientY}px - 50%), 0)`;
      });

      links.forEach(function(link) {
          link.addEventListener('mouseenter', function() {
              cursor.classList.add('active');
              cursorTwo.classList.add('active');
          });
          link.addEventListener('mouseleave', function() {
              cursor.classList.remove('active');
              cursorTwo.classList.remove('active');
          });
      });

      document.addEventListener('mousedown', function() {
          cursor.classList.add('click');
          cursorTwo.classList.add('click');
      });
      document.addEventListener('mouseup', function() {
          cursor.classList.remove('click');
          cursorTwo.classList.remove('click');
      });
  }
  
  // Mobile menu toggle
  $('.mobile-nav__toggler').on('click', function(e) {
      e.preventDefault();
      $('.mobile-nav__wrapper').toggleClass('expanded');
      $('body').toggleClass('locked');
  });
  
  // Dropdown toggles in mobile menu
  $('.mobile-nav__wrapper .dropdown-btn').on('click', function(e) {
      e.preventDefault();
      var target = $(this).next('.mobile-nav__wrapper .sub-menu');
      $(this).toggleClass('expanded');
      $(target).slideToggle(500);
  });
  
  // Header sticky on scroll
  var headerHeight = $('.main-header').outerHeight();
  if ($('.stricky').length) {
      var strickyScrollPos = headerHeight + 100;
      var stricky = $('.stricky');
      if ($(window).scrollTop() > strickyScrollPos) {
          stricky.addClass('stricky-fixed');
          $('.main-header').addClass('main-header-dark');
      } else if ($(this).scrollTop() <= strickyScrollPos) {
          stricky.removeClass('stricky-fixed');
          $('.main-header').removeClass('main-header-dark');
      }
  }
  
  $(window).on('scroll', function() {
      if ($('.stricky').length) {
          var strickyScrollPos = headerHeight + 100;
          var stricky = $('.stricky');
          if ($(window).scrollTop() > strickyScrollPos) {
              stricky.addClass('stricky-fixed');
              $('.main-header').addClass('main-header-dark');
          } else if ($(this).scrollTop() <= strickyScrollPos) {
              stricky.removeClass('stricky-fixed');
              $('.main-header').removeClass('main-header-dark');
          }
      }
  });
  
  // Form validation
  $(document).on('submit', 'form', function() {
      var form = $(this);
      if (form.attr('novalidate') !== undefined) {
          return;
      }
      
      form.find('input,textarea,select').each(function() {
          var field = $(this);
          if (field.attr('required') !== undefined) {
              if (field.val() === '') {
                  field.addClass('is-invalid');
              } else {
                  field.removeClass('is-invalid');
              }
          }
      });
      
      if (form.find('.is-invalid').length > 0) {
          // Scroll to first invalid field
          $('html, body').animate({
              scrollTop: form.find('.is-invalid').first().offset().top - 100
          }, 500);
          return false;
      }
  });
  
  // Remove invalid class on input change
  $(document).on('change input', 'input,textarea,select', function() {
      if ($(this).val() !== '') {
          $(this).removeClass('is-invalid');
      }
  });
  
  // Language switcher
  $('.language-switcher .dropdown-menu a').on('click', function(e) {
      e.preventDefault();
      var lang = $(this).data('lang');
      var currentUrl = window.location.href;
      
      // Update URL with new language parameter
      if (currentUrl.indexOf('lang=') > -1) {
          currentUrl = currentUrl.replace(/lang=[a-z]{2}/i, 'lang=' + lang);
      } else if (currentUrl.indexOf('?') > -1) {
          currentUrl += '&lang=' + lang;
      } else {
          currentUrl += '?lang=' + lang;
      }
      
      window.location.href = currentUrl;
  });
  
  // Handle document uploads - show filename
  $('input[type="file"]').on('change', function() {
      var fileName = $(this).val().split('\\').pop();
      if (fileName) {
          $(this).parent().find('.form-file__text').text(fileName);
      } else {
          $(this).parent().find('.form-file__text').text($(this).attr('placeholder'));
      }
  });
  
  // Add custom behavior for form fields with conditional logic
  $('[data-toggle-field]').on('change', function() {
      var target = $(this).data('toggle-field');
      var value = $(this).data('toggle-value');
      
      if ($(this).val() === value || ($(this).is(':checkbox') && $(this).is(':checked'))) {
          $('#' + target).slideDown(300);
      } else {
          $('#' + target).slideUp(300);
      }
  });
  
  // Initialize fields with conditional logic
  $('[data-toggle-field]').each(function() {
      $(this).trigger('change');
  });
  
})(jQuery); 
})(jQuery);