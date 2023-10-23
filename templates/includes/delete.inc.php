<?php 
require './configs/global.php'; 
require './src/dbConnect.php';


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $sql = "SELECT * FROM annuaire_nws WHERE id = :id";
    $statement = $connection->prepare($sql);
    $statement->bindParam(':id', $id, PDO::PARAM_INT);
    $statement->execute();
    $record = $statement->fetch(PDO::FETCH_ASSOC);

    
    if (!$record) {
        echo "Enregistrement non trouvé.";
        exit;
    }
} else {
    echo "ID manquant.";
    exit;
}
$statement = $connection->prepare("DELETE FROM `annuaire_nws` WHERE id = ?");
$statement->bindParam(1, $id);
$statement->execute();
header('Location: ./?page=listUsers');

