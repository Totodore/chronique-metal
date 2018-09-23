<?php 
    include '../../src/html/system/init.php';
    if (!isset($_GET['type']) OR !isset($_GET['id']))
        header("location:../");
    $chronique_query = $bdd->query("SELECT * FROM ".$_GET['type']." WHERE ID='".$_GET['id']."'");
    $chronique = $chronique_query->fetch(0);
    $array = array('janvier','février','mars' ,'avril' ,'mai' ,'juin' ,'juillet' ,'aout' ,'septembre' ,'octobre' ,'novembre' ,'décembre');
?>

<!DOCTYPE html>
<html>
<head>
    <?php include '../../src/html/system/init.html'; ?>
    <title><?php echo $chronique['titre']; ?> - Chronique Metal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="/src/js/read.js"></script>
    <link rel="stylesheet" type="text/css" media="screen" href="/src/css/read.css" />
    <script type="text/javascript">
        var article_id = "<?php echo $_GET['id'] ?>";
        var article_type = "<?php echo $_GET['type'] ?>";
    </script>
</head>
<body>
    <div id="wrapper">
        <?php include "../../src/html/system/header.php"; ?>
            <main id="main">
                <article id="article">
                    <h3 class="title_article"><?php echo $chronique['titre']; ?></h3>
                    <div id="text">
                        <?php echo stripslashes($chronique['text']); ?>
                        <br />
                        <p class="metadata">
                            <?php 
                                echo $chronique['auteur']." ";
                                $year = substr($chronique['date'], 0, 4);
                                $month = substr($chronique['date'], 5, 2);
                                $day = substr($chronique['date'], 8, 2);
                                echo 'le '.$day.' '. $array[$month - 1] .' '.$year;
                            ?>
                        </p>          
                    </div>
                    <span class="to_write_comment" onclick="openModal()">
                        <p>Écrire un commentaire</p>
                    </span>
                </article>
                <article id="article">
                    <h3 class="title_article">Commentaires</h3>
                    <div id="disp_comments"></div>
                    <span class="ajax_status"><div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-dual-ring"><div></div></div></div></span>
                </article>
            </main>
        <?php include "../../src/html/system/footer.php"; ?>
    </div>
    <div id="wrapper_comment" method="POST">
        <form class="form_comment">
            <h5>Entrez votre commentaire :</h5>
            <input type="text" placeholder="Pseudonyme" required maxLength="25" name="pseudo" /><br /><br />
            <textarea name="text" required min=10 placeholder="Contenu de votre commentaire :"></textarea><br /><br />
            <input type="submit" value="Envoyer !"/><br />
        </form>
        <span class="ajax_status_form"><div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-dual-ring"><div></div></div></div></span>
    </div>
    <div id="overlay"></div>
</body>
</html>