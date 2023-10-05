<?php
require_once "./src/dbConnect.php";

function queryBuilder($method, $table, ...$payload){
    $query ="";
    switch ($method) {
        case 'c':
            $query .= "INSERT INTO ";
            break;
        case 'r':
            $query .= "SELECT * FROM ";
            break;
        case 'u':
            $query .= "UPDATE ";
            break;
        case 'd':
            $query .= "DELETE ";
            break;
        default:
           
            die("ERROR : Prepared query method not defined");
            break;
    }

    $query .= '`'.  htmlspecialchars($table) . '` ';
    if($method ==='u'){
        $query .= "SET ";
}
    if($method ==="c"){
        $columnParse  = '(';
        $valueParse  = '(';
        foreach ($payload as $index => $column) {
            foreach ($column as $key => $value) {
                if(is_string($value)){
                    $value = "\"" . $value. "\"";
                }
                $columnParse .= "`" . $key . "`"; 
                 if(!(count($payload) == ($index + 1 ))){
                $columnParse .= ", ";
            }
            }

        }
        $columnParse.= ")";
             foreach ($payload as $index => $column) {
            foreach ($column as $key => $value) {
                if(is_string($value)){
                    $value = "\"" . $value. "\"";
                }
                $valueParse .= $value ; 
                 if(!(count($payload) == ($index + 1 ))){
                $valueParse .= ", ";
            }
            }

        }
        $valueParse.= ")";
        $query .= $columnParse . " VALUES " . $valueParse;
    }
    if($method ==='u'){
        foreach ($payload as $index => $filter) {
            foreach ($filter as $key => $value) {
                if($key !== "id"){
                    if(is_string($value)){
                        $value = "\"" . $value. "\"";
                    }
                    
                    $query .= "`" . $key . "` = ". $value .' ' ; 
                    
                    if(!(count($payload) == ($index + 2 ))){
                        $query .= ", ";
                    }
                }
            }

        }
    }
    if($method !=='c' && $method !== "u" && count($payload)){
        $query .= "WHERE ";
        foreach ($payload as $index => $filter) {
            foreach ($filter as $key => $value) {
                if(is_string($value)){
                    $value = "\"" . $value. "\"";
                }
                $query .= "`" . $key . "` = ". $value . " AND "; 
            }
            if(count($payload) == ($index + 1 ) && $method !=='r'){
                $query .= "1";
            } else if(count($payload) == ($index + 1 )) {
                $query .= '`status` = "online"';
            }
        }
    } else if($method === "u"){
        $idFound = false;
        foreach ($payload as $index => $filter) {
            foreach ($filter as $key => $value) {
                if($key === "id"){
                    $idFound = true;
                
                    $query .= "WHERE ";
                    $query .= "`" . $key . "` = ". $value;
                } 
            }
        }
        if(!$idFound){
            die("ERROR : Not id to update");
        }
    }
    
   return $query;

} 

// //fonction getById
// $statement = $connection->query("SELECT * FROM contacts WHERE `name` = 'Favario' AND `surname` = '".htmlspecialchars($_GET['surname']). " '");
// $data = $statement->fetchAll(PDO::FETCH_ASSOC);


// //fonction create
// $statement = $connection->prepare("INSERT INTO `contacts` (`name`, `surname`, `status`)  VALUES ('Favario', 'Nathaniel', 'online') ");
// $statement->bindParam(1,$_GET['surname']);
// $statement->bindParam(2,$_GET['name']);
// $statement->execute();

// //fonction getAll
// $statement = $connection->query("SELECT * FROM contacts WHERE 1");
// $data = $statement->fetchAll(PDO::FETCH_ASSOC);

// //fonction delete
// $statement = $connection->prepare("DELETE FROM `contacts` WHERE id = ?");
// $id = 3;
// $statement->bindParam(1, $id);
// $statement->execute();

// //fonction update
// $statement = $connection->prepare("UPDATE `contacts` SET `status` = 'offline' WHERE id = ?");
// $id = 2;
// $statement->bindParam(1, $id);
// $statement->execute();

// function delete($connection, $table,$id)
// {
//     $statement = $connection->prepare("DELETE FROM `".$table."` WHERE id = ? ");
//     $statement->bindParam(1, $id);
//     $statement->execute();
// }

// delete($connection,"contacts", 3);

// function update($connection, $table, $status, $id)
// {
//     $statement = $connection->prepare("UPDATE `".$table."` SET `".$status."` = 'offline' WHERE id = ?");
//     $statement->bindParam(1, $id);
//     $statement->execute();
// }
// update($connection, "contacts", "status", 4);


    



