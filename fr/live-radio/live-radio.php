<?php 
    include '../../src/html/system/init.php';
    function objToArray($obj) {
        $array = Array( //on fait ca pour pvr le stocker ensuite dans une autre array
            'name' => $obj['name'],
            'time_start' => $obj['time_start'],
            'time_end' => $obj['time_end'],
            'duration' => $obj['duration'],
            'day' => $obj['day'],
            'date' => $obj['date'],
            'ID' => $obj['ID']
        );
        return $array;
    }
    $live_program = $bdd->query("SELECT * FROM live_programme");
    $last_articles = $bdd->query("SELECT * FROM last_chronique")->fetchAll();
    $return = usort($last_articles, function($a, $b) {
        if (strtotime($a["date"]) < strtotime($b["date"]))
            return 1;
        else return -1;
    });
    $pre_render = Array();  //Array stockant les bons horaires
    $day = Array();
    $frenchDays = Array(
        0 => "Dimanche",
        1 => "Lundi",
        2 => "Mardi",
        3 => "Mercredi",
        4 => "Jeudi",
        5 => "Vendredi",
        6 => "Samedi"
    );
    while ($line = $live_program->fetch()) {
        if ($line['day'] != "") {//si c'est un horaire regulie ca passe
            array_push($pre_render, objToArray($line));
            array_push($day, $line['day']);   //on get aussi le jour de la semaine
        }
        else {
            $start = strtotime($line['date']." ".$line['time_start']);    //on recup le timestamp de l'horaire de debut
            if ($start < strtotime('Monday') AND $start > strtotime('Sunday')) {    //si celui-ci est compris dans la semaine
                array_push($pre_render, objToArray($line));   //il passe
                array_push($day, $frenchDays[date('w', strtotime($line['date']))]); //on recup le jour de la semaine avec l'index de date();
            }
        }
    }

?>
<!DOCTYPE html>
<html>
    <head>
        <?php include '../../src/html/system/init.html'; ?>
        <title>Radio Metal Sound - Chroniques Metal</title>
        <meta name="description" content="Retrouvez içi la Web Radio dans la quelle je passe régulièrement pour parler métal" />
        <link rel="stylesheet" type="text/css" media="screen" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <link rel="stylesheet" href="/src/css/live_radio.css" />
        <script src="/src/js/live_radio.js"></script>
    </head>
<body>
    <div id="wrapper">
        <?php include "../../src/html/system/header.php"; ?>
            <main id="main">
                <article id="article">
                    <h3 class="title_article">Radio Metal Sound</h3>
                    <?php if ($last_articles != NULL) { ?>
                        <div id="wrapper_articles">
                            <h3 class="title_radio">Articles de Radio Metal Sound</h3>
                            <div id="disp_articles">
                            <?php foreach($last_articles as $article) { ?>
                                <div class="article">
                                    <a href="<?php echo $article['link']?>" target="_blank"><?php echo $article['title']; ?></a>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    <?php } ?>
                    <div id="wrapper_video">
                        <h3 class="title_radio">Dernières vidéos de Radio Metal Sound</h3>
                        <div id="disp_videos">
                            <span class="ajax_status"><div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-dual-ring"><div></div></div></div></span>
                        </div>
                    </div>
                    <span class="open_discord" onclick="openModal('discord')">
                        <p>Vient nous retrouver sur le serveur discord de Radio Metal Sound !</p>
                    </span>
            </article>
        </main>
        <?php include "../../src/html/system/footer.php"; ?>
    </div>
    <div id="modal_discord"></div>
    <div id="overlay"></div>
</body>
</html>