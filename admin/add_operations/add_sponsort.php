<?php include '../../src/html/system/init.php'; ?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
        <title>Admin - Chronique Metal</title>
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
            input {
                border: gray 4px solid;
                transition: all 400ms;
                border-radius: 4px;
                padding: 4px;
                width: 70%;
                margin: 10px;
            }
            input[type='file'] {
                width: 350px;
            }
            input:hover, input:focus {
                border-color: rgb(46, 46, 46);            
            }
            input[type='file'], input[type='submit'] {
                cursor: pointer;
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
            #infos {
                margin-top: 10px;
                width: 100%;
                text-align: center;
            }
            progress {
                margin-top: 10px;
                -moz-appearance: none;
                -webkit-appearance: none;
                width: 50%;
                border-radius: 4px;
                box-shadow: black 0px 0px 4px 1px inset;
                background: white;
                height: 25px;
            }
            progress::-webkit-progress-bar {
                border-radius: 4px;
                box-shadow: black 0px 0px 4px 1px inset;
                background: white;
                height: 25px;
            }
            progress::-webkit-progress-value {
                background-image:
                -webkit-linear-gradient(-45deg, 
                                        transparent 33%, rgba(0, 0, 0, .1) 33%, 
                                        rgba(0,0, 0, .1) 66%, transparent 66%),
                -webkit-linear-gradient(top, 
                                        rgba(255, 255, 255, .25), 
                                        rgba(0, 0, 0, .25)),
                -webkit-linear-gradient(left, #09c, #f44);
        
            border-radius: 4px; 
            background-size: 35px 25px, 100% 100%, 100% 100%;
            }
            progress::-moz-progress-bar {
                background-image:
                    -moz-linear-gradient(
                    135deg, 
                    transparent 33%, 
                    rgba(0, 0, 0, 0.1) 33%, 
                    rgba(0, 0, 0, 0.1) 66%, 
                    transparent 66% 
                    ),
                    -moz-linear-gradient(
                    top, 
                    rgba(255, 255, 255, 0.25), 
                    rgba(0, 0, 0, 0.25)
                    ),
                    -moz-linear-gradient(
                    left, 
                    #09c, 
                    #f44
                    );
                border-radius: 4px; 
                background-size: 35px 25px, 100% 100%, 100% 100%; 
            }
    </style>
    </head>
    <body>
        <h1 class="title">Ajouter un sponsors :</h1>            
        <main id="main">
            <div>
                <form method="POST" enctype="multipart/form-data">
                    <label>Image du sponsors :</label><br />
                    <input type="file" required name="image" accept="image/png, image/jpeg" class="image_file" /><br />
                    <input type="text" required name="link" placeholder="Lien du site :" /><br />
                    <input type="submit" value="Uploader"/><br /><br />
                </form>
            </div>
            <div id="infos">
                <label>Progression de l'upload :</label><br />
                <progress max="100" value="0" id="progressBar"></progress>
                <p class="status"></p>
                <a href="../">Revenir à la page d'administration</a>
                <a href="https://chronique-metal.fr/">Revenir au site de Chronique Metal</a>
            </div>
        </main>
    </body>
    <script type="text/javascript">
         $(function() {
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
                    xhr: function(){
                        // get the native XmlHttpRequest object
                        var xhr = $.ajaxSettings.xhr() ;
                        // set the onprogress event handler
                        xhr.upload.onprogress = function(evt) { 
                            $("progress").show();
                            console.log('progress', evt.loaded/evt.total*100) 
                            $("progress").val(evt.loaded/evt.total*100);
                            if (evt.loaded/evt.total*100 == 100)
                                $(".status").html("Décompresion des données...");
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