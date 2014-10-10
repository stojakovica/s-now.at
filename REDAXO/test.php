<?php
header('Content-Type: text/html; charset=utf-8');
?>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=Edge" />
        <link rel="stylesheet" type="text/css" href="fullpage/jquery.fullPage.css" />
        <link rel="stylesheet" type="text/css" href="files/main.css" />
        <script src="files/jquery-1.10.2.min.js"></script>
        <script src="fullpage/vendors/jquery.easings.min.js"></script>
        <script type="text/javascript" src="fullpage/vendors/jquery.slimscroll.min.js"></script>
        <script src="fullpage/jquery.fullPage.min.js"></script>
        <script type="text/javascript">
        $(document).ready(function() {
            $('#fullpage').fullpage();
        });
        </script>
    </head>
    <body>
        <div id="fullpage">
            <div class="section">1</div>
            <div class="section">2</div>
            <div class="section">3</div>
        </div>
    </body>
</html>