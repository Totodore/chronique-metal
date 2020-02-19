<?php 
    function str_process($str, $size) {
        $str = stripslashes($str);  //On supprimes les backslashes de protection
        $str = strip_tags($str); //On vire tous les tags html
        $str = explode(" ", $str, $size);  //on separe la str en array
        $str = array_slice($str, 0, $size-2);    //On prend les 48 premiers mots
        $str = implode(" ", $str); //On reconvertit en str
        return $str;
    }
    include '../system/init.php';

    $from = $_GET["from"];  //on recup la position actuelles des photos
    $type = $_GET["type"];
    $tbl_chroniques = $bdd->query("SELECT * FROM ".$type." ORDER BY date DESC")->fetchAll(PDO::FETCH_ASSOC);

    $array = array('janvier','fevrier','mars' ,'avril' ,'mai' ,'juin' ,'juillet' ,'aout' ,'septembre' ,'octobre' ,'novembre' ,'decembre');

    if($from + 1 > count($tbl_chroniques)) {   //si ya plus rien a afficher on anul
        echo "no data";
        exit;
    }

    $tbl_chroniques = array_slice($tbl_chroniques, $from, 9);
?>
<?php foreach($tbl_chroniques as $key => $chronique) { ?>
    <div id="text">
        <a href="/fr/read/?id=<?php echo $chronique['ID']; ?>&type=<?php echo $chronique['type']?>">
            <h4 class="title_text"><?php echo str_process($chronique['titre'], 9);
            if (str_word_count($chronique['titre']) > 9 ) echo " ..."; ?></h4>
            <span class="date_text">
                <?php 
                    $year = substr($chronique['date'], 0, 4);
                    $month = substr($chronique['date'], 5, 2);
                    $day = substr($chronique['date'], 8, 2);
                    echo 'Le '.$day.' '. $array[$month - 1] .' '.$year;
                ?>
            </span>
            <span class="author_text"> par <?php echo $chronique['auteur']; ?></span>
            <p class="content_text"><?php echo str_process($chronique['text'], 50) ?> ...</p>
        </a>
    </div>
<?php } ?>