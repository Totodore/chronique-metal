<?php 
    include '../../src/html/system/init.php';

    $type = $_POST['type'];
    $id = $_POST['id'];
    if ($_POST['content_text'] != "")// si ya rien marqué dans input
        $content = preg_quote($_POST['content_text']);
    else 
        $content = $_POST['content_input'];
    
    $attr = $_POST['attr'];

    $query = $bdd->prepare('UPDATE '.$type.' SET '.$attr.'= :content WHERE id='.$id); 

    if (!$query->execute(array('content' => $content)))
        print_r($query->errorInfo());
    echo "La base de donnée à bien été mise à jour...<br /><br />";

?>