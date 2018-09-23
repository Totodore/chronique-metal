<?php include '../../src/html/system/init.php'; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <title>Admin - Chronique Metal</title>
    </head>
    <body style="display: flex;">
        <div>
            <h1>Ajouter une playlist dans l'onglet Videos</h1>
            <form method="POST" enctype="multipart/form-data">
                <label>Vous pouvez entrer le lien d'une image ou en upload une</label><br /><br />
                <input type="text" name="image_link" class="image_link" placeholder="Lien de l'image" /><br />
                <input type="file" name="image" class="image_file" /><br /><br />
                <input type="text" required name="link" placeholder="Lien du site" /><br /><br />
                <input type="submit" value="Uploader"/><br /><br />
            </form>
        </div>
        <div style="float: right; font-size: 1.2em">
            <a href="/">Revenir a la page d'accueil</a><br />
            <a href="../">Revenir a la page d'administration</a><br />
            <br />
            <br />
            <br />
            <p class="status"></p>
        </div> 
    </body>
    <script type="text/javascript">
        $(function() {
            $(".image_link").keyup(function() { 
                if (this.value.length != 0)
                    $('.image_file').get(0).disabled = true;    //Si le lien est vide on autorise le fichier
                else
                    $('.image_file').get(0).disabled = false;   //si ya des chars on interdit
            })
            $(".image_file").change(function() {
                if (this.files.length != 0 || this.value != "") //si on post une image
                { 
                    $(".image_link").get(0).disabled = true;    //on desactive le lien
                    $(".image_del").show(250);  //on affiche le bouton  supprimer
                }
                else 
                {
                    $(".image_del").hide(250);  //sinon on le cache
                    $(".image_link").get(0).disabled = false;   //et on reactive le lien
                }
            })
            $(".image_del").click(function() {
                $(".image_file").get(0).value = ""; //on degage l'image 
                $(".image_file").triggerHandler("change");  //on active l'event au dessus
            })
            
            $("form").submit(function(e) {
                e.preventDefault();
                console.log("Sending Form...");
                $.ajax({
                    url: "add_sponsort_ajax.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: function() {
                        $(".status").html("Fichiers en cours d'envoi");
                    },
                    error: function (request, error) {
                        console.log(arguments);
                        alert(" Can't do because: " + error);
                    },
                    success: function(data) {
                        console.log("data");
                        $(".status").html(data);
                        $('.image_file').get(0).disabled = false;
                        $(".image_link").get(0).disabled = false;
                        $("form").get(0).reset();
                    }
                });
            });
        });
    </script>
</html>