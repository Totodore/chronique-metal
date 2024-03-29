<?php 
    include '../../../src/html/system/init.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include '../../../src/html/system/init.html'; ?>
        <title>Hellfest 2018 - Chroniques Metal</title>
        <meta name="description" content="Retrouvez içi toutes mes vidéos d'interviews" />
        <link rel="stylesheet" type="text/css" media="screen" href="/src/css/videos.css" />
        <script type="text/javascript" src="/src/js/videos.js"></script>
        <script>var playlist = "PLfXkEVCWgVVOgNCnfpTD6RSU9ebsNFMPP";</script>
    </head>
<body>
    <div id="wrapper">
        <?php include "../../../src/html/system/header.php"; ?>
            <main id="main">
                <article id="article">
                    <h3 class="title_article">Interviews Hellfest</h3>
                    <div id="wrapper_videos"></div>
                    <span class="ajax_status"><div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-dual-ring"><div></div></div></div></span>
                </article>
            </main>
        <?php include "../../../src/html/system/footer.php"; ?>
    </div>
</body>
</html>