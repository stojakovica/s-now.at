var doLogoBlinking = true;

$(document).ready(function() {
    $('#fullpage').fullpage({
        autoScrolling: false,
        easing: 'easeOutQuart',
        scrollingSpeed: 1000
    });

    $('.column .content').height(calcContentHeight());
    $('.column .content, .description').mCustomScrollbar({
        scrollInertia: 100,
        autoHideScrollbar: true
    });
    if(!$('#container').hasClass('startseite')) {
        $('#container .columnWrapper .column .content .block img').hover(fadeIn, fadeOut);
        $('.headline').click(toggleDescription);
        $('.close').click(hideDescription);
    }
    $('#footer #navigationMain a').click(getFooterContent);
    $('.containerWrapper').click(resetFooter);
    //$('a.galleryBox').click(getGallery);

    setLogoOpacity('1');
    $('.homeButton').hover(function() {
        setLogoOpacity('1');
        doLogoBlinking = false;
    }, function() {
        doLogoBlinking = true;
        setLogoOpacity('0.5');
    });
});

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

function setHeader() {
    var top = getTopValue();
    var height = getHeightValue();
    $('.headerDescription').height(height);
    $('.headerDescription').css('top', top+'px');
    $('.headerWrapper').css('top', '-59px');
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

function showGalleryBox() {
    var html = '<div id="galleryBoxWrapper"><div id="closeWrapper"></div><div id="close">X</div><div id="galleryBox" class="clearfix"></div></div>';
    $('body').prepend(html);
}

function hideGalleryBox() {
    $('#galleryBoxWrapper').remove();
}

function changeGalleryBoxImg() {
    var speed = 500;
    var imgName = $(this).attr('data-imgname');

    $('.galleryBoxImgBig img').animate({
        "opacity": "0"
    }, speed, function() {
        $('.galleryBoxImgBig').empty();
        $('.galleryBoxImgBig').html('<img style="opacity:0;" src="index.php?rex_img_type=galleryBoxImgBig&rex_img_file='+imgName+'" />');
        $('.galleryBoxImgBig img').load(function(){
            $('.galleryBoxImgBig img').animate({
                "opacity": "1"
            }, speed);
        });
    });
}

function getGallery() {
    showGalleryBox();
    $.ajax({
        type: "GET",
        async: false,
        url: ajaxUrl,
        data: "getGallery=1&galleryList="+$(this).attr('data-galleryList')+"&previewImg="+$(this).attr('data-previewImg')+"&previewText="+$(this).attr('data-previewText'),
        success: function(data){
            $('#galleryBoxWrapper #galleryBox').html(data);
            $('#galleryBoxWrapper #close').click(hideGalleryBox);
            $('#galleryBoxWrapper #closeWrapper').click(hideGalleryBox);
            $('#galleryBoxWrapper #galleryBox img.galleryBox').click(changeGalleryBoxImg);
            $('#galleryBoxWrapper #galleryBox .previewBox').niceScroll();
        }
    });

    return false;
}

function getFooterContent() {
    $('#containerOverlay').show();
    $.ajax({
        type: "GET",
        async: false,
        url: ajaxUrl,
        data: "getArticleData=1&artId="+$(this).attr('data-artId'),
        success: function(data){
            var footerHeight = $(window).height() * 0.7;
            $('#footerArticleContent').empty();
            $('#footerArticleContent').html(data);
            setFooterHeight(footerHeight+'px');
            $('#footerArticleContent').mCustomScrollbar({
                scrollInertia: 100,
                autoHideScrollbar: true
            });
        }
    });
    return false;
}

function resetFooter() {
    $('#footerArticleContent').empty();
    setFooterHeight("47px");
}

function setFooterHeight(height) {
    var $footerArticleContent = $('#footerArticleContent');
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

function setMargin() {
    var margin = $('#container').width() * 0.02;
    $('#container .columnWrapper .column .content .block').css('margin-bottom', margin+'px');
    $('#container .columnWrapper .column .content').each(function() {
        $(this).children('.block').last().css('margin-bottom', '0px');
    });
    $('#container .columnWrapper .column .headerDescription').css('padding-top', (59)+'px');
    $('#footer #navigationMain .navMain').css('margin-right', margin+'px');
    $('#footer #navigationRight').css('margin-left', margin+'px');
}

function calcContentHeight() {
    var contentHeight = 0;
    var $column = $('.column');
    var $content = $('.content');

    if($(window).width() > 1000) {
        contentHeight = $(window).height();
        contentHeight -= parseInt($column.css('paddingTop'));
        contentHeight -= parseInt($content.css('marginTop'));
        contentHeight -= $('#footer').height();
    }

    return contentHeight;
}