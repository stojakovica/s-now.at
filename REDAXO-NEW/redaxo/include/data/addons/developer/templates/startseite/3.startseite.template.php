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
            $architekturImage = OOMedia::getMediaByFileName('architektur.png');
            $fotografieImage = OOMedia::getMediaByFileName('fotografie.png');

            echo '<img src="'.seo42::getImageFile('logo.png').'" class="logo" />';
            echo '<br>';
            echo '<a class="link" href="#'.strtolower("architektur").'">';
            echo '<img src="'.seo42::getMediaFile('architektur.png').'" title="'.$architekturImage->getTitle().'" alt="'.$architekturImage->getTitle().'" />';
            echo '</a>';
            echo '<img src="'.seo42::getImageFile('slash.png').'" class="slash" />';
            echo '<a class="link" href="#'.strtolower("fotografie").'">';
            echo '<img src="'.seo42::getMediaFile('fotografie.png').'" title="'.$fotografieImage->getTitle().'" alt="'.$fotografieImage->getTitle().'" />';
            echo '</a>';
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
