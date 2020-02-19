<?php 
    include '../system/init.php';

    $xml = file_get_contents('http://api.radionomy.com/tracklist.cfm?radiouid=4467f14f-308c-4040-8bec-d275a36373cb&apikey=f860e471-29bb-4721-9132-7428db1cbcf6&amount=5&type=xml&cover=yes'); 
    echo $xml;
?>