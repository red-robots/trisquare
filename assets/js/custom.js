/**
 *	Custom jQuery Scripts
 *	
 *	Developed by: Austin Crane	
 *	Designed by: Austin Crane
 */

jQuery(document).ready(function ($) {
	
	/* Slideshow */
	var swiper = new Swiper('#slideshow', {
		slidesPerView: 1,
		spaceBetween: 0,
		effect: 'slide', /* "fade", "cube", "coverflow" or "flip" */
		loop: true,
		autoplay: {
			delay: 8000,
		},
		pagination: {
			el: '.swiper-pagination',
			clickable: true,
		},
		navigation: {
			nextEl: '.swiper-button-next',
			prevEl: '.swiper-button-prev',
		},
    });
	
	$('[data-fancybox]').fancybox({
		protect: true,
		loop: false,
		buttons : ['close'],
		hash : false,
		afterLoad : function(instance, current) {
			$(".fancybox-content").addClass('padded');
	    }
	});

	$(document).on("click","a.thumbLink",function(e){
		e.preventDefault();
		var parent = $(this).parents(".thumb");
		// var mainImgSrc = $("#photoBig").attr("data-main");
		// var mainImg = '<a href="'+mainImgSrc+'"><img src="'+mainImgSrc+'" alt=""/></a>';
		var url = $(this).attr("href");
		var thumbClass = $(this).attr("data-thumb");
		$("#photoBig a").attr("href",url);
		$("#photoBig a img").attr("src",url);
		$("#photoBig a").attr("data-thumb",thumbClass);

		// var thumb = $(this).attr("data-partner");
		// $(thumb).removeAttr("data-fancybox");
		// var url = $(this).attr("href");
		// $(this).addClass("hide");
		// $(thumb).addClass('hide');

		// var mainImgSrc = $("#photoBig").attr("data-main");
		// var mainImg = '<a href="'+mainImgSrc+'"><img src="'+mainImgSrc+'" alt=""/></a>';
		// parent.find(".gimage").attr("style","background-image:url('"+mainImgSrc+"')");
		// parent.html(mainImg);
		// $("#photoBig a").attr("href",url);
		// $("#photoBig a img").attr("src",url);
	});

	$(document).on("click","#mainPhoto",function(e){
		e.preventDefault();
		var thumbClass = $(this).attr("data-thumb");
		$(thumbClass).trigger("click");
	});


	/*
	*
	*	Colorbox
	*
	------------------------------------*/
	$('a.gallery').colorbox({
		rel:'gal',
		width: '80%', 
		height: '80%'
	});
	

	/*
	*
	*	Wow Animation
	*
	------------------------------------*/
	new WOW().init();


	$(document).on("click","#toggleMenu",function(){
		$(this).toggleClass('open');
		$('.main-navigation').toggleClass('open');
		$('body').toggleClass('menu-open');
	});

	$(".row3.section .gform_wrapper .ginput_container input, .row3.section .gform_wrapper .ginput_container textarea").on("focus",function(){
		var parent = $(this).parents("li");
		var Val = $(this).val();
		parent.find("label.gfield_label").addClass("onfocus");
	});
	$(".row3.section .gform_wrapper .ginput_container input, .row3.section .gform_wrapper .ginput_container textarea").on("focusout blur",function(){
		var parent = $(this).parents("li");
		var Val = $(this).val();
		if(Val) {
			parent.find("label.gfield_label").addClass("onfocus");
			if( Val == '(___) ___-____' ) {
				parent.find("label.gfield_label").removeClass("onfocus");
			}
		} else {
			parent.find("label.gfield_label").removeClass("onfocus");
		}
		
	});

});// END #####################################    END