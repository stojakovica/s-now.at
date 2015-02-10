var doLogoBlinking = true;

$(document).ready(function() {
    var $fullPage = $('#fullpage');
    $fullPage.fullpage({
        autoScrolling: false,
        easing: 'easeOutQuart',
        scrollingSpeed: 500,
        resize : true,
        verticalCentered: false,
        slidesNavigation: false
    });
    $('.fp-controlArrow').hide();
    $('.block img, .galleryBox').click(getDetail);

    $('.column .content').height(calcContentHeight());
    $('.column .content, .description, .footerArticleContentWrapper').mCustomScrollbar({
        scrollInertia: 100,
        autoHideScrollbar: true
    });
    if(!$('#container').hasClass('startseite')) {
        $('#container .columnWrapper .column .content .block img').hover(fadeIn, fadeOut);
        $('.headline').click(toggleDescription);
        $('.close').click(hideDescription);
    }
    $('#footer #navigationMain a').click(getFooterContent);
    $('#containerOverlay').click(resetFooter);

    setLogoOpacity('1');
    $('.homeButton').hover(function() {
        setLogoOpacity('1');
        doLogoBlinking = false;
    }, function() {
        doLogoBlinking = true;
        setLogoOpacity('0.5');
    });

    $('.homeButton').click(resetAll);

    $(window).resize(function() {
        resetFooterFast();
        resetDescriptions();
        $('.column .content').height(calcContentHeight());
    });
});

function resetAll() {
    resetFooter();
    resetDetailSlide();
    resetDescriptions();
}

function setLogoOpacity(opacity) {
    if(doLogoBlinking) {
        var speed = 750;
        $('.homeButton').animate({
            'opacity': opacity
        }, speed, function() {
            if(opacity == '1') {
                setLogoOpacity('0.5');
            } else {
                setLogoOpacity('1');
            }
        });
    }
}

function toggleDescription() {
    var speed = 500;
    var el = $(this);
    var height = calcContentHeight() + el.outerHeight() - 1;
    var $description = el.prev('.description');
    if($description.length) {
        if($description.height() > 0) {
            height = 0;
        }
        $description.animate({
            height: height+'px'
        });
        $('.close').click(hideDescription);
    }
}

function hideDescription(el) {
    var speed = 500;
    var el = $(this);
    var height = 0;
    var $description = el.parents('.description');
    if($description.length) {
        $description.animate({
            height: height+'px'
        });
    }
}

function resetDescriptions() {
    var els = $('.column .description');
    var height = 0;
    els.height(height);
}

function getTopValue() {
    return (-1)*($(window).height() - $('#footerWrapper').height());
}

function getHeightValue() {
    var height = (-1) * getTopValue() + 17;
    var padding = parseInt($('.headerDescription').css('padding-top'));
    height -= $('#footerWrapper').height();
    height -= padding;
    return height;
}

function getFooterContent() {
    if($(this).hasClass('active')) {
        resetFooter();
    }
    else {
        $('#navigationMain a').removeClass('active');
        $(this).addClass('active');
        $('#containerOverlay').show();
        $.ajax({
            type: "GET",
            url: ajaxUrl,
            data: "getArticleData=1&artId="+$(this).attr('data-artId'),
            success: function(data){
                var footerHeight = $(window).height() * 0.7;
                $('.footerArticleContent').html(data);
                setFooterHeight(footerHeight+'px');
            }
        });
    }
    return false;
}

function resetFooter() {
    $('#navigationMain a').removeClass('active');
    $('.footerArticleContent').html("");
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        setFooterHeight("65px")
    }
    else {
        setFooterHeight("47px")
    }
    $('#containerOverlay').hide();
}

function resetFooterFast() {
    $('#navigationMain a').removeClass('active');
    $('.footerArticleContent').html("");
    if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) ) {
        $('#footer').height(65);
    }
    else {
        $('#footer').height(47);
    }
    $('#containerOverlay').hide();
}

function setFooterHeight(height) {
    var $footerArticleContent = $('.footerArticleContentWrapper');
    var speed = 300;

    $('#footer').animate({
        height: height
    }, speed, function() {
        var footerArticleContentHeight = $('#footer').outerHeight() - 47;
        footerArticleContentHeight-= parseInt($footerArticleContent.css('padding-top'));
        if(footerArticleContentHeight < 0) {
            footerArticleContentHeight = 0;
        }
        $footerArticleContent.height(footerArticleContentHeight);
    });
}

function fadeIn() {
    var speed = 200;
    $(this).animate({
        "filter": "saturate(100%)",
        "-webkit-filter": "saturate(100%)",
        "-moz-filter": "saturate(100%)",
        "-o-filter": "saturate(100%)",
        "-ms-filter": "saturate(100%)",
        opacity: "1"
    }, speed);
}

function fadeOut() {
    var speed = 200;
    $(this).animate({
        "filter": "saturate(20%)",
        "-webkit-filter": "saturate(20%)",
        "-moz-filter": "saturate(20%)",
        "-o-filter": "saturate(20%)",
        "-ms-filter": "saturate(20%)",
        opacity: "0.5"
    }, speed);
}

function calcContentHeight() {
    var contentHeight = 0;
    var $column = $('.column');
    var $content = $('.content');

    contentHeight = $(window).height();
    if($('.detailContent').length < 1) {
        contentHeight -= parseInt($column.css('paddingTop'));
        contentHeight -= parseInt($content.css('marginTop'));
    }
    else {
        contentHeight -= $('#footer').height();
    }
    contentHeight -= $('#footer').height();

    return contentHeight;
}

function getDetail() {
    var $section = $(this).closest('.section .fp-slidesContainer');
    var artId = $(this).attr('data-artId');
    var jqxhr = $.ajax({
        type: "GET",
        async: true,
        url: ajaxUrl,
        data: "getDetail=1&artId="+artId,
        success: function(data){
            if($('#slides').length > 0) {
                $('#slides').remove();
            }
            resetDetailSlide();
            $section.find('.detail').html(data);
            initSlides();

            $.fn.fullpage.moveSlideRight();
        }
    });

    return false;
}

function initSlides() {
    $('#slides').superslides();

    $('.detailContent').height(calcContentHeight());
    $(window).resize(function() {
        $('.detailContent').height(calcContentHeight());
    });

    if($('.fotografie').children().length == 0) {
        $('li:first-child .detailContent').mCustomScrollbar({
            scrollInertia: 100,
            autoHideScrollbar: true
        });
    }

    $('#slides .close').click(function() {
        $.fn.fullpage.moveSlideLeft();
        resetDetailSlide();
    });
}

function resetDetailSlide() {
    $('.slide.detail').empty();
}