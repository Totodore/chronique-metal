<?php
    include '../../src/html/system/init.php';
    function random($car) {
        $string = "";
        $chaine = "abcdefghijklmnpqrstuvwxy";
        srand((double)microtime() * 1000000);
        for ($i = 0; $i < $car; $i++) {
            $string .= $chaine[rand() % strlen($chaine)];
        }
        return $string;
    }
    $random = random(5);
    $link = $_POST['link'];
    if (isset($_FILES['image'])) {   //si l'image est set
        if ($_FILES['image']['error'] == 0)       //Si l'image n'as pas d'erreur
        {
            if ($_FILES['image']['size'] <= 8000000)     //Si il est en dessous de 8mo
            {
                $infosfichier = pathinfo($_FILES['image']['name']);      //récupération du chemin du texte
                $image_file = $_FILES['image'];
                if ($infosfichier["extension"] == "jpg" || $infosfichier["extension"] == "png" || $infosfichier['extension'] == "jpeg") {
                    echo "Taille de l'image : " . $image_file['size'] . " octets<br>";
                    echo "extension de l'image : " . $infosfichier['extension'] . "<br>";
                    move_uploaded_file($image_file['tmp_name'], "../../images/sponsorts/" . $random . "." . $infosfichier["extension"]);		//on bouge l'image tout en la renommant par une suite de lettres random 
                    echo "image uploaded !!!<br />";
                    $image = "/images/sponsorts/" . $random . "." . $infosfichier["extension"];
                } else
                    { echo "Erreur : Le fichier n'est pas dans la bonne extension"; exit; }
            } else
                { echo "Erreur : Le fichier est trop gros"; exit; }
        } else
            { echo "Erreur : Pour une raison inconnu le fichier n'as pas pu etre upload"; exit; }
    }
    else if (isset($_POST['image_link'])) {
        chdir("../../images/sponsorts/"); //on se met dans le dossier photos
        echo "Deplacement dans le dossier ".getcwd()."<br /><br />";
        echo "Telechargement de l'image...<br />";
        exec("wget ".$_POST['image_link']); //on dl l'image
        $infoImage = pathinfo($_POST['image_link']); //on recup le nom
        echo "Nom du fichier : ".$infoImage['basename']."<br /><br />";	//on l'affiche
        echo "extension de l'image : " . $infoImage['extension'] . "<br>";
        if ($infoImage['extension'] == "jpg" OR $infoImage['extension'] == "png")	//si c'est du png ou jpg c'est ok
        {
            $name = random(5).".".$infoImage['extension']; //on genere un nom random avec l'extension de l'image
            rename($infoImage['basename'], $name);
            $image = "/images/sponsorts/".$name;
        }	
        else { 
            echo "Erreur : L'image provenant de l'url doit etre de type png ou jpg<br />"; 
            unlink($infoImage['basename']); //on remove le fichier qui n'est pas une image 
            exit;
        }
    }
    else {
        echo "Aucune image fournie...<br /><br />";
        $image = "";
    }
    
    $query = $bdd->prepare('INSERT INTO sponsorts (url, image) 
    VALUES(:url, :image)');
    $query->execute(array(
        'url' => $link,
        'image' => $image,
    ));
    echo "BDD mise a jour !!! Upload termine";
?>