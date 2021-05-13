/*
// Created by Admin */
/* - Loader 
   - Cart Popup 
   - Header Fix
   - Image Hover
   - Navigation Menu
   - Tabs With OwlCarousel
   - Backgrounds Image
   - Price Range Sider
   - Grid / List
   - Tooltip
   - Product Quantity
   - Product Filter
   - Owl Slider
   - Counter
   - Portfolio
 */


(function($) {
    "use strict";

    var $window = $(window);
    var $document = $(document);
    var mobilewidth = 992;

    /*******************************************************************/
    /* Loader  */
    /*******************************************************************/
    $window.on("load", function() {
        var delay = $('.loader').data('delay');
        if (delay !== undefined || delay >= 1) {
            delay = delay * 1000;
            setTimeout(function() {
                $('.loader').fadeOut('slow', function() {
                    $(this).remove();
                });
            }, delay);
        }
        else {
            $('.loader').fadeOut('slow', function() {
                $(this).remove();
            });
        }

        $('.capsule-row').hover(function() {
            var bgUrl = $(this).data('bg');
            if (bgUrl !== '' || bgUrl !== undefined) {
                $(this).closest('.search-table').css('background-image', 'url("' + bgUrl + '")');
            }
        });
        $('.search-table').mouseleave(function() {
            $(this).closest('.search-table').css('background-image', 'none');
        });

        $('.my-paroller').paroller();

        if (typeof $().slick !== "undefined") {
            let prevArr = $('.prev-img-gallery');
            let nextArr = $('.next-img-gallery');
            $('.slick-gallery').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 2000,
                arrows: false,
                draggable: true,
                adaptiveHeight: true,
                arrows: false,
            });
        }

    });

    if (typeof $("#videoPlayer").YTPlayer !== "undefined") {
        $("#videoPlayer").YTPlayer();
    }

    $('.do-search').click(function(e) {
        let s = $(this).prev().val().trim();
        if (s === '' || s === undefined) {
            e.preventDefault();
        }

    });



    $(document).ready(function() {
        // Add smooth scrolling to all links
        $("a").on('click', function(event) {

            // Make sure this.hash has a value before overriding default behavior
            if (this.hash !== "") {
                // Prevent default anchor click behavior
                event.preventDefault();

                // Store hash
                var hash = this.hash;

                // Using jQuery's animate() method to add smooth page scroll
                // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 1500, function() {

                    // Add hash (#) to URL when done scrolling (default click behavior)
                    window.location.hash = hash;
                });
            } // End if
        });
    });
    /*******************************************************************/
    /* Cart Popup  */
    /*******************************************************************/
    $(function() {

        var cart_sidebar_btn = $('.cart-sidebar-btn');
        var cart_sidebar = $('.cart-sidebar');
        var cart_sidebar_overlay = $('.cart-sidebar-overlay');
        var cart_sidebar_close = $('.cart-sidebar-close');
        /*cart sidebar toggle*/
        cart_sidebar_btn.on('click', function() {
            $(this).toggleClass('active');
            cart_sidebar.toggleClass('cart-sidebar-open');
            cart_sidebar_overlay.toggleClass('cart-sidebar-overlay-active');

        });

        /*cart sidebar close*/
        cart_sidebar_close.on('click', function() {
            cart_sidebar_btn.removeClass('active');
            cart_sidebar.removeClass('cart-sidebar-open');
            cart_sidebar_overlay.removeClass('cart-sidebar-overlay-active');
        });

        /*cart sidebar overlay active*/
        $document.on('click touchstart', '.cart-sidebar-overlay-active', function() {
            cart_sidebar_btn.toggleClass('active');
            cart_sidebar.toggleClass('cart-sidebar-open');
            cart_sidebar_overlay.toggleClass('cart-sidebar-overlay-active');
        });
    });

    /********************************************************************/
    /* Header Fix  */
    /*******************************************************************/
    $window.on("scroll", function() {
        if ($window.width() >= parseInt(mobilewidth, 10)) {
            if ($(window).scrollTop() >= parseInt(100, 10)) {
                $(".header-fix").addClass("header-fix-active");
            }
            else {
                $(".header-fix").removeClass("header-fix-active");
            }
        }
    });


    /********************************************************************/
    /* Image Hover  */
    /*******************************************************************/
    $(function() {
        $('.product-image-wraper').on('mouseenter', function(e) {
            var hover_product_img = $(this).find('img').attr('data-src');
            var product_img = $(this).find('img').attr('src');
            $(this).find('img').attr('data-src', product_img);
            $(this).find('img').attr('src', hover_product_img);

        });
        $('.product-image-wraper').on('mouseleave', function(e) {
            var hover_product_img = $(this).find('img').attr('data-src');
            var product_img = $(this).find('img').attr('src');
            $(this).find('img').attr('data-src', product_img);
            $(this).find('img').attr('src', hover_product_img);
        });
    });
    /*******************************************************************/
    /* Navigation Menu  */
    /*******************************************************************/
    $(function() {
        $(".menu > ul").before("<a href=\"#\" class=\"mobile-menu\">Menu</a>");
        $(".submenu > li:has( > ul)").addClass('child_submenu');

        $(".menu > ul > li").on('click', function() {
            if ($window.width() <= parseInt(mobilewidth)) {
                if ($(this).hasClass("active")) {
                    $(".menu > ul > li.active").find(".dropdown").fadeToggle('fast');
                    $(".menu > ul > li.active").removeClass('active');
                }
                else {
                    $(".menu > ul > li.active").find(".dropdown").fadeToggle('slow');
                    $(".menu > ul > li.active").removeClass('active');
                    $(this).find(".dropdown").fadeToggle('slow');
                    $(this).addClass('active');
                }
            }
        });

        $('.mobile-menu').on('click', function(e) {
            e.preventDefault();
            $(".menu").toggleClass('menu-active');
            $(".menu > ul").toggleClass('mobile-menu-active');
            $(".menu > ul > li").removeClass('active');
            $(".menu > ul > li").find(".dropdown").slideUp();
        });

    });
    /*******************************************************************/
    /* Tabs With OwlCarousel  */
    /*******************************************************************/
    $('a[data-toggle="tab"]').on('shown.bs.tab', function(e) {
        $($(e.target).attr('href'))
            .find('.carousel-item-4')
            .owlCarousel('invalidate', 'width')
            .owlCarousel('update')
    });
    /*******************************************************************/
    /* Backgrounds Image  */
    /*******************************************************************/
    var PageHtmlImgae = $('.slider-bg-image,.bg-image,.parallex-image');
    PageHtmlImgae.each(function() {
        if ($(this).attr("data-background-img")) {
            $(this).css("background-image", "url(" + $(this).data("background-img") + ")");
        }
        if ($(this).attr("data-bg-position")) {
            $(this).css("background-position", $(this).data("bg-position"));
        }
        if ($(this).attr("data-height")) {
            $(this).css("height", $(this).data("height") + 'px');
        }
    });
    /*******************************************************************/
    /* Price Range Sider  */
    /*******************************************************************/
    $(function() {
        var min_price = $('#price_range_min').attr('data-min'),
            max_price = $('#price_range_max').attr('data-max');

        $(".price-range-slider").slider({
            range: true,
            min: 0,
            max: 999,
            values: [min_price, max_price],
            step: 10,
            slide: function(event, ui) {
                $("#price-range-from-to").html("Price : <span class='from'>$" + parseInt(ui.values[0], 10) + "</span> &mdash; <span class='to'>$" + parseInt(ui.values[1], 10));
                $("#price_range_min").val(parseInt(ui.values[0], 10));
                $("#price_range_max").val(parseInt(ui.values[1], 10));
            }
        });

        $("#price-range-from-to").html("Price : <span class='from'>$" + $(".price-range-slider").slider("values", 0) + "</span> &mdash; <span class='to'>$" + $(".price-range-slider").slider("values", 1) + "</span>");
        $("#price_range_min").val($(".price-range-slider").slider("values", 0));
        $("#price_range_max").val($(".price-range-slider").slider("values", 1));
    });
    /*******************************************************************/
    /* Grid / List  */
    /*******************************************************************/
    $(function() {
        var ListBtn = $('.product-list-icon');
        var GridBtn = $('.product-grid-icon');
        var productWrapper = $('.product-grid-list-wrapper');

        ListBtn.on('click', function(event) {
            event.preventDefault();
            productWrapper.addClass('product-list-icon');
            ListBtn.addClass('product-active-icon')
            GridBtn.removeClass('product-active-icon')
        });
        GridBtn.on('click', function(event) {
            event.preventDefault();
            productWrapper.removeClass('product-list-icon');
            ListBtn.removeClass('product-active-icon')
            GridBtn.addClass('product-active-icon')
        });
    });
    /*******************************************************************/
    /* Tooltip */
    /*******************************************************************/
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    });
    /*******************************************************************/
    /* Product Quantity  */
    /*******************************************************************/
    $(function() {
        var qty_min = parseInt($('.qty').attr("min"), 10);
        var qty_max = parseInt($('.qty').attr("max"), 10);

        $(".qtyplus-btn").on('click', function() {
            var currentVal = parseInt($(this).parent().find(".qty").val(), 10);
            var str = $("p:first").text();
            if (currentVal != qty_max) {
                $(this).parent().find(".qty").val(currentVal + 1);
            }
        });

        $(".qtyminus-btn").on('click', function() {
            var currentVal = parseInt($(this).parent().find(".qty").val(), 10);
            if (currentVal != qty_min) {
                $(this).parent().find(".qty").val(currentVal - 1);
            }
        });
    });
    /*******************************************************************/
    /* Product Filter  */
    /*******************************************************************/
    $(function() {
        /* color */
        $('.color-box-wrapper .color-box').on('click', function() {
            $(this).parent().find('.active').removeClass('active');
            $(this).addClass('active');
        });

        /* size */
        $('.size-box-wrapper .size-box').on('click', function() {
            $(this).parent().find('.active').removeClass('active');
            $(this).addClass('active');
        });

    });
    /*******************************************************************/
    /* Owl Slider  */
    /*******************************************************************/
    $(function() {
        $('#owl-slider').owlCarousel({
            autoplay: true,
            autoplayTimeout: 6000,
            autoplayHoverPause: true,
            singleItem: true,
            dots: false,
            nav: true,
            items: 1,
            loop: true,
            autoHeight: true,
            animateIn: 'fadeIn',
            animateOut: 'fadeOut',
            navText: [
                '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            responsive: {
                0: {
                    nav: false,
                    dots: true
                },
                600: {
                    nav: false,
                    dots: true
                },
                1000: {
                    nav: true,
                    dots: false
                }
            }
        });
    });

    $(function() {
        //Product Item 5
        $('.carousel-item-5').owlCarousel({
            items: 5,
            loop: false,
            margin: 30,
            autoplay: false,
            autoplayHoverPause: true,
            singleItem: true,
            dots: false,
            nav: true,
            navText: [
                '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            responsive: {
                0: { items: 1 },
                320: { items: 1 },
                480: { items: 2 },
                771: { items: 3 },
                991: { items: 4 },
                1170: { items: 5 }
            }
        });

        //Product Item 4
        $('.carousel-item-4').owlCarousel({
            items: 4,
            loop: false,
            margin: 30,
            autoplay: false,
            autoplayHoverPause: true,
            singleItem: true,
            dots: false,
            nav: true,
            navText: [
                '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            responsive: {
                0: { items: 1 },
                320: { items: 1 },
                480: { items: 2 },
                775: { items: 2 },
                991: { items: 3 },
                1170: { items: 4 }
            }
        });

        //Product Item 3
        $('.carousel-item-3').owlCarousel({
            items: 3,
            loop: false,
            margin: 30,
            autoplay: false,
            autoplayHoverPause: true,
            singleItem: true,
            dots: false,
            nav: true,
            navText: [
                '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            responsive: {
                0: { items: 1 },
                480: { items: 2 },
                771: { items: 2 },
                991: { items: 3 },
                1170: { items: 3 }
            }
        });

        //Product Item 2
        $('.carousel-item-2').owlCarousel({
            items: 2,
            loop: false,
            margin: 30,
            autoplay: false,
            autoplayHoverPause: true,
            singleItem: true,
            dots: false,
            nav: true,
            navText: [
                '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            responsive: {
                0: { items: 1 },
                480: { items: 2 },
                771: { items: 2 },
                991: { items: 2 },
                1170: { items: 2 }
            }
        });

        //Product Item 1
        $('.carousel-item-1').owlCarousel({
            items: 1,
            loop: false,
            margin: 30,
            autoplay: false,
            autoplayHoverPause: true,
            singleItem: true,
            dots: false,
            nav: true,
            navText: [
                '<i class="fa fa-angle-left" aria-hidden="true"></i>',
                '<i class="fa fa-angle-right" aria-hidden="true"></i>'
            ],
            responsive: {
                0: { items: 1 },
                480: { items: 1 },
                775: { items: 1 },
                991: { items: 1 },
                1170: { items: 1 }
            }
        });

        //Product Item 3
        $('.testimonial-carousel-3').owlCarousel({
            items: 3,
            loop: false,
            margin: 30,
            autoplay: false,
            autoplayHoverPause: true,
            singleItem: true,
            dots: true,
            nav: false,
            responsive: {
                0: { items: 1 },
                480: { items: 1 },
                775: { items: 2 },
                991: { items: 3 },
                1170: { items: 3 }
            }
        });

        //Product Item 2
        $('.testimonial-carousel-2').owlCarousel({
            items: 2,
            loop: false,
            margin: 30,
            autoplay: false,
            autoplayHoverPause: true,
            singleItem: true,
            dots: true,
            nav: false,
            responsive: {
                0: { items: 1 },
                480: { items: 1 },
                775: { items: 1 },
                991: { items: 2 },
                1170: { items: 2 }
            }
        });
        //Testimonial Item 1
        $('.testimonial-carousel-1').owlCarousel({
            items: 1,
            loop: false,
            margin: 30,
            autoplay: false,
            autoplayHoverPause: true,
            singleItem: true,
            dots: true,
            nav: false,
            responsive: {
                0: { items: 1 },
                480: { items: 1 },
                775: { items: 1 },
                991: { items: 1 },
                1170: { items: 1 }
            }
        });

        //Logo Carousel 7
        $('.logo-carousel-7').owlCarousel({
            items: 7,
            loop: true,
            margin: 30,
            autoplay: true,
            autoplayHoverPause: true,
            singleItem: true,
            dots: false,
            nav: false,
            transitionStyle: true,
            responsive: {
                0: { items: 1 },
                250: { items: 1 },
                320: { items: 2 },
                480: { items: 3 },
                775: { items: 4 },
                991: { items: 6 },
                1170: { items: 7 }
            }
        });
        //Logo Carousel 6
        $('.logo-carousel-6').owlCarousel({
            items: 6,
            loop: true,
            margin: 30,
            autoplay: true,
            autoplayHoverPause: true,
            singleItem: true,
            dots: false,
            nav: false,
            transitionStyle: true,
            responsive: {
                0: { items: 1 },
                250: { items: 1 },
                320: { items: 2 },
                480: { items: 3 },
                775: { items: 4 },
                991: { items: 5 },
                1170: { items: 6 }
            }
        });
        //Logo Carousel 5
        $('.logo-carousel-5').owlCarousel({
            items: 5,
            loop: true,
            margin: 30,
            autoplay: true,
            autoplayHoverPause: true,
            singleItem: true,
            dots: false,
            nav: false,
            transitionStyle: true,
            responsive: {
                0: { items: 1 },
                250: { items: 1 },
                320: { items: 2 },
                480: { items: 3 },
                775: { items: 4 },
                991: { items: 5 },
                1170: { items: 5 }
            }
        });
    });
    /*******************************************************************/
    /* Counter  */
    /*******************************************************************/
    $(function() {
        $(".counter").appear(function() {
            var counter = $(this);
            var var_from = parseInt(0, 10);
            var var_speed = parseInt(1500, 10);
            var var_refresh = parseInt(80, 10);

            counter.countTo({
                from: var_from,
                to: counter.attr('data-count'),
                speed: var_speed,
                refreshInterval: var_refresh,
            });
        });
    });
    /*******************************************************************/
    /* Newsletter Popup  */
    /*******************************************************************/
    $(function() {
        var popup_cookie_expires = parseInt(1, 10);
        var popup_btn_delay = parseInt(2000, 10);

        $('.newsletter-popup-close').on('click', function(e) {
            $.cookie('newsletter-popup', 'newsletter-close', { expires: popup_cookie_expires, path: '/' });
            e.preventDefault();
        });

        if ($.cookie('newsletter-popup') != 'newsletter-close') {
            setTimeout(function() { $('.newsletter-popup-btn').trigger('click'); }, popup_btn_delay);
        }
    });
    /*******************************************************************/
    /* Portfolio  */
    /*******************************************************************
    $(function() {
        $('.portfolio-grid').isotope({
            itemSelector: '.portfolio-grid-item',
        });

        // filter items on button click
        $('.portfolio-filter-group').on('click', 'li a', function() {

            var filterValue = $(this).attr('data-filter');

            $('.portfolio-grid').isotope({
                filter: filterValue
            });

            $('.portfolio-filter-group li a').removeClass('active');
            $(this).addClass('active');
        });

        $('.portfolio-link').magnificPopup({
            //delegate: 'a', // the selector for gallery item
            type: 'image',
            tLoading: 'Loading image #%curr%...',
            gallery: {
                enabled: true
            },
            image: {
                tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
                titleSrc: function(item) {
                    return item.el.attr('title');
                }
            }
        });

    });
    /*******************************************************************/

})(jQuery);
