<?php 
    include '../system/init.php';

    if (!isset($_GET['accept'])) { //Si c'est une inscription
        $email = strip_tags($_POST['email']);
        $first_name = strip_tags($_POST['first_name']);
        $name = strip_tags($_POST['name']);
        $test = $bdd->query('SELECT * from notifications WHERE email="'.$email.'"');
        if ($test->fetch()['email'] == $email)
        {
            echo "false_email";
            exit;
        }
        $query = $bdd->prepare('INSERT INTO notifications (email, first_name, name) 
        VALUES(:email, :first_name, :name)');
        $query->execute(array(
            'email' => $email,
            'first_name' => $first_name,
            'name' => $name
        ));
        setcookie("notif", "true", time() + (10 * 365 * 24 * 60 * 60), "/");
        echo "Ton adresse mail a bien été enregistré ! Merci beaucoup de ton soutient ! Tu devrais être redirigé dans quelques secondes...";
    }
    else if (isset($_GET['email'])) {   //Si c'est une desinscription
        $email = strip_tags($_GET['email']);
        $test = $bdd->query('SELECT * from notifications WHERE email="'.$email.'"');
        if ($test->fetch()['email'] == false)
        {
            echo "false_email";
            exit;
        }
        $bdd->query('DELETE FROM notifications WHERE email="'.$email.'"');
        setcookie("notif", "", time() + (10 * 365 * 24 * 60 * 60), "/");
        echo "Votre désinscription pour l'adresse mail ".$email." a bien été enregistrée, vous allez être redirigé dans quelques secondes...";
    }
    else { //Si c'est un refus
        setcookie("notif", "false", time() + (10 * 365 * 24 * 60 * 60), "/");
    }
?>