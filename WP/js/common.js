var servicesMenu = function() {
    $('.nav__menu').append($('.main__sidebar .menu').clone())

    var close

    $('.nav__item--hasSubMenu').on('mouseenter', function() {
        $(this).closest('.nav').addClass('showSub');
        clearTimeout(close)
    })

    $('.nav__item--hasSubMenu').on('mouseleave', function(e) {
        var me = this
        close = setTimeout(function() {
            $(me).closest('.nav').removeClass('showSub');
        }, 300)
    })

    $('.nav__menu .menu').on('mouseenter', function() {
        $(this).closest('.nav').addClass('showSub');
        clearTimeout(close)
    })

    $('.nav__menu .menu').on('mouseleave', function(e) {
        var me = this
        close = setTimeout(function() {
            $(me).closest('.nav').removeClass('showSub');
        }, 300)
    })
}

var search = function() {
    $('.search input').on('focus', function() {
        $(this).closest('.search').addClass('focus')
    });

    $('.search input').on('blur', function() {
        if ($(this).val().length === 0) $(this).closest('.search').removeClass('focus')
    });
}

var isFocus = function(pref) {
    var fieldEl = '.' + pref + '__field',
        groupEl = '.' + pref + '__group',
        labelEl = '.' + pref + '__label',
        onfocusClass = 'onfocus',
        value;

    $('body').addClass('js-placeholder')

    $(fieldEl).each(function() {
        value = $(this).val();
        $(this).removeAttr('placeholder')
        if (value.length > 0) $(this).closest(groupEl).addClass(onfocusClass).find(labelEl).fadeOut(200);
    })

    $(labelEl).on('click', function() {
        $(this).closest(groupEl).find(fieldEl).focus()
    });

    $(fieldEl).on('focus', function() {
        $(this).closest(groupEl).addClass(onfocusClass).find(labelEl).fadeOut(200);
    });

    $(fieldEl).on('blur', function() {
        value = $(this).val();
        if (value.length == 0) $(this).closest(groupEl).find(labelEl).fadeIn(200),
            $(this).closest(groupEl).removeClass(onfocusClass);
        if (value.length > 0) $(this).closest(groupEl).addClass(onfocusClass);
    });
}

var callbackModal = function() {

    var overlay

    $('.js-callback').on('click', function(event) {
        event.preventDefault();

        open('.callback')
    });

    $('.lk__item--reg').on('click', function(event) {
        event.preventDefault();

        open('.registration')
    });

    $('.js-openlist').on('click', function(event) {
        event.preventDefault();

        open('.implants')
    });

    $('.overlay-close').on('click', function(event) {
        event.preventDefault();

        close.call(this)
    });

    function open(box) {
        overlay = $(box)
        box = overlay.find('.overlay-inner')

        $('body').addClass('fixed')

        overlay.fadeIn(300);
        $({ scale: .5 }).animate({
            scale: 1
        }, {
            duration: 300,
            step: function(now, fx) {
                $(box).css({
                    'transform': 'scale(' + now + ')'
                })
            }
        }, 'linear');
    }

    function close() {
        overlay = $(this).closest('.overlay')
        box = overlay.find('.overlay-inner')

        $('body').removeClass('fixed')

        $({ scale: 1 }).animate({
            scale: 0
        }, {
            duration: 300,
            step: function(now, fx) {
                $(box).css({
                    'transform': 'scale(' + now + ')'
                })
            }
        }, 'linear');

        overlay.fadeOut(300)
    }

    function success() {
        overlay = $(this).closest('.overlay')
        box = overlay.find('.overlay-inner')

        $({ scale: 1 }).animate({
            scale: 1.5
        }, {
            duration: 300,
            step: function(now, fx) {
                $(box).css({
                    'transform': 'scale(' + now + ')'
                })
            }
        }, 'linear');

        overlay.fadeOut(300)
    }
}

var fuzzySearch = function(s) {
    var options = {
        shouldSort: true,
        threshold: 0.4,
        location: 0,
        distance: 100,
        maxPatternLength: 32,
        minMatchCharLength: 1,
        keys: [
            "post_title",
            "post_content"
        ]
    };
    var fuse = new Fuse(POSTS, options);
    var result = fuse.search(s);
}

$(function() {

    $.ajax({
        url: '/wp-json/acf/v3/post',
        type: 'default GET (Other values: POST)',
        dataType: 'default: Intelligent Guess (Other values: xml, json, script, or html)',
        data: {param1: 'value1'},
    })
    .done(function() {
        console.log("success");
    })
    .fail(function() {
        console.log("error");
    })
    .always(function() {
        console.log("complete");
    });
    

    $('.photoGallery').lightSlider({
        gallery: true,
        item: 3,
        loop: false,
        slideMargin: 5,
        enableDrag: false,
        currentPagerPosition: 'left',
        pager: false,
        autoWidth: true,
        onSliderLoad: function(el) {
            el.lightGallery({
                selector: '.photoGallery .lslide'
            });
        }
    });

    servicesMenu()
    search()

    $('.main__sidebar .menu__item').on('click', 'span', function() {
        $(this).closest('.menu__item').find('ul').slideToggle()
    });

    $('.equipment, .portfolio').lightGallery();

    isFocus('callback')
    isFocus('registration')

    callbackModal()

    $('.header__burger').on('click', function(event) {
        event.preventDefault();
        $(this).toggleClass('opened');
        $('body').toggleClass('menu-opened');
    });

    $('.main__sidebar-toggle').on('click', function(event) {
        event.preventDefault();
        $('.main__sidebar .menu').slideToggle();
    });

    $('.priceTable__category').on('click', function(event) {
        if ($(window).width() < 992) {
            var link = $(event.target).attr('data-link')
            link && (window.location = link)
        }
    });

    r()

    $(window).on('resize', function() {
        r()
    });
    $(window).on('scroll', function() {
        r()
    });

    function r() {
        if ($(window).width() > 991) {
            $('.main__sidebar .menu').removeAttr('style')
        } else {}
    }
});