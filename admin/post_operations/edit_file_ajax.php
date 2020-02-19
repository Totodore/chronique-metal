<?php 
    include '../../src/html/system/init.php';
    function str_process($str) {
        $str = stripslashes($str);  //On supprimes les backslashes de protection
        $str = strip_tags($str); //On vire tous les tags html
        return $str;
    }
    $type = $_POST['type'];
    $id = $_POST['id'];
    if ($_POST['content_text'] != "")// si ya rien marqué dans input
        $content = preg_quote($_POST['content_text']);
    else 
        $content = $_POST['content_input'];
    
    $attr = $_POST['attr'];

    $query = $bdd->prepare('UPDATE '.$type.' SET '.$attr.'= :content WHERE id='.$id); 

    if (!$query->execute(array('content' => $content)))
        echo "<p>Erreur !!! La base de donnée n'à pas pu être mise à jour !!!</p>";
    else {
        echo str_process($content);
    }
?>