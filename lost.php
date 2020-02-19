<?php 
    include './src/html/system/init.php';
?>
<!DOCTYPE html>
<html>
<head>
    <?php include './src/html/system/init.html' ?>
    <title>Perdu !</title>
    <style>
        #article {
            background-color: rgba(43, 43, 43, 0.8);
            width: 100%;
            font-family: "Open Sans", sans-serif;
            font-weight: 400;
            line-height: 1.5;
            font-size: 1.15em;
            color: whitesmoke;
            border-radius: 5px;
            box-shadow: 13px 13px 15px 1px rgba(0,0,0,0.75);
            text-align: left;
            margin-top: 30px;
        }
        .msg {
            font-family: font_metal;
            font-size: 1.5em;
            color: grey;
            width: 90%;
            margin: auto;
            padding-top: 150px;
        }
        .error {
            font-family: font_metal;
            font-size: 1.5em;
            color: red;
            width: 90%;
            margin: auto;
            padding-bottom: 150px;
        }
    </style>
</head>
<body>
    <div id="wrapper">
    <?php include './src/html/system/header.php' ?>
        <div id="article">
            <p class="msg">
                Ben alors gamin ? On a perdu sa maman ?<br />
            </p>
            <p class="error">
                Error <span style="font-family:lato_heavy">404</span> not found
            </p>
        </div>
    <?php include './src/html/system/footer.php' ?>
    </div>
</body>
</html>