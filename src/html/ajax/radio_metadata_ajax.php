<?php 
    include '../system/init.php';
    $currentPage = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

    if ($_SERVER['REQUEST_METHOD'] == "GET" && strcmp(basename($currentPage), basename(__FILE__)) == 0)
    {
        http_response_code(404);
        header("Location: /");
        die(); /* remove this if you want to execute the rest of
                the code inside the file before redirecting. */
    }
    $xml = file_get_contents('http://api.radionomy.com/tracklist.cfm?radiouid=4467f14f-308c-4040-8bec-d275a36373cb&apikey=f860e471-29bb-4721-9132-7428db1cbcf6&amount=5&type=xml&cover=yes'); 
    echo $xml;
?>