<?php 
include '../src/html/system/init.php';
$sponsorts = $bdd->query("SELECT * FROM sponsorts");
$tbl_chroniques = $bdd->query("SELECT * FROM chroniques");
$tbl_concerts = $bdd->query("SELECT * FROM concerts");
$tbl_interviews = $bdd->query("SELECT * FROM interviews");
$tbl_photos = $bdd->query("SELECT * FROM photos");
$tbl_announces = $bdd->query("SELECT * FROM annouces")->fetchAll(PDO::FETCH_ASSOC);
$tbl_array = array();
$month_array = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'décembre');

while ($element = $tbl_chroniques->fetch(PDO::FETCH_ASSOC)) {
    array_push($tbl_array, $element);
}
while ($element = $tbl_concerts->fetch(PDO::FETCH_ASSOC)) {
    array_push($tbl_array, $element);
}
while ($element = $tbl_interviews->fetch(PDO::FETCH_ASSOC)) {
    array_push($tbl_array, $element);
}
while ($element = $tbl_photos->fetch(PDO::FETCH_ASSOC)) {
    array_push($tbl_array, $element);
}
usort($tbl_array, function ($a, $b) {    //fonction de tri d'un array
    if (strtotime($a['date']) > strtotime($b['date']))  //si le timestamp de a > b ca renvoi -1 sinon ca renvoie 1
    return -1;
    else
    return 1;
});
$tbl_array = array_slice($tbl_array, 0, 5);
?>
<!DOCTYPE html>
<html>

<head>
    <?php include('../src/html/system/init.html'); ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../src/css/chronique-metal.css" />
    <script type="text/javascript" src="../src/js/chronique-metal.js"></script>
    <title>Chronique Metal</title>
</head>

<body>
    <div id="wrapper">
        <?php include('../src/html/system/header.php'); ?>

        <main id="main">
            <img src="../src/images/banner.png" class="img_banner" />
            <img src="../src/images/banner_mobile.png" class="img_banner_mobile" />
            <article id="article">
                <h3 class="title_article">WELCOME METALHEADS</h3>
                <div id="text_welcome_article">
                    <p>
                        Ce site est la continuité de la page <a href="https://www.facebook.com/ChroniqueMetal/" target="_blank">Facebook</a> du même nom (et aussi celle de l'ancien site). Vous y trouverez toutes les chroniques publiées depuis sa création et toutes les vidéos présentes sur notre chaîne. En naviguant sur ce site vous trouverez aussi des news, des interviews, des reports de concerts, une webradio où je travaille : <a href="http://www.radiometalsound.fr/" target="_blank">Radio Metal Sound</a> ...
                    </p>
                    <p>
                        Chronique Metal possède aussi un compte <a href="https://open.spotify.com/user/chronique.metal" target="_blank">Spotify</a> ! Vous y trouverez des anciennes playlists de chroniqueurs et aussi un Best Of de chaque année depuis 2016 proposé par G.
                    </p>
                    <p>
                        Sur ce bon voyage !
                    </p>
                </div>
                <h5 class="title_note_welcome_article">Note aux visiteurs</h5>
                <p class="note_welcome_article">
                    Le site offre un espace commentaire en dessous de chaque article, merci d'y être respectueux, tout abus ou contenu inapproprié sera supprimé.
                </p>
            </article>
            <?php if ($tbl_announces) { ?>
            <article id="article">
                <h3 class="title_article">Annonces</h3>
                <div id="display_announce">
                    <?php
                    foreach ($tbl_announces as $announce) { ?>
                    <h5>
                        <?php echo $announce['titre'] ?>
                    </h5>
                    <p>
                        <?php echo strip_tags(stripslashes($announce['text'])) ?>
                    </p>
                    <?php 
                }
                ?>
                </div>
            </article>
            <?php 
        } ?>
            <article id="article">
                <h3 class="title_article">Dernières parutions</h3>
                <div id="display_news">
                    <?php foreach ($tbl_array as $element) {
                        if ($element['type'] == "chroniques") {
                            $icon = "<i class='far fa-newspaper news_icon'></i>";
                        } else if ($element['type'] == "concerts") {
                            $icon = '<i class="fas fa-music news_icon"></i>';
                        } else if ($element['type'] == "interviews") {
                            $icon = '<i class="far fa-comments news_icon"></i>';
                        }
                        $link = "/fr/read/?id=" . $element['ID'] . "&type=" . $element['type'];
                        if ($element['type'] == "photos") {
                            $link = "./concerts/photos/?id=" . $element['ID'];
                            $icon = '<i class="fas fa-camera news_icon"></i>';
                        }
                        ?>
                    <a href="<?php echo $link ?>" class="news_el">
                        <div style="display: flex">
                            <?php echo $icon ?>
                            <h3 class="news_title">
                                <?php echo $element['titre'] ?>
                            </h3>
                        </div>
                        <p class="news_meta">
                            <?php 
                            $year = substr($element['date'], 0, 4);
                            $month = substr($element['date'], 5, 2);
                            $day = substr($element['date'], 8, 2);
                            echo 'le ' . $day . ' ' . $month_array[$month - 1] . ' ' . $year;
                            ?>
                        </p>
                    </a>
                    <?php 
                } ?>
                </div>
            </article>
            <article id="article">
                <h3 class="title_article">Nos Partenaires</h3>
                <div id="display_partners">
                    <?php while ($sponsort = $sponsorts->fetch()) { ?>
                    <a href="<?php echo $sponsort['url'] ?>" target="_blank"><img src="<?php echo $sponsort['image'] ?>" /></a>
                    <?php 
                } ?>
                </div>
            </article>
        </main>
        <?php include '../src/html/system/footer.php'; ?>
    </div>
    <div id="overlay"></div>
    <div id="ask_notif">
        <h5 class="title_notif">
            Hey ! Veux-tu être notifié par mail des sorties de mes chroniques écrites et de mes passages en radio ?
            <i class="material-icons" onclick="openModalNotif()">done</i>
            <i class="material-icons" onclick="refuseNotif(false)">clear</i>
        </h5>
    </div>
    <div id="cred_modal">
        <p>Entrez vos informations personnelles pour pouvoir être notifié des derniers articles écrits ou des passages en radio</p>
        <form method="POST" class="notif_form">
            <input type="text" required placeholder="Prenom" name="first_name" /><br />
            <input type="text" required placeholder="Nom" name="name" /><br />
            <input type="email" required placeholder="Email" name="email" /><br />
            <input type="submit" value="Je veux être notifié !"><br />
            <p class="return_data"></p>
        </form>
    </div>
    <div id="unsub_modal">
        <p>Entrez votre adresse email correspondant à votre abonnement</p>
        <input type="email" class="mail_unsub" required placeholder="Email"><br />
        <input type="button" class="unsub" value="Je ne veux plus être notifié !" /><br />
        <p class="return_data"></p>
    </div>
    <script type="text/javascript">
        <?php if (isset($_GET['notif']) and $_GET['notif'] == 'true') { ?>
        $(function() {
            openModalNotif();
        });
        <?php 
    } else if (isset($_GET['notif']) and $_GET['notif'] == 'false') { ?> //si on demande de virer l'option
        $(function() {
            openUnsubModal();
        });
        <?php 
    } else if (!isset($_COOKIE['notif'])) { ?> //si rien n'est demande mais que ya pas de notifs set on propose...
        $(function() {
            openNotif();
        })
        <?php 
    } ?>
    </script>
</body>

</html> 