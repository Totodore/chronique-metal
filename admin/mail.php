<?php 
    include '../src/html/system/init.php';
    use PHPMailer\PHPMailer\PHPMailer;

    require_once ($_SERVER["DOCUMENT_ROOT"].'/../src/libs/PHPMailer/src/PHPMailer.php');
    require_once ($_SERVER["DOCUMENT_ROOT"].'/../src/libs/PHPMailer/src/POP3.php');
    require_once ($_SERVER["DOCUMENT_ROOT"].'/../src/libs/PHPMailer/src/OAuth.php');
    require_once ($_SERVER["DOCUMENT_ROOT"].'/../src/libs/PHPMailer/src/SMTP.php');
    require_once ($_SERVER["DOCUMENT_ROOT"].'/../src/libs/PHPMailer/src/Exception.php');
    $str = Array();
    $mails = $bdd->query('SELECT * from notifications');
    if ($_GET['subject'] == 'radio') {
        $text_to_add = "Je suis en Live sur Radio Metal Sound : https://chronique-metal.fr/fr/live-radio/, n'hésite pas à faire un tour pour nous écouter et nous passer le bonjour sur le discord officiel de la radio : https://discord.gg/rzx3MhP";
        $subject = "Live sur Radio Metal Sound !";
    }
    else if ($_GET['subject'] == 'chroniques') {
        $text_to_add = "Sache qu'une nouvelle chronique est disponible, tu pourras la lire ici : https://chronique-metal.fr/fr/read/?id=".$_GET['id']."&type=".$_GET['subject'];
        $subject = "Nouvelle chronique disponible !";
    }
    else if ($_GET['subject'] == 'concerts') {
        $text_to_add = "Sache qu'un nouveau rapport de concert est disponible, tu pourras le lire ici : https://chronique-metal.fr/fr/read/?id=".$_GET['id']."&type=".$_GET['subject'];
        $subject = "Nouveau rapport de concert disponible !";
    }
    else if ($_GET['subject'] == 'interviews') {
        $text_to_add = "Sache qu'une nouvelle interview est disponible, tu pourras la lire ici : https://chronique-metal.fr/fr/read/?id=".$_GET['id']."&type=".$_GET['subject'];
        $subject = "Nouvelle interview disponible !";
    }
    else {echo "error : aucun type de mail défini "; exit; }

    while ($email = $mails->fetch()) {
        $mail = new PHPMailer;
        //Set who the message is to be sent from
        $mail->setFrom('newsletter@chronique-metal.fr', 'Chronique Metal Newsletter');
        //Set who the message is to be sent to
        $mail->addAddress($email['email'], $email['first_name']." ".$email['name']);
        //Set the subject line
        $mail->Subject = $subject;
        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $mail->msgHTML("<html><head><meta charset='utf-8'></head><body>Bonjour à toi !<br /> Merci d'avoir demandé à recevoir des notifications de nos activités !<br /><br />".$text_to_add."</body></html>");
        //Replace the plain text body with one created manually
        $mail->AltBody = "Bonjour à toi !\n Merci d'avoir demandé à recevoir des notifications de nos activités !\n\n".$text_to_add;
        //Attach an image file
        if (!$mail->send()) {
            array_push($str, "<p>Erreur Mail : " . $mail->ErrorInfo."</p>");
        } else {
            array_push($str, "<p>Message envoyé à : ".$email['email']."</p>");
        }
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mail - Chronique Metal</title>
    <style>
        .title {
            font-family: Haettenschweiler, 'Arial Narrow Bold', sans-serif;
            text-align: center;
        }
        #main {
            background-color: whitesmoke;
            box-shadow: 0px 0px 40px 7px black;
            width: -moz-fit-content;
            width: fit-content;
            width: -webkit-fit-content;
            height: -moz-fit-content;
            height: fit-content;
            height: -webkit-fit-content;
            margin: auto;
            padding: 20px;
            padding-left: 10px;
            padding-right: 10px;
            font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
            text-align: center;
        }
        a {
            padding: 5px;
            border: grey solid 4px;
            border-radius: 4px;
            text-decoration: none;
            color: black;
            transition: all 400ms;
            display: block;
            width: -moz-fit-content;
            width: fit-content;
            width: -webkit-fit-content;
            margin: auto;
            margin-bottom: 13px;
        }
        a:hover {
            border-color: rgb(46, 46, 46);
        }
    </style>
</head>
<body>
    <h1 class="title">Envoyer une notification : </h1>
    <main id="main">
        <div id="infos">
            <?php foreach ($str as $el) {
                echo $el;
            }?>
        </div>
        <a href="../">Revenir à la page d'administration</a>
        <a href="https://chronique-metal.fr/">Revenir au site de Chronique Metal</a>
    </main>
</body>
</html>