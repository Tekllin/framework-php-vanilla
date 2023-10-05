<?php
require 'vendor/autoload.php';
use Tekllin\Controller\Database;



$db = new Database();
echo $db->table("Toto")->update(['filters' => ["name" => "Favario", "surname" => "Nathaniel" ], "post" => ["mail" => "nathaniel.favario@gmail.com", "id" => "1"] ])->getQuery();


// echo sprintf("Salut les %s, comment ça roule ?", "Zouzou");









// require_once './configs/bootstrap.php';
// ob_start();
// if(isset($_GET["page"])){
//     fromInc($_GET['page']);
// }

// if(isset($_GET["page"])){
//     fromInc($_GET['page']);
// }

// $pageContent = [
//     "html" => ob_get_clean(),

// ];

// include "./templates/layouts/". $_GET["layout"] .".layout.php";

?>