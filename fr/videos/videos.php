<?php 
    include '../../src/html/system/init.php';
    if(!isset($_GET['id']))
        header('Location:../');
    $playlist = $bdd->query("SELECT * FROM playlists WHERE ID='".$_GET['id']."'");
    $playlist = $playlist->fetch(0);

?>
<!DOCTYPE html>
<html>
    <head>
        <?php include '../../src/html/system/init.html'; ?>
        <title><?php echo $playlist['name']; ?> - Chroniques Métal</title>
        <meta name="description" content="Retrouvez içi toutes mes vidéos Youtube" />
        <link rel="stylesheet" type="text/css" media="screen" href="/src/css/videos.css" />
        <script type="text/javascript">
            var playlist = "<?php echo $playlist['playlist'] ?>";
        </script>
        <script type="text/javascript" src="/src/js/videos.js"></script>
    </head>
<body>
    <div id="wrapper">
        <?php include "../../src/html/system/header.php"; ?>
            <main id="main">
                <article id="article">
                    <h3 class="title_article"><?php echo $playlist['name']; ?></h3>
                    <div id="wrapper_videos"></div>
                    <span class="ajax_status"><div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-dual-ring"><div></div></div></div></span>
                </article>
            </main>
        <?php include "../../src/html/system/footer.php"; ?>
    </div>
</body>
</html>