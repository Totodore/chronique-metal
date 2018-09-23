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
    $titre = $_POST['titre'];
    $auteur = $_POST['auteur'];
    $date = $_POST['date'];
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
                echo "Decompression du fichier...<br /><br />";
                $return = exec("unzip '".$infosfichier["basename"]."'");    //on unzip
                if ($return == "")  //si il n'y a pas de retour dans stdout c'est que ya une erreur
                {
                    exec("unzip '".$infosfichier["basename"]."' 2>&1", $error); //on reteste pour recup l'erreur
                    echo "Erreur : Probleme lors de la decompression du .zip :<br /><br />";
                    print_r($error);    //on l'affiche
                    exit;
                }
                else
                    echo "Le fichier .zip a bien ete decompresse ! <br /><br />";
                unlink($infosfichier['basename']); //on supprime le zip
                $images_array = scandir("./");
                echo "Renommage de chaque image...<br /><br />";
                for ($i = 2; count($images_array) > $i; $i++)
                {
                    $randomName = random(10);
                    rename($images_array[$i], $randomName . "." . pathinfo($images_array[$i])["extension"]);
                    //On renomme les images avec du random et on rajoute l'extension a la fin 
                }
            }
            else 
            { echo "Erreur : Le fichier doit etre obligatoirement un .zip !!"; exit;}
        }
        else
            { echo "Erreur : Le fichier n'est pas de la bonne extension"; exit; }
    }
    else 
        { echo "Erreur : Pour une raison inconnu le fichier n'as pas pu etre upload"; exit; }
    
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
        echo "BDD mise a jour !!! Upload termine";
?>