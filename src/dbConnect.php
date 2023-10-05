<?php

$connection = new PDO('mysql:host=' . $globalConfigs["database"]["host"] . ';port=' . $globalConfigs['database']["port"] . ';dbname=' . $globalConfigs['database']["db_name"] . '', $globalConfigs['database']['user'], $globalConfigs['database']['password']);
        
$statement = $connection->prepare("INSERT INTO `contact` (`name`, `surname`, `status`)  VALUES ('Favario', 'Nathaniel', 'online') ");
// $stmt->bindParam(1,$id);
$statement->execute();
    // 