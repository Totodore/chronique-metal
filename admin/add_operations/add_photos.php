<?php include '../src/html/system/init.php'; 
    ini_set('upload_max_filesize', '10000M');
    ini_set('post_max_size', '10000M');
    ini_set('max_input_time', -1);
    ini_set('max_execution_time', -1);
?>
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
            <h1>Uploader un album photos</h1>
            <form method="POST" enctype="multipart/form-data">
                <input type="text" required="true" name="titre" placeholder="Titre"/><br /><br />
                <input type="text" required name="auteur" placeholder="Auteur"/><br /><br />
                <label>Cela doit etre un fichier .zip obligatoirement.</label><br />
                <input type="file" name="image" class="photos" /><br /><br />
                <label>Date du concert</label>
                <input type="date" name="date" /><br /><br />
                <input type="submit" value="Uploader" />
            </form>
        </div>
        <div style="float: right; font-size: 1.2em; margin-left:50px">
            <a href="/">Revenir a la page d'accueil</a><br />
            <a href="../">Revenir a la page d'administration</a><br />
            <br />
            <br />
            <br />
            <label>Progression de l'upload :</label><br />
            <progress max="100" id="progressBar" style="display:none;"></progress>
            <p class="status"></p>
        </div>
    </body>
    <script type="text/javascript">
        $(function() {
            $("form").submit(function(e) {
                e.preventDefault();
                console.log("Sending Form...");
                $.ajax({
                    url: "add_photos_ajax.php",
                    type: "POST",
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData: false,
                    xhr: function(){
                        // get the native XmlHttpRequest object
                        var xhr = $.ajaxSettings.xhr() ;
                        // set the onprogress event handler
                        xhr.upload.onprogress = function(evt) { 
                            $("progress").show();
                            console.log('progress', evt.loaded/evt.total*100) 
                            $("progress").val(evt.loaded/evt.total*100);
                            if (evt.loaded/evt.total*100 == 100)
                                $(".status").html("Decompresion des donnees...");
                        };
                        // return the customized object
                        xhr.onreadystatechange = function(event) {
                            if (this.readyState === XMLHttpRequest.DONE) {
                                if (this.status === 200) {
                                    console.log("Réponse reçue: %s", this.responseText);
                                    $(".status").html(this.responseText);
                                } else {
                                    console.log("Status de la réponse: %d (%s)", this.status, this.statusText);
                                    $(".status").html("Erreur lors de la requete au serveur : " + this.status + this,statusText);
                                }
                            }
                            $("progress").hide();
                            $("form").get(0).reset();
                        }
                        return xhr ;
                    }
                })
            })
        })
    </script>
</html>

