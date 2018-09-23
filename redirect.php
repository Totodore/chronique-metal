<?php
// $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
// switch ($lang){
//     case "fr":
//         //echo "PAGE FR";
//         header("Location:./fr/");//include check session FR
//         break;
//     case "en":
//         //echo "PAGE EN";
//         header("Location:./en/");
//         break;        
//     default:
//         //echo "PAGE EN - Setting Default";
//         header("Location:./en/");//include EN in all other cases of different lang detection
//         break;
// }
header("Location:./fr/");
?>