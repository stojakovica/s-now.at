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
    <div class="slide" data-anchor="detail">
        test
    </div>
</div>

<div class="section active" data-anchor="home">
    <div class="startseite">
        <div class="content">
            <?php
            $categories = OOCategory::getRootCategories(true);
            foreach ($categories as $c) {
                echo '<a href="#'.strtolower($c->getName()).'">'.$c->getName().'</a>';
            }
            ?>
        </div>
    </div>
</div>

<div class="section" data-anchor="fotografie">
    <?php
    $artikel2 = new rex_article;
    $artikel2->setCLang($REX['CUR_CLANG']);
    $artikel2->setArticleID(20);
    echo $artikel2->getArticleTemplate();
    ?>
</div>

REX_TEMPLATE[7]
