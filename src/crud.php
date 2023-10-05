<?php
require_once "./src/dbConnect.php";


//fonction getById
$statement = $connection->query("SELECT * FROM contact WHERE `name` = 'Favario' AND `surname` = '".htmlspecialchars($_GET['surname']). " '");
$data = $statement->fetchAll(PDO::FETCH_ASSOC);
//fonction create
$statement = $connection->prepare("INSERT INTO `contact` (`name`, `surname`, `status`)  VALUES ('Favario', 'Nathaniel', 'online') ");
$statement->bindParam(1,$_GET['surname']);
$statement->bindParam(2,$_GET['name']);
$statement->execute();

//fonction getAll
$statement = $connection->query("SELECT * FROM contact WHERE 1");
$data = $statement->fetchAll(PDO::FETCH_ASSOC);

//fonction delete
$statement = $connection->prepare("DELETE FROM `contact` WHERE id = ?");
$id = 3;
$statement->bindParam(1, $id);
$statement->execute();

//fonction update
$statement = $connection->prepare("UPDATE `contact` SET `status` = 'offline' WHERE id = ?");
$id = 2;
$statement->bindParam(1, $id);
$statement->execute();

function delete($connection, $table,$id)
{
    $statement = $connection->prepare("DELETE FROM `".$table."` WHERE id = ? ");
    $statement->bindParam(1, $id);
    $statement->execute();
}

delete($connection,"contact", 3);

function update($connection, $table, $status, $id)
{
    $statement = $connection->prepare("UPDATE `".$table."` SET `".$status."` = 'offline' WHERE id = ?");
    $statement->bindParam(1, $id);
    $statement->execute();
}
update($connection, "contact", "status", 4);

