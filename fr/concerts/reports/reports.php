<?php 
    include '../../../src/html/system/init.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include '../../../src/html/system/init.html'; ?>
        <title>Reports - Chroniques Metal</title>
        <meta name="description" content="Retrouvez içi tous mes reports écris des différents concerts où je me déplace" />
		<link rel="stylesheet" type="text/css" media="screen" href="/src/css/texts.css" />
        <script type="text/javascript" src="/src/js/texts.js"></script>
        <script type="text/javascript">var type = "concerts";</script>
    </head>
<body>
    <div id="wrapper">
        <?php include "../../../src/html/system/header.php"; ?>
            <main id="main">
                <article id="article">
                    <h3 class="title_article">Reports</h3>
                    <div>
                        <div id="disp_texts">
                        </div>
                        <span class="ajax_status"><div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-dual-ring"><div></div></div></div></span>
                    </div>
                </article>
            </main>
        <?php include "../../../src/html/system/footer.php"; ?>
    </div>
</body>
</html>