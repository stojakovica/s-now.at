<div class="containerWrapper clearfix">
    <div id="container" class="clearfix">
        <?php
        $cat = OOCategory::getCategoryById($this->getValue("category_id"));
        $categories = $cat->getChildren(true);
        $colSize = 12/count($categories);
        foreach ($categories as $c) {
            $catArticles = array();
            foreach(array_reverse($c->getArticles()) as $catArt) {
                if($catArt->isStartArticle()) continue;
                if(!$catArt->isOnline()) continue;
                $catArticles[] = $catArt;
            }
            ?>
            <div class="col-xs-<?php echo $colSize; ?>">
                <div class="column">
                    <div class="descriptionWrapper">
                        <div class="description">
                            <div class="close">X</div>
                            <div class="descriptionContent">
                                <?php
                                echo $c->getDescription();

                                foreach($catArticles as $catArt) {
                                    echo '<a href="#" class="galleryBox" data-artId="'.$catArt->getId().'">'.$catArt->getName().'</a><br/>';
                                }
                                ?>
                            </div>
                        </div>

                        <div class="headline">
                            <?php echo $c->getName(); ?>
                            <i class="fa fa-bars"></i>
                        </div>
                    </div>
                    <div class="content">
                        <?php
                        foreach($catArticles as $catArt) {
                            $id = $catArt->getId();
                            $img = array_shift(explode(',', $catArt->getValue('art_gallerylist')));
                            ?>
                            <div class="block">
                                <img src="<?php echo seo42::getImageManagerFile($img, "imgBlock"); ?>" data-artId="<?php echo $id; ?> "/>
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
    </div>
</div>