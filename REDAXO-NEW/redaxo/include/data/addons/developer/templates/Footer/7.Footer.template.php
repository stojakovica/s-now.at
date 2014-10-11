    </div>

    <div id="footer" class="container">
        <div class="row">
            <div class="col-xs-4">
                <a href="#home"><img class="homeButton" src="<?php echo seo42::getImageManagerUrl("star_black.png", "footerLogo")?>" title="Home" alt="Home"/></a>
            </div>
            <div class="col-xs-8">
                <div class="pull-right">
                    <?php
                    $nav = new nav42();
                    $nav->setLevelDepth(1);
                    $nav->setIgnoreOfflines(true);
                    $nav->setHideWebsiteStartArticle(false);
                    $nav->setSelectedClass("current");
                    $nav->setActiveClass("current active");
                    $nav->setUlId("navigationMain", 0);
                    echo $nav->getNavigationByCategory(5);
                    ?>
                </div>
            </div>
            <div style="clear:both;"></div>
            <div id="footerArticleContent"></div>
        </div>
    </div>

    <script type="text/javascript">

        var _gaq = _gaq || [];
        _gaq.push(['_setAccount', 'UA-46862164-1']);
        _gaq.push(['_trackPageview']);

        (function () {
            var ga = document.createElement('script');
            ga.type = 'text/javascript';
            ga.async = true;
            ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(ga, s);
        })();

    </script>
</body>
</html>
