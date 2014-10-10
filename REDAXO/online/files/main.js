$(document).ready(function() {
    $(window).resize(setHeader).trigger("resize");
    setMargin();
    if(!$('#container').hasClass('startseite')) {
        $(window).resize(setContentHeight).trigger("resize");
    }
    setFooterHeight("47px");
    setFooterWidth();
    $('#container .columnWrapper .column .content').niceScroll();
    $('.headerDescription').niceScroll();
    if(!$('#container').hasClass('startseite')) {
        $('#container .columnWrapper .column .content .block img').hover(fadeIn, fadeOut);
        $('.headerWrapper').click(toggleDescription);
    }
    $('#footer #navigationMain .navMain').click(getFooterContent);
    $('#containerWrapper').click(resetFooter);
    $('a.galleryBox').click(getGallery);
    setTimeout(showDescriptions, 100);
    setTimeout(initialDescriptionEffect, 2000);
});

function initialDescriptionEffect() {
    $('.columnWrapper').each(function( index ) {
        closeDescription($(this));
    });
}

function toggleDescription() {
    var speed = 500;
    var el = $(this);
    if($(this).hasClass('close')) {
        el = $(this).parent('.headerDescription').next();
    }
    var prevEl = el.prev();
    var prevTop = '-59';
    var top = $(window).height() - $('#footerWrapper').height() - el.height() - 59;

    if(prevEl.css('top') == '-59px') {
        prevTop = getTopValue();
        top = '-59';
    }

    el.animate({
        top: top+'px'
    }, speed);
    prevEl.animate({
        top: prevTop+'px'
    }, speed);
}

function showDescriptions() {
    var speed = 500;
    var top = $(window).height() - $('#footerWrapper').height() - $('.headerWrapper').first().height() - 59;
    $('.headerWrapper').css("top", top+'px');
    $('.headerDescription').css("top", '-59px');
}

function closeDescription(el) {
    var speed = 1000;
    var prevTop = getTopValue();

    var headerWrapper = el.children('.column').first().children('.headerWrapper');
    var headerDescription = el.children('.column').first().children('.headerDescription');

    headerWrapper.animate({
        top: '-59px'
    }, speed);
    headerDescription.animate({
        top: prevTop+'px'
    }, speed);
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
        url: "index.php?article_id=12",
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
    setFooterHeight("80%");
    $('#containerOverlay').show();
    $.ajax({
        type: "GET",
        async: false,
        url: "index.php?article_id=12",
        data: "getArticleData=1&artId="+$(this).attr('data-artId'),
        success: function(data){
            $('#footerArticleContent').empty();
            $('#footerArticleContent').html(data);
            $('#footerArticleContent').niceScroll();
        }
    });
}

function resetFooter() {
    $('#footerArticleContent').empty();
    $('#containerOverlay').hide();
    setFooterHeight("47px");
}

function setFooterHeight(height) {
    var speed = 500;
    $('#footerWrapper').animate({
        height: height
    }, speed, function() {
        $('#footerArticleContent').height($('#footerWrapper').height() - 40);
    });
}

function setFooterWidth() {
    var width = 1000 - ($(window).width() * 0.02);
    $('#footerArticleContent').width(width);
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

function setContentHeight() {
    if($('#container').width() > 1000) {
        var margin = $('#container').width() * 0.02;
        var contentHeight = $(window).height();
        contentHeight -= margin;
        contentHeight -= $('#container .columnWrapper .column .headerWrapper').height();
        contentHeight -= $('#footerWrapper').height();
        $('#container .columnWrapper .column .content').css('height', contentHeight+'px');
    }
}