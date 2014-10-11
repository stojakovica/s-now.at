<?php
header('Content-Type: text/html; charset=utf-8');

$path = explode("|",$this->getValue("path").$this->getValue("article_id")."|");

$path1 = $path[1];
$path2 = $path[2];
$path3 = $path[3];

if(OOAddon::isAvailable('rexseo'))
{
$meta = new rexseo_meta();
$meta_description   = $meta->get_description();
$meta_keywords      = $meta->get_keywords();
$meta_title         = $meta->get_title();
$meta_canonical     = $meta->get_canonical();
$meta_base          = $meta->get_base();
}
else
{
$OOStartArticle     = OOArticle::getArticleById($REX['START_ARTICLE_ID'], $REX['CUR_CLANG']);
$meta_description   = $OOStartArticle->getValue("art_description");
$meta_keywords      = $OOStartArticle->getValue("art_keywords");

if($this->getValue("art_description") != "")
    $meta_description = htmlspecialchars($this->getValue("art_description"));
if($this->getValue("art_keywords") != "")
    $meta_keywords    = htmlspecialchars($this->getValue("art_keywords"));

$meta_title         = $REX['SERVERNAME'].' | '.$this->getValue("name");
$meta_canonical     = isset($_REQUEST['REQUEST_URI']) ? $_REQUEST['REQUEST_URI'] : '';
$meta_base          = 'http://'.$_SERVER['HTTP_HOST'].'/';
}

?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
        <meta name="viewport" content="width=1000" />
        <link href="files/slimbox2.css" rel="stylesheet">
        <link href="files/main.css" rel="stylesheet">
        <script src="files/jquery-1.10.2.min.js"></script>
        <script src="files/slimbox2.js"></script>
        <script src="files/jquery.nicescroll.min.js"></script>
        <script src="files/main.js"></script>
        <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div id="containerWrapper" class="clearfix">
            <div id="container" class="clearfix">
                <?php
                $cat = OOCategory::getCategoryById($this->getValue("category_id"));
                $categories = $cat->getChildren(true);
                $width = 25;
                foreach ($categories as $c) {
                    $catArticles = array();
                    foreach(array_reverse($c->getArticles()) as $catArt) {
                        if($catArt->isStartArticle()) continue;
                        if(!$catArt->isOnline()) continue;
                        $catArticles[] = $catArt;
                    }
                    ?>
                    <div class="columnWrapper" style="width:<?php echo $width; ?>%">
                        <div class="column">
                            <div class="headerDescription">
                                <?php
                                foreach($catArticles as $catArt) {
                                    echo '<a href="#" class="galleryBox" data-previewImg="'.$catArt->getValue('art_gallerypreview').'" data-previewText="'.str_replace("\n", "%0A", $catArt->getValue('art_gallerypreviewtext')).'" data-galleryList="'.$catArt->getValue('art_gallerylist').'">'.$catArt->getName().'</a><br/>';
                                }
                                ?>
                            </div>
                            <div class="headerWrapper">
                                <div class="header">
                                    <?php echo $c->getName(); ?>
                                </div>
                            </div>
                            <div class="content">
                                <?php
                                foreach($catArticles as $catArt) {
                                    $img = array_shift(explode(',', $catArt->getValue('art_gallerylist')));
                                    ?>
                                        <div class="block">
                                            <?php echo '<a href="#" class="galleryBox" data-previewImg="'.$catArt->getValue('art_gallerypreview').'" data-previewText="'.str_replace("\n", "%0A", $catArt->getValue('art_gallerypreviewtext')).'" data-galleryList="'.$catArt->getValue('art_gallerylist').'">'; ?>
                                                <img src="<?php $REX['HTDOCS_PATH']; ?>index.php?rex_img_type=imgBlock&rex_img_file=<?php echo $img; ?>" />
                                            <?php echo '</a>'; ?>
                                        </div>
                                    <?php
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="containerTextCenter">
                    <table class="contentTextCenter">
                        <tr>
                            <td>
                                <?php echo $this->getArticle(1); ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <div id="containerOverlay"></div>
        </div>
        <div id="footerWrapper">
            <div id="footer">
                <ul id="navigationRight" class="clearfix">
                    <li class="navMain"><a href="<?php echo rex_getUrl(22); ?>"><img src="index.php?rex_img_type=footerLogo&rex_img_file=star_black.png" title="Home" alt="Home" /></a></li>
                </ul>
                <ul id="navigationMain" class="clearfix">
                    <?php
                    foreach(OOCategory::getChildrenById($this->article_id) as $cat) {
                        if($cat->getName() != "Service") continue;
                        foreach($cat->getChildren() as $subcat) {
                            echo '<li class="navMain" data-artId="'.$subcat->getId().'">'.$subcat->getName().'</li>';
                        }
                    }
                    foreach(OOCategory::getChildrenById(5) as $cat) {
                        echo '<li class="navMain" data-artId="'.$cat->getId().'">'.$cat->getName().'</li>';
                    }
                    ?>
                </ul>
                <div style="clear:both;"></div>
                <div id="footerArticleContent"></div>
            </div>
        </div>
        <script type="text/javascript">

          var _gaq = _gaq || [];
          _gaq.push(['_setAccount', 'UA-46862164-1']);
          _gaq.push(['_trackPageview']);

          (function() {
            var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
          })();

        </script>
    </body>
</html>