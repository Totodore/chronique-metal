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
        <title>Radio Metal Sound - Chroniques Métal</title>
        <meta name="description" content="Retrouvez içi la Web Radio dans la quelle je passe régulièrement pour parler métal" />
        <link rel="stylesheet" type="text/css" media="screen" href="/src/css/live-radio.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
        <script src="/src/libs/progressbar.js/dist/progressbar.js"></script>
        <script src="/src/js/live-radio.js"></script>
        <script src="/src/libs/wimpy_7.51/wimpy.js"></script>
        <script src="/src/libs/StreamInfoRadionomy/StreamInfoRadionomy.js"></script>
    </head>
<body>
    <div id="wrapper">
        <?php include "../../src/html/system/header.php"; ?>
            <main id="main">
                <article id="article">
                    <h3 class="title_article">Radio Metal Sound</h3>
                    <span class="ajax_status"><div class="lds-css ng-scope"><div style="width:100%;height:100%" class="lds-dual-ring"><div></div></div></div></span>
                    <div id="wrapper_radio">
                        <div id="wrapper_live">
                            <h4 class="title_radio">Radio direct :</h4> 
                            <div id="wrapper_iframe">
                            </div>   
                            <div id="wrapper_current_song">
                                <h4 class="title_radio">Titre actuel :</h4>
                                <div id="wrapper_current_metadata"></div>
                                <div class="progress_bar"></div></a>
                                <i class="fab fa-youtube icon_yt" onclick="openModal()"></i>
                            </div>
                        </div>
                        <div id="wrapper_metadata">
                            <h4 class="title_radio">Derniers titres joués : </h4>
                            <div class="metadata">
                            </div>
                        </div>
                    </div>
                    <?php if ($pre_render != NULL) { ?>
                    <div id="wrapper_program">
                        <h4 class="title_radio">Mes heures de passage cette semaine :</h4>
                        <table id="table_passage">
                            <tr class="caption">
                                <td>Titre de l'émission:</td>
                                <td>Jour de l'émission:</td>
                                <td>Heure de lancement:</td>
                                <td>Duree de l'émission:</td>
                            </tr>
                            <?php foreach($pre_render as $key => $render) { ?>
                            <tr>
                                <td><?php echo $render['name']; ?></td>
                                <td><?php echo $day[$key]; ?></td>
                                <td><?php echo date("H" ,strtotime($render['time_start']))." heure<br />".date("i" ,strtotime($render['time_start']))." minutes"; ?></td>
                                <td><?php echo date("H" ,strtotime($render['duration']))." heure<br />".date("i" ,strtotime($render['duration']))." minutes"; ?></td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                    <?php } ?>
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
                    <span class="open_discord" onclick="openModal('discord')">
                        <p>Vient nous retrouver sur le serveur discord de Radio Metal Sound !</p>
                    </span>
                <div id="error_radio">
                    <h4 class="error_title">Ouuups !! Radio Metal Sound semble être temporairement fermée.</h4>
                </div>
            </article>
        </main>
        <?php include "../../src/html/system/footer.php"; ?>
    </div>
    <div id="viewer"></div>
    <div id="modal_discord"></div>
    <div id="overlay"></div>
</body>
</html>