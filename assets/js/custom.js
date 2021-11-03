"use strict";
jQuery(document).ready(function ($) {
  /* Slideshow */
  var swiper = new Swiper('#slideshow', {
    slidesPerView: 1,
    spaceBetween: 0,
    effect: 'slide',

    /* "fade", "cube", "coverflow" or "flip" */
    loop: true,
    autoplay: {
      delay: 4000
    },
    pagination: {
      el: '.swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev'
    }
  });
  $(".gallerySwipe").each(function () {
    var num = $(this).attr("data-id");
    var target = $(this);
    var galleryId = $(this).attr("id");
    var galleryIDSelector = '#' + galleryId;
    var gallerySwiper = new Swiper(galleryIDSelector, {
      slidesPerView: 1,
      spaceBetween: 0,
      effect: 'slide',
      loop: false,
      autoplay: false,
      navigation: {
        nextEl: '.gallery-next' + num,
        prevEl: '.gallery-prev' + num
      }
    });
  }); // $('[data-fancybox]').fancybox({
  // 	protect: true,
  // 	loop: false,
  // 	buttons : ['close','thumbs','fullScreen'],
  // 	hash : false,
  // 	afterLoad : function(instance, current) {
  // 		var closeBtn = "<a href='#' id='closefancyPic'><span>x</span></a>";
  // 		$(".fancybox-content").addClass('padded');
  // 		$(".fancybox-content").append(closeBtn);
  //     },
  //     afterClose: function() {
  //         //alert("Closed!");
  //     },
  //     afterShow : function() {
  //         // $(':button').click(function() {
  //         //     $.fancybox.close();
  //         // })
  //     }
  // });

  $('.gallery-swiper').each(function () {
    var mySwiper = $(this).find(".gallerySwipe");
    $(this).find("a.enlarge").fancybox({
      protect: true,
      loop: false,
      buttons: ['close'],
      hash: false,
      backFocus: false,
      image: {
        preload: true
      },
      fullScreen: {
        autoStart: false
      },
      helpers: {
        overlay: {
          closeClick: false
        }
      },
      keys: {
        close: null
      },
      afterLoad: function afterLoad(instance, current) {},
      afterClose: function afterClose() {}
    });
  }); // $(document).on("click",".gallerypaginate .next",function(e){
  // 	e.preventDefault();
  // 	var parent = $(this).parents(".gallery-swiper");
  // 	parent.find(".gallery-next").trigger("click");
  // });
  // $(document).on("click",".gallerypaginate .prev",function(e){
  // 	e.preventDefault();
  // 	var parent = $(this).parents(".gallery-swiper");
  // 	parent.find(".gallery-prev").trigger("click");
  // });
  // $('.gallerySwipe a.enlarge').fancybox({
  // 	protect: true,
  // 	loop: true,
  // 	hash : false,
  // 	afterLoad : function(instance, current) {var closeBtn = "<a href='#' id='closefancyPic'><span>x</span></a>";
  // 		$(".fancybox-content").addClass('padded');
  // 		$(".fancybox-content").append(closeBtn);
  //     },
  //     afterClose: function() {
  //         //alert("Closed!");
  //     },
  //     afterShow : function() {
  //         // $(':button').click(function() {
  //         //     $.fancybox.close();
  //         // })
  //     }
  // });

  /* Open Pop-up on page load */
  // $(document).ready(function() {
  //        $("#mainPhoto").trigger('click');
  //    });

  $(document).on("click", "#closefancyPic", function (e) {
    e.preventDefault();
    $.fancybox.close();
  });
  $(document).on("click", ".openGalleryBtn", function (e) {
    e.preventDefault();
    var pageURL = $(this).attr("data-url");
    $("#loaderOverlay").addClass("show");
    $("#loadGalleries").load(pageURL + " #gallerySection", function () {
      setTimeout(function () {
        $("#loaderOverlay").fadeIn("slow", function () {
          $(this).removeClass("show");
        });
        $('[data-fancybox]').fancybox({
          protect: true,
          loop: false,
          buttons: ['close', 'thumbs', 'fullScreen'],
          hash: false,
          afterLoad: function afterLoad(instance, current) {
            var closeBtn = "<a href='#' id='closefancyPic'><span>x</span></a>";
            $(".fancybox-content").addClass('padded');
            $(".fancybox-content").append(closeBtn);
          }
        });
        $("#firstGalleryPic").trigger('click');
      }, 800);
    });
  });
  $(document).on("click", "a.thumbLink", function (e) {
    e.preventDefault();
    var parent = $(this).parents(".thumb");
    var url = $(this).attr("href");
    var thumbClass = $(this).attr("data-thumb");
    $("#photoBig a").attr("href", url);
    $("#photoBig a img").attr("src", url);
    $("#photoBig a").attr("data-thumb", thumbClass);
  });
  $(document).on("click", "#mainPhoto", function (e) {
    e.preventDefault();
    var thumbClass = $(this).attr("data-thumb");
    $(thumbClass).trigger("click");
  });
  /*
  *
  *	Wow Animation
  *
  ------------------------------------*/

  new WOW().init();
  $(document).on("click", "#toggleMenu", function () {
    $(this).toggleClass('open');
    $('.main-navigation').toggleClass('open');
    $('body').toggleClass('menu-open');
  });
  $(".contactform .gform_wrapper .ginput_container input, .contactform .gform_wrapper .ginput_container textarea").on("focus", function () {
    var parent = $(this).parents("li");
    var Val = $(this).val();
    parent.find("label.gfield_label").addClass("onfocus");
  });
  $(".contactform .gform_wrapper .ginput_container input, .contactform .gform_wrapper .ginput_container textarea").on("focusout blur", function () {
    var parent = $(this).parents("li");
    var Val = $(this).val();

    if (Val) {
      parent.find("label.gfield_label").addClass("onfocus");

      if (Val == '(___) ___-____') {
        parent.find("label.gfield_label").removeClass("onfocus");
      }
    } else {
      parent.find("label.gfield_label").removeClass("onfocus");
    }
  });
}); // END #####################################    END