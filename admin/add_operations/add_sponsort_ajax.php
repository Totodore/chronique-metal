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
                    move_uploaded_file($image_file['tmp_name'], "../../images/sponsorts/" . $random . "." . $infosfichier["extension"]);		//on bouge l'image tout en la renommant par une suite de lettres random 
                    echo "<p>Image envoyée !!!</p>";
                    $image = "/images/sponsorts/" . $random . "." . $infosfichier["extension"];
                } else
                    { echo "<p>Erreur : Le fichier n'est pas dans la bonne extension</p>"; exit; }
            } else
                { echo "<p></p>Erreur : Le fichier est trop gros</p>"; exit; }
        } else
            { echo "<p>Erreur : Pour une raison inconnu le fichier n'a pas pu être upload</p>"; exit; }
    }
    else {
        echo "<p>Aucune image fournie...</p>";
        exit;
    }
    
    $query = $bdd->prepare('INSERT INTO sponsorts (url, image) 
    VALUES(:url, :image)');
    if (!$query->execute(array(
        'url' => $link,
        'image' => $image,
    )))
        echo "<p>Erreur lors de la mise à jour de la base de donnée.</p>";
    else 
        echo "<p>BDD mise à jour !!! Upload terminé</p>";
?>