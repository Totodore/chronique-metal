<?php 
    include "../../src/html/system/init.php";
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin - Chronique Métal</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
    </style>
</head>
<body>
    <div class="form">
        <h1>Rajouter un article provenant de Radio Metal Sound</h1>
        <form method="POST">
            <br />
            <input type="url" name="link" placeholder="Lien de l'article" />
            <br />
            <br />
            <input type="text" name="title" placeholder="Titre" /><br /><br />
            <input type="submit" value="Uploader"/><br /><br />
            <br /><br />
        <a href="../">Page d'administration.</a><br />
        <a href="/">Page d'acceuil</a><br /><br />
        </form>    
        <div class="infos">
            <div class="status">

            </div>
        </div>
    </div>
</body>
<script type="text/javascript">
    $(function() {
        $("form").submit(function(e) {
            e.preventDefault();
            console.log("Sending Form...");
            $.ajax({
                url: "add_radio_chronique_ajax.php",
                type: "POST",
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function() {
                    $(".status").html("Requete en cours");
                },
                error: function (request, error) {
                        console.log(arguments);
                        alert(" Can't do because: " + error);
                },
                success: function(data) {
                    $(".status").html(data);
                    $("form").each(function() { this.reset(); });
                }
            })
        })
    });
</script>
</html>