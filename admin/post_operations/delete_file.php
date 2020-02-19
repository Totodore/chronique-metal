<?php 
    include '../../src/html/system/init.php';
    $id = $_GET['id'];
    $type = $_GET['type'];
    $el = $bdd->query("SELECT * FROM " . $type . " WHERE ID=" . $id)->fetch();

    if ($type == "photos") {    //Si ce sont des albums photos
        system("rm -rf ../../images/photos/".$el['photos_file']);   //on supprime le dossier
        console_log("Removing photos");
    }
    if ($type == "sponsorts") { //si ce sont des sponsors on supprime la photo
        unlink("../..".$el['image']);   
        console_log("Removing image");
    }
    if ($type == "concerts" || $type == "chroniques" || $type == "interviews") {    //Si ce sont des texts
        $doc = new DomDocument();  
        $doc->loadHTML(stripslashes($el['text']));  //On recup le DOM
        $doc->normalize();
        $imgs = $doc->getElementsByTagName("img");  //Pour trouver les img
        for ($i; $i < $imgs->length; $i++) {    //pour chaque
            $path = parse_url($imgs->item($i)->getAttribute("src"))['path'];    //On récup le chemin depuis l'attr src
            unlink("../..".$path);  //On supprime l'img
            console_log("Removing image");
        }
    }
    if (!$bdd->query('DELETE from '.$type.' WHERE ID='.$id)) {
        echo "<p>Erreur lors de la suppression...</p>";
    }
    else {
?>
<p>Supression terminée, vous allez être redirigé dans 2sec...</p>
<script>
    setTimeout(function() {window.location.href = "/post_operations/"}, 2000);
</script>
<?php } ?>