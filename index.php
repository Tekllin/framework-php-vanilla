<?php

require_once './configs/bootstrap.php';
ob_start();
if(isset($_GET["page"])){
    fromInc($_GET['page']);
}
$contacts = $connection->query(queryBuilder('r', 'contacts'));
$pageContent = [
    "html" => ob_get_clean(),
    "data" => [
        'contacts' => $contacts
    ]
];
if(isset($_GET["layout"])){

    include "./templates/layouts/". $_GET["layout"] .".layout.php";
}else{
    include "./templates/layouts/html.layout.php";

}

?>