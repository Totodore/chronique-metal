<?php 
    include "../../src/html/system/init.php";
    function random($car) {
        $string = "";
        $chaine = "abcdefghijklmnpqrstuvwxy";
        srand((double)microtime() * 1000000);
        for ($i = 0; $i < $car; $i++) {
            $string .= $chaine[rand() % strlen($chaine)];
        }
        return $string;
    }
    $randomFile = random(5);
    if (isset($_POST['titre']) && isset($_POST['auteur']) && isset($_POST['date'])) {
        $titre = $_POST['titre'];
        $auteur = $_POST['auteur'];
        $date = $_POST['date'];
    }
    else {
        echo "Une erreur est apparue dans le formulaire envoyé !";
        exit;
    }
    if (isset($_FILES['image']) and $_FILES['image']['error'] == 0)       //Si le texte est set
    {
        $imageFile = $_FILES['image'];
        $infosfichier = pathinfo($imageFile['name']);
        if($infosfichier["extension"] == "png" OR $infosfichier["extension"] == "jpg" OR $infosfichier["extension"] == "zip")
        {
            if($infosfichier["extension"] == "zip")
            {
                chdir("../../images/photos/");
                exec("mkdir -m 777 ".$randomFile);  //on cree un nv dossier pour l'album
                chdir($randomFile);
                move_uploaded_file($imageFile["tmp_name"], $imageFile["name"]); //on bouge le zip dedans
                echo "Décompression du fichier...<br /><br />";
                $return = exec("unzip '".$infosfichier["basename"]."'");    //on unzip
                if ($return == "")  //si il n'y a pas de retour dans stdout c'est que ya une erreur
                {
                    exec("unzip '".$infosfichier["basename"]."' 2>&1", $error); //on reteste pour recup l'erreur
                    echo "Erreur : Problème lors de la decompression du .zip :<br /><br />";
                    print_r($error);    //on l'affiche
                    exit;
                }
                else
                    echo "Le fichier .zip a bien été décompressé ! <br /><br />";
                unlink($infosfichier['basename']); //on supprime le zip
                $images_array = scandir("./");
                echo "Réatribution des noms des images...<br /><br />";
                for ($i = 2; count($images_array) > $i; $i++)
                {
                    $randomName = random(10);
                    rename($images_array[$i], $randomName . "." . pathinfo($images_array[$i])["extension"]);
                    //On renomme les images avec du random et on rajoute l'extension a la fin 
                }
            }
            else 
            { echo "Erreur : Le fichier doit être obligatoirement un .zip !!"; exit;}
        }
        else
            { echo "Erreur : Le fichier n'est pas de la bonne extension"; exit; }
    }
    else 
        { echo "Erreur : Pour une raison inconnu le fichier n'a pas pu être upload"; exit; }
    
    $query = $bdd->prepare('INSERT INTO photos (photos_file, titre, auteur, date) 
    VALUES(:photos_file, :titre, :auteur, :date)');
    if (!$query->execute(array(
        'photos_file' => $randomFile,
        'titre' => $titre,
        'auteur' => $auteur,
        'date' => $date
    )))
        print_r($query->errorInfo());
    else
        echo "BDD mise à jour !!! Upload terminé";
?>