<?php
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
    <link href="lib/slimbox2/css/slimbox2.css" rel="stylesheet">
    <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo seo42::getCombinedCSSFile("main.css", array("elements.less", "main.less")); ?>" type="text/css" media="screen,print" />
    <link rel="shortcut icon" href="<?php echo seo42::getImageFile("favicon.ico"); ?>" type="image/x-icon" />
    <link rel="canonical" href="<?php echo seo42::getCanonicalUrl(); ?>" />
    <?php echo seo42::getLangTags(); ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--[if lt IE 9]>
    <script type="text/javascript" src="<?php echo seo42::getJSFile("https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"); ?>"></script>
    <script type="text/javascript" src="<?php echo seo42::getJSFile("https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"); ?>"></script>
    <![endif]-->
    <script type="text/javascript" src="lib/jquery1.11.1/jquery-1.11.1.min.js"></script>
    <script type="text/javascript" src="lib/fullpage/vendors/jquery.easings.min.js"></script>
    <script type="text/javascript" src="lib/fullpage/vendors/jquery.slimscroll.min.js"></script>
    <script type="text/javascript" src="lib/fullpage/jquery.fullPage.min.js"></script>
    <script type="text/javascript" src="<?php echo seo42::getJSFile("main.js"); ?>"></script>
</head>
<body>
    <div id="fullpage">
        <div class="section" id="section0" data-anchor="architektur">Architektur</div>
        <div class="section active" id="section1" data-anchor="startpage">
            <div id="containerWrapper" class="startseite clearfix">
                <div id="container">
                    <table>
                        <tr>
                            <td>
                                <a href="#architektur">Architektur</a><a href="#fotografie">Fotografie&nbsp;&nbsp;</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="footerWrapper">
                <div id="footer">
                    <ul id="navigationRight" class="clearfix">
                        <li class="navMain"><a href="index.php?article_id=22"><img src="index.php?rex_img_type=footerLogo&rex_img_file=star_black.png" title="Home" alt="Home" /></a></li>
                    </ul>
                    <ul id="navigationMain" class="clearfix">
                        <li class="navMain" data-artId="7"><small>s</small>NOW</li><li class="navMain" data-artId="6">Team</li><li class="navMain" data-artId="8">KONTAKT</li><li class="navMain" data-artId="9">Impressum</li><li class="navMain" data-artId="197">3D PRINTER</li>                </ul>
                    <div style="clear:both;"></div>
                    <div id="footerArticleContent"></div>
                </div>
            </div>
        </div>
        <div class="section" id="section2" data-anchor="fotografie">Fotografie</div>
