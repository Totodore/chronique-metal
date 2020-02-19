<?php 
    session_start();
    $_SESSION['session'] = true;
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Load</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="/src/css/load_ajax.css" />
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="/src/js/load_ajax.js"></script>
    <script>
        var path = "<?php echo $_GET['url'];?>"
    </script>
</head>
<body>
    <main id="main">
        <h1>Chargement de Chronique-metal.fr <span>.</span><span>.</span><span>.</span></h1>
        <span class="round">
            <img src="/src/images/load_icon.png" />
        </span>
        <progress max="100" min="0"></progress>
        <span class="text">0%</span>
    </main>
</body>
</html>