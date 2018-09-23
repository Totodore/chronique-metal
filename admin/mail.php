<?php 
    include '../src/html/system/init.php';
    use PHPMailer\PHPMailer\PHPMailer;

    require_once ($_SERVER["DOCUMENT_ROOT"].'/src/libs/PHPMailer/src/PHPMailer.php');
    require_once ($_SERVER["DOCUMENT_ROOT"].'/src/libs/PHPMailer/src/POP3.php');
    require_once ($_SERVER["DOCUMENT_ROOT"].'/src/libs/PHPMailer/src/OAuth.php');
    require_once ($_SERVER["DOCUMENT_ROOT"].'/src/libs/PHPMailer/src/SMTP.php');
    require_once ($_SERVER["DOCUMENT_ROOT"].'/src/libs/PHPMailer/src/Exception.php');

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
            echo "Mailer Error: " . $mail->ErrorInfo;
        } else {
            echo "Message sent to ".$email['email']."<br />";
        }
    }
    echo "<br />Notifications envoyées avec succès !!";
?>