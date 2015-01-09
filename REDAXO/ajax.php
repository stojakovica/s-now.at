<?php
ob_clean();
header('Content-Type: text/html; charset=utf-8');

function convertTextile($text) {
    $textile = htmlspecialchars_decode($text);
    $textile = str_replace("<br />","",$textile);
    $textile = rex_a79_textile($textile);
    $textile = str_replace("###","&#x20;",$textile);

    return $textile;
}

if($_GET['artId'] != "") $id = $_GET['artId'];

if ($_GET['getArticleData'] == 1) {
    $article = new article($id);
    $result = '<div class="container">';
    $result .= $article->getArticle(1);
    $result .= '</div>';
    echo $result;
    exit;
}

if ($_GET['getDetail'] == 1) {
    $article = OOArticle::getArticleById($id);
    $text = $article->getValue("art_gallerypreviewtext");
    $images = array_filter(explode(',', $article->getValue("art_gallerylist")));

    $result = '<div id="slides">';
    $result .= '<ul class="slides-container">';
    if($text) {
        $result .= '<li>';
        $result .= '<div class="detailContentWrapper">';
        $result .= '<div class="detailTopBar"></div>';
        $result .= '<div class="detailContent">';
        $result .= '<div class="container">';
        $result .= convertTextile($text);
        $result .= '</div>';
        $result .= '</div>';
        $result .= '</div>';
        $result .= '</li>';
    }
    foreach($images as $img) {
        $result .= '<li>';
        $result .= '<div class="detailContentWrapper">';
        $result .= '<div class="detailTopBar"></div>';
        $result .= '<div class="detailContent" style="background-image: url(\''.seo42::getImageManagerUrl($img, "detail").'\')">';
        $result .= '</div>';
        $result .= '</div>';
        $result .= '</li>';
    }
    $result .= '</ul>';
    $result .= '<nav class="slides-navigation">';
        $result .= '<a href="#" class="next"><div class="controlSuperslides nextSuperSlides"></div></a>';
        $result .= '<a href="#" class="prev"><div class="controlSuperslides prevSuperSlides"></div></a>';
    $result .= '</nav>';
    $result .= '<div class="close">X</div>';
    $result .= '</div>';
    echo $result;
    exit;
}

if ($_GET['getGallery'] == 1) {
    $previewText = convertTextile($_GET['previewText']);
    $previewImg = '<img src="'.$REX['HTDOCS_PATH'].'index.php?rex_img_type=galleryBoxPreview&rex_img_file='.$_GET['previewImg'].'" /><br/><br/>';

    $images = explode(',', $_GET['galleryList']);

    $galleryImgBig = '<div class="galleryBoxImgBig"><img src="'.$REX['HTDOCS_PATH'].'index.php?rex_img_type=galleryBoxImgBig&rex_img_file='.$images[0].'" /></div>';
    $imagesHtml = '';
    foreach ($images as $img) {
        $imagesHtml .= '<img class="galleryBox" data-imgname="'.$img.'" src="'.$REX['HTDOCS_PATH'].'index.php?rex_img_type=galleryBoxListSmall&rex_img_file='.$img.'" />';
    }
    $galleryList = '<div class="galleryBoxList">'.$imagesHtml.'</div>';

    $html = '<div class="previewBox">'.$previewImg.'<div>'.$previewText.'</div></div><div class="galleryShowBox">'.$galleryImgBig.$galleryList.'</div>';
    echo $html;
    exit;
}
?>