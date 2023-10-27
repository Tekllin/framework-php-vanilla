<?php
require './src/dbConnect.php';
require './configs/global.php';


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


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];

    
    $sql = "UPDATE annuaire_nws SET name = :name, surname = :surname, email = :email, tel = :tel WHERE id = :id";
    $updateStatement = $connection->prepare($sql);
    $updateStatement->bindParam(':name', $name);
    $updateStatement->bindParam(':surname', $surname);
    $updateStatement->bindParam(':email', $email);
    $updateStatement->bindParam(':tel', $tel);
    $updateStatement->bindParam(':id', $id, PDO::PARAM_INT);

    if ($updateStatement->execute()) {
        echo "Mise à jour réussie.";
    } else {
        echo "Erreur lors de la mise à jour.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mise à jour de l'enregistrement</title>
    <link rel="stylesheet" href="./styles/global.css">
</head>
<body>
    <form action="#" method="post">
        <input type="hidden" name="id" value="<?= $id ?>">
        <ul>
            <li>
                <label for="name">Nom&nbsp;:</label>
                <input type="text" id="name" name="name" value="<?= $record['name'] ?>" />
            </li>
            <li>
                <label for="surname">Prénom&nbsp;:</label>
                <input type="text" id="surname" name="surname" value="<?= $record['surname'] ?>" />
            </li>
            <li>
                <label for="email">Email&nbsp;:</label>
                <input type="text" id="email" name="email" value="<?= $record['email'] ?>" />
            </li>
            <li>
                <label for="tel">Téléphone&nbsp;:</label>
                <input type="text" id="tel" name="tel" value="<?= $record['tel'] ?>" />
            </li>
        </ul>
        <input type="submit" value="Mettre à jour">
    </form>
</body>
</html>

