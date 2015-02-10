<?php
include 'lib/project/classes/mobile_detect.php';
$detect = new Mobile_Detect();

$ssa = OOArticle::getSiteStartArticle();
$curArticle = OOArticle::getArticleById($this->article_id);

function getHierarchicalVar($key, $article, $ssa) {
    $var = false;

    $a = $article;
    while ($a!=false) {
        if ($var) {
            break;
        }
        $var = $a->getValue($key);
        $a = $a->getParent();
    }
    if (!$var) {
        $var = $ssa->getValue($key);
    }

    return $var;
}
$ajaxUrl = rex_getUrl(12);
?>
<!DOCTYPE html>
<html lang="<?php echo seo42::getLangCode(); ?>" xmlns:fb="http://ogp.me/ns/fb#">
<head>
    <meta charset="utf-8" />
    <base href="<?php echo seo42::getBaseUrl(); ?>" />
    <title><?php echo seo42::getTitle(); ?></title>
    <meta name="description" content="<?php echo seo42::getDescription(); ?>" />
    <meta name="keywords" content="<?php echo seo42::getKeywords(); ?>" />
    <meta name="robots" content="<?php echo seo42::getRobotRules();?>" />
    <link href="lib/bootstrap-3.2.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="lib/slimbox2/css/slimbox2.css" rel="stylesheet">
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="lib/fullpage/jquery.fullPage.css" rel="stylesheet">
    <link href="http://nicinabox.com/superslides/dist/stylesheets/superslides.css" rel="stylesheet">
    <link href="lib/project/css/jquery.mCustomScrollbar.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo seo42::getCombinedCSSFile("main.css", array("elements.less", "main.less")); ?>" type="text/css" media="screen,print" />
    <?php if($detect->isMobile()) { ?>
        <link href="lib/project/css/handheld.css" rel="stylesheet">
    <?php } ?>
    <link rel="shortcut icon" href="<?php echo seo42::getImageFile("favicon.ico"); ?>" type="image/x-icon" />
    <link rel="canonical" href="<?php echo seo42::getCanonicalUrl(); ?>" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    <?php echo seo42::getLangTags(); ?>
    <!--    <meta name="viewport" content="width=device-width, initial-scale=1">-->
    <meta name="viewport" content="width=1000" />
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo seo42::getJSFile("https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo seo42::getJSFile("https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"); ?>"></script>
    <![endif]-->
    <script type="text/javascript" src="lib/jquery1.11.1/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="lib/bootstrap-3.2.0/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="lib/fullpage/vendors/jquery.easings.min.js"></script>
<!--    <script type="text/javascript" src="lib/fullpage/vendors/jquery.slimscroll.min.js"></script>-->
    <script type="text/javascript" src="lib/fullpage/jquery.fullPage.min.js"></script>
    <script type="text/javascript" src="<?php echo seo42::getJSFile("jquery.mCustomScrollbar.js"); ?>"></script>
    <script type="text/javascript" src="http://nicinabox.com/superslides/dist/jquery.superslides.js"></script>
    <script type="text/javascript" src="<?php echo seo42::getJSFile("main.js"); ?>"></script>
    <script type="text/javascript">
        var ajaxUrl = "<?php echo $ajaxUrl; ?>";
    </script>
</head>
<body>
    <div id="fullpage">