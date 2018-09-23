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

    $auteur = strip_tags($_POST['pseudo']);
    $text = strip_tags($_POST['text']);
    $article_id = $_POST['article_id'];
    $type = $_POST['article_type'];
    $class = $_POST['class'];
    
    $query = $bdd->prepare('INSERT INTO comments (auteur, text, type, article_id, date) 
    VALUES(:auteur, :text, :type, :article_id, NOW())');

    if (!$query->execute(array(
        'auteur' => $auteur, 
        'text' => $text,
        'type' => $type,
        'article_id' => $article_id,
    )))
        echo "Ouuups ! Il se pourrait que ce commentaire n'ait pas pu être envoyé";
    else {
        $comment = $bdd->query('SELECT * FROM comments ORDER BY ID desc')->fetch(); 
        if ($class == "comment_el_1") $class = "comment_el_2"; else $class = "comment_el_1" ?>
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
    <?php } 
?>