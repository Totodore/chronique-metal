<?php 
    include '../system/init.php';
    $currentPage = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if ($_SERVER['REQUEST_METHOD'] == "GET" && strcmp(basename($currentPage), basename(__FILE__)) == 0)
    {
        http_response_code(404);
        header("Location: /");
        die(); /* remove this if you want to execute the rest of
                the code inside the file before redirecting. */
    }

    $date_array = array('janvier', 'fevrier', 'mars', 'avril', 'mai', 'juin', 'juillet', 'aout', 'septembre', 'octobre', 'novembre', 'decembre');

    $from = $_GET['from'];
    $id_article = $_GET['article_id'];
    $type = $_GET['type'];

    $tbl_comments = $bdd->query("SELECT * FROM comments WHERE type='".$type."' AND article_id='".$id_article."' ORDER BY DATE Desc")->fetchAll(PDO::FETCH_ASSOC);
    // On recup toutes la table que l'on coupe par groupe de 10
    if ($from + 1 > count($tbl_comments)) {   //si ya plus rien a afficher on anul
        echo "no data";
        exit;
    }
    $tbl_comments = array_slice($tbl_comments, $from, 10);

    foreach ($tbl_comments as $key => $comment) { 
        if ($key % 2 == 0) $class = "comment_el_1"; else $class = "comment_el_2"; ?>
        <div class="<?php echo $class ?>">
            <h5 class="comment_author"><?php echo $comment['auteur'] ?></h5>
            <p class="comment_body"><?php echo $comment['text'] ?></p>
            <p class="comment_date">
                <?php 
                $year = substr($comment['date'], 0, 4);
                $month = substr($comment['date'], 5, 2);
                $day = substr($comment['date'], 8, 2);
                echo 'Le ' . $day . ' ' . $date_array[$month - 1] . ' ' . $year;
                ?>
            </p>
        </div>
    <?php } ?>