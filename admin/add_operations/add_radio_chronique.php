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
        }
        form {
            width: 100%;
            text-align: center;
        }
        form > input {
            border: gray 4px solid;
            transition: all 400ms;
            border-radius: 4px;
            padding: 4px;
            width: 250px;
            margin: 10px;
        }
        form > input:hover, form > input:focus {
            border-color: rgb(46, 46, 46);            
        }
        form > input[type='submit'] {
            cursor: pointer;
        }
        .status {
            text-align: center;
            width: 100%;
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
    <h1 class="title">Ajouter un article provenant de Radio Metal Sound :</h1>
    <main id="main">
        <form method="POST">
            <input type="url" required name="link" placeholder="Lien de l'article :" /><br />
            <input type="text" required name="title" placeholder="Titre :" /><br />
            <input type="submit" value="Valider"/><br />
        </form>    
        <div class="status">

        </div>
        <a href="../">Revenir à la page d'administration</a>
        <a href="https://chronique-metal.fr/">Revenir au site de Chronique Metal</a>
    </main>
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