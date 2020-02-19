<?php include '../../src/html/system/init.php';
    $file = $bdd->query('DESCRIBE '.$_POST['type']);
    $file = $file->fetchAll(PDO::FETCH_ASSOC);
    $array_keys_bdd = Array();
    foreach ($file as $column) {
        array_push($array_keys_bdd, $column['Field']);
    }
    $table = $_POST['type'];    //On retient la table concernée
    array_pop($array_keys_bdd); //On vire l'ID de la table
    $array_keys_post = array_keys($_POST);  //On recup les clés qui restent
    
    $str_prepare = 'INSERT INTO '.$table.' (';
    $array_exec = Array();
    foreach ($array_keys_bdd as $i => $key) {   //Pour chaque clé de la bdd
        if ($i == count($array_keys_bdd)-1) //Si c'est la derniere clé on rajoute pas de virgule a la fin
            $str_prepare .= $key;
        else 
            $str_prepare .= $key.',';
        $array_exec[$key] = $_POST[$key]; //On rajoute la valeur dans l'array qui sera executée
    }
    $str_prepare .= ') VALUES(';    //On rajoute les valeurs
    foreach ($array_keys_bdd as $i => $key) {
        if ($i == count($array_keys_bdd)-1)
            $str_prepare .= ':'.$key; //On rajoute les call des valeurs si c'est la derniere on met pas de virgule
        else
            $str_prepare .= ':'.$key.',';
    }
    $str_prepare .= ')'; 
    
    $query = $bdd->prepare($str_prepare);
    if (!$query->execute($array_exec)) {
        print_r($query->errorInfo());
        exit;
    }
    echo "<p>BDD mise à jour !!! Upload terminé</p>";
    if ($table == "chroniques" OR $table == "concerts" OR $table == "interviews") { //Si ca fait parti des articles a notifier
        $article = $bdd->query("SELECT * FROM " . $table . " WHERE " . $array_keys_bdd[2] . "='" . $array_exec[$array_keys_bdd[2]]."'")->fetch(PDO::FETCH_ASSOC);   //On recup l'id en demandant l'article en fx du texte
        echo "<iframe width=700 height=400 src='../mail.php?subject=" . $table . "&id=" . $article['ID'] . "'></iframe>";
    }

?>