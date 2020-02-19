<?php 
    include '../system/init.php';
    
    $list_photos = $bdd->query("SELECT * FROM photos ORDER BY date DESC");
    $array = array('janvier','février','mars' ,'avril' ,'mai' ,'juin' ,'juillet' ,'aout' ,'septembre' ,'octobre' ,'novembre' ,'décembre');
    $from = $_GET["from"];  //on recup la position actuelles des photos
    $photos_prep = array();
    for ($ind = 0; $ind < $list_photos->rowCount(); $ind++) {   //on recup chaque ligne
        array_push($photos_prep, $list_photos->fetch());
    }
    if($from + 1 > count($photos_prep)) {
        echo "no photos";
        exit;
    }

    $photos = array_slice($photos_prep, $from, 3);  //qu'on coupe par groupe de 3
?>
<?php foreach($photos as $key => $photo) {?>  <!-- Pour chaque albums ds la bdd-->
    <div class="disp_photos">
        <h4 class="title_photos"><?php echo $photo['titre']; ?></h4>
        <div id="wrapper_photos">
            <ul class="slider">
            <?php
                $photos_array = scandir("../../../images/photos/".$photo['photos_file']); 
                for ( $i = 2; count($photos_array) > $i; $i++) { //on recup toutes les photos dans le fichier 
            ?>
                <li>
                    <span class="number_text" <?php if ($i == 2) echo "style='display:inline'" ?>></span>
                    <img src="../../../images/photos/<?php echo $photo['photos_file']."/".$photos_array[$i]; ?>" class="photos" <?php if ($i == 2) echo "style='display:inline'" ?> />
                </li>
            <?php } ?>
            </ul>
            <div class="indicators">    <!-- On affiche les icones-->
                <a class="prev" onclick="changeSlide(-1, this)">&#10094;</a>
                <a class="next" onclick="changeSlide(1, this)">&#10095;</a>
                <i class="material-icons openModal" onclick="openModal(this)">aspect_ratio</i>
            </div>
            <ul class="row_thumbmails">
            <?php 
                for ( $i = 2; count($photos_array) > $i; $i++) { //on rerecup les photos pour les thumbnails
            ?>
                <li class="columns_thumbmails"  onclick="currentSlide(<?php echo $i - 1; ?>, this);">
                    <img src="../../../images/photos/<?php echo $photo['photos_file']."/".$photos_array[$i]; ?>" class="thumbmails" <?php if ($i == 2) echo "style='opacity:1'" ?>/>
                </li>
            <?php } ?>
                </ul>
        </div>
    </div>
<?php } ?>