REX_TEMPLATE[6]
<div class="section" data-anchor="architektur">
    <div class="slide" data-anchor="main">
        <?php
        $artikel1 = new rex_article;
        $artikel1->setCLang($REX['CUR_CLANG']);
        $artikel1->setArticleID(113);
        echo $artikel1->getArticleTemplate();
        ?>
    </div>
    <div class="slide detail">
    </div>
</div>

<div class="section active" data-anchor="home">
    <div class="startseite">
        <div class="content text-center">
            <?php
            $categories = OOCategory::getRootCategories(true);
            $z = 0;
            foreach ($categories as $c) {
                $z++;
                echo '<a class="link" href="#'.strtolower($c->getName()).'">'.$c->getName().'</a>';
                if($z == 1) {
                    echo '<img src="'.seo42::getMediaFile('star_black_60.png').'" />';
                }
            }
            ?>
        </div>
    </div>
</div>

<div class="section" data-anchor="fotografie">
    <div class="slide" data-anchor="main">
        <?php
        $artikel2 = new rex_article;
        $artikel2->setCLang($REX['CUR_CLANG']);
        $artikel2->setArticleID(20);
        echo $artikel2->getArticleTemplate();
        ?>
    </div>
    <div class="slide detail fotografie">
    </div>
</div>

REX_TEMPLATE[7]
