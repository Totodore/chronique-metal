<?php 
    include '../system/init.php';
    if (isset($_GET['query']) && $_GET['query'] != "") {
        $results = array();
        $query = $_GET['query'];
        $results_chr = $bdd->prepare("SELECT * FROM chroniques WHERE titre LIKE :query");
        $results_chr->execute(array(':query' => '%'.$query.'%'));
        $results_con = $bdd->prepare("SELECT * FROM concerts WHERE titre LIKE :query");
        $results_con->execute(array(':query' => '%'.$query.'%'));
        $results_int = $bdd->prepare("SELECT * FROM interviews WHERE titre LIKE :query");
        $results_int->execute(array(':query' => '%'.$query.'%'));
        $results_pht = $bdd->prepare("SELECT * FROM photos WHERE titre LIKE :query");
        $results_pht->execute(array(':query' => '%'.$query.'%'));
        $results_ply = $bdd->prepare("SELECT * FROM playlists WHERE titre LIKE :query");
        $results_ply->execute(array(':query' => '%'.$query.'%'));
        $results = array_merge($results_chr->fetchAll(), $results_con->fetchAll(), $results_int->fetchAll(), $results_pht->fetchAll(), $results_ply->fetchAll());
        usort($results, function ($a, $b) {
            $order = strcasecmp($a['titre'], $b['titre']);
            if ($order == 0)
                return 1;
            else return $order;
        });
        // $max = (count($results) < 5) ? count($results) : 5;
        for ($i = 0; $i < count($results); $i++) {
            $row = $results[$i]; 
            if ($row['type'] == "playlists") {
                $link = "/fr/videos/?id=".$row['ID'];
                $icon = '<i class="fab fa-youtube icon_search"></i>';
            }
            else if ($row['type'] == "photos") {
                $link = "/fr/concerts/photos/";
                $icon = '<i class="fas fa-images icon_search"></i>';
            }
            else {
                if ($row['type'] == "chroniques")
                    $icon = "<i class='far fa-newspaper icon_search'></i>";
                else if ($row['type'] == "concerts") 
                    $icon = '<i class="fas fa-music icon_search"></i>';
                else if ($row['type'] == "interviews") 
                    $icon = '<i class="far fa-comments icon_search"></i>';    
                $link = "/fr/read/?id=".$row['ID']."&type=".$row['type'];
            }?>
            <a class="el_result" href="<?php echo $link?>">
                <?php echo $icon ?>                
                <h4><?php echo $row['titre']?></h4>
            </a>
        <?php }
    }
?>