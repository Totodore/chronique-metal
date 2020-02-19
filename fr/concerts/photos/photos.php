<?php 
	include '../../../src/html/system/init.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <?php include '../../../src/html/system/init.html'; ?>
        <title>Galeries - Chroniques Metal</title>
        <link type="text/css" rel="stylesheet" href="/src/css/photos.css" />
        <meta name="description" content="Retrouvez içi chaque album photos prises lors des différents concerts ou je me rends" />
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <script type="text/javascript" src="/src/js/photos.js"></script>
    </head>
<body>
    <div id="wrapper">
        <?php include "../../../src/html/system/header.php"; ?>
        <main id="main">
            <article id="article">
                <h3 class="title_article">Galeries</h3>
				<span class="ajax_status"><div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-dual-ring"><div></div></div></div></span>
            </article>
        </main>
		<?php include "../../../src/html/system/footer.php"; ?>
	</div>
	<div id="overlay"></div>
	<div id="viewer"></div>
</body>
</html>