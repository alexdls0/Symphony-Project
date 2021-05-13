$(document).ready(function() {

    if (typeof $("#accordion").accordion === "function") {
        $("#accordion").accordion({
            collapsible: true,
            active: 1,
        });
    }

    /**
     * Checking if slick is loaded before running slick()
     */
    if (typeof $(".account-tab-header").slick === "function") {
        $('.account-tab-header').slick({
            infinite: false,
            speed: 300,
            slidesToShow: 1,
            centerMode: false,
            variableWidth: true,
            arrows: false,
            draggable: true,
            edgeFriction: 0,
        });

        // Big slider
        $('.slide-container').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 1500,
            arrows: false,
            draggable: true,
        });
        $('.row-slider').each(function() {
            $(this).slick({
                autoplay: false,
                adaptiveHeight: true,
                slidesToShow: 1,
                variableWidth: true,
                draggable: true,
                infinite: false,
                prevArrow: $(this).closest('.row-wrapper').find('.prev'),
                nextArrow: $(this).closest('.row-wrapper').find('.next'),
            });
        });
        // Normal slider
        $('.row-normal-slider').each(function() {
            $(this).slick({
                autoplay: false,
                adaptiveHeight: true,
                slidesToShow: 1,
                variableWidth: true,
                draggable: true,
                prevArrow: $(this).closest('.row-wrapper').find('.prev'),
                nextArrow: $(this).closest('.row-wrapper').find('.next'),
            });
        })
    }

    var actual;
    $('.row-slider .thumb-slide').first().addClass('overothers');
    $('.row-slider .thumb-slide').hover(function() {
        actual = $(this);
        $(this).siblings().each(function() {
            $(this).removeClass('overothers');
        });
        $(this).addClass('overothers');
    });
    $('.row-slider .thumbslide').mouseleave(
        function() {
            actual.removeClass('overothers');
        });

    /**
     * Click on the entire div to get the video page
     * but prevents if it is a drag
     * 
     */
    var isDragging = false;
    var startingPos = [];
    var clickable = true;
    $('.slide, .thumb-slide')
        .mousedown(function(evt) {
            isDragging = false;
            startingPos = [evt.pageX, evt.pageY];
            if ($(this).hasClass('not-clickable')) {
                clickable = false;
            }
        })
        .mousemove(function(evt) {
            if (!(evt.pageX === startingPos[0] && evt.pageY === startingPos[1])) {
                isDragging = true;
            }
        })
        .mouseup(function() {
            if (!isDragging && clickable) {
                window.location = $(this).find('a').attr('href');
                return false;
            }
            isDragging = false;
            startingPos = [];
        });


    /**
     * Tabs
     */
    $('.tab-header').click(function() {
        if ($(this).hasClass('active'))
            return;

        let idtab = '#' + $(this).data('tab');
        let tab = $(idtab);
        if (!tab.length)
            return;

        $('.account-tab-header h1').removeClass('active');
        tab.siblings().removeClass('active');
        $(this).addClass('active');
        $(tab).addClass('active');


    });

    if ($('.feedback-user').length) {
        openSM();
    }

    /**
     * Burger menu events
     */
    var burger = document.getElementById('burger');
    var burger_close = document.getElementById('burgerClose');

    if (burger && burger_close) {
        burger.addEventListener('click', openSM);
        burger_close.addEventListener('click', closeSM);
    }

    /**
     * When user clicks premium indicator load payment page
     */
    $('.premium-indicator').click(function(e) {
        let route = $(this).data('route');
        if (route.trim() !== '') {
            e.preventDefault();
            window.location = route;
            return;
        }
    });

    /**
     * Select in /show
     */
    $('.sel').each(function() {
        $(this).children('select').css('display', 'none');

        var $current = $(this);

        $(this).find('option').each(function(i) {
            if (i == 0) {
                $current.prepend($('<div>', {
                    class: $current.attr('class').replace(/sel/g, 'sel__box')
                }));

                var placeholder = $(this).text();
                $current.prepend($('<span>', {
                    class: $current.attr('class').replace(/sel/g, 'sel__placeholder'),
                    text: placeholder,
                    'data-placeholder': placeholder
                }));

                return;
            }

            $current.children('div').append($('<span>', {
                class: $current.attr('class').replace(/sel/g, 'sel__box__options'),
                text: $(this).text()
            }));
        });
    });

    // Toggling the `.active` state on the `.sel`.
    $('.sel').click(function() {
        $(this).toggleClass('active');
    });

    // Toggling the `.selected` state on the options.
    $('.sel__box__options').click(function() {
        var txt = $(this).text();
        var index = $(this).index();

        $(this).siblings('.sel__box__options').removeClass('selected');
        $(this).addClass('selected');

        var $currentSel = $(this).closest('.sel');
        $currentSel.children('.sel__placeholder').text(txt);
        $currentSel.children('select').prop('selectedIndex', index + 1);
    });


})
$(window).on('load', function() {
    $('.loader').first().fadeOut();
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
