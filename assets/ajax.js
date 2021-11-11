jQuery(document).ready(function ($) {
	
  $("#galleriesMoreBtn").click( function(e) {
    e.preventDefault(); 
    var button = $(this);
    var posttype = $(this).attr("data-posttype");
    var paged = $(this).attr("data-currentpage");
    var next_page = parseInt(paged) + 1;
    var perpage = $(this).attr("data-perpage");
    var taxonomy = $(this).attr("data-taxonomy");
    var termid = $(this).attr("data-termid");
    var totalpages = $(this).attr("data-totalpages");
    var index = $(this).attr("data-index");

    jQuery.ajax({
      type : "post",
      dataType : "json",
      url : myAjax.ajaxurl,
      data : {
        action : "get_gallery_entries", 
        "posttype" : posttype, 
        "paged" : paged, 
        "perpage" : perpage,
        "taxonomy" : taxonomy,
        "termid" : termid,
        "totalpages" : totalpages,
        "index" : index
      },
      beforeSend: function() {
        $("#loaderOverlay").show();
        button.attr("data-currentpage",next_page);
      },
      success: function(response) {
        setTimeout(function(){
          $("#loaderOverlay").hide();
        },300);

        if(response.result) {
          $("#gallery-entries").append(response.result);
        } 
        if(response.show_more_button==false) {
          button.remove();
        } 
      },
      error: function(xhr) { // if error occured
        //console.log(xhr.statusText + xhr.responseText);
      },
      complete: function() {

        const observer = lozad();
        observer.observe();
        
        $(".gallery-swiper.new .gallerySwipe").each(function () {
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
        });

        $('.gallery-swiper.new').each(function () {
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
        });
        

      },
    });
  });

});