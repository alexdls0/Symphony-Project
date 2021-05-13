(function ($) {
   "use strict"; 
   $(function () {


    //Product page image slider with thumb (Slick Slider)
    var $product_slider = $(".product-detail-slider");
    var $product_thumb_slider = $(".product-detail-thumbnails");

     $product_slider.slick({
        dots: false,
        fade: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        adaptiveHeight: true,
        asNavFor: $product_thumb_slider,
        infinite: false
    });

    $product_thumb_slider.slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: $product_slider,
        dots: false,
        centerMode: false,
        focusOnSelect: true,
        infinite: false
     }); 

    var thumbPadding = $('.product-detail-thumbnails').find('button').hasClass('slick-arrow');
    if (thumbPadding) {
        $('.product-detail-thumbnails').css('padding-left', '35px');
        $('.product-detail-thumbnails').css('padding-right', '35px');
    }else {
        //$('.product-detail-thumbnails').css('margin-left', '-7px');
        $('.product-detail-thumbnails').css('margin-right', '-10px');
    };
    });
})(jQuery);