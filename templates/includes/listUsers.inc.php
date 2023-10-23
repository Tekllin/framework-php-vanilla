<?php
require './src/dbConnect.php';
require './configs/global.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./styles/global.css">
</head>
<body>
    <label for="search">Rechercher</label>
    <input type="text" name="search" id="search">

    <ul class="liste_annuaire">
        <li class="li_annuaire">
            <h4 class="element_tableau"><p>Nom</p></h4>
            <h4 class="element_tableau"><p>Prenom</p></h4>
            <h4 class="element_tableau"><p>Email</p></h4>
            <h4 class="element_tableau"><p>Tel</p></h4>
            <h4 class="element_tableau"><p>Modifier</p></h4>
            <h4 class="element_tableau"><p>Supprimer</p></h4>
        </li>
        <?php 
        require_once './src/crud.php';
        $data = $connection->query(queryBuilder('r', 'annuaire_nws'));
        foreach ( $data as $key => $value) {
        ?>
        <li class="li_annuaire">
            <h4 class="element_tableau"><p><?= $value["surname"]?></p></h4>
            <h4 class="element_tableau"><p><?= $value["name"]?></p></h4>
            <h4 class="element_tableau"><p><?= $value["email"]?></p></h4>
            <h4 class="element_tableau"><p><?= $value["tel"]?></p></h4>
            <h4 class="element_tableau"><a href="./?page=update&id=<?= $value["id"]?>" >modifier</a></h4>
            <h4 class="element_tableau"><a href="./?page=delete&id=<?= $value["id"]?>" >supprimer</a></h4>
        </li>
        <?php
        }
        ?>
    </ul>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const searchInput = document.getElementById("search");
            const listItems = document.querySelectorAll(".li_annuaire");
            const firstRow = document.querySelector(".li_annuaire");

            function performSearch() {
                const searchTerm = searchInput.value.toLowerCase();

                listItems.forEach(function (item) {
                    if (item === firstRow) {
                        return; 
                    }

                    const text = item.innerText.toLowerCase();

                    if (text.includes(searchTerm)) {
                        item.style.display = "flex";
                    } else {
                        item.style.display = "none";
                    }
                });
            }

            searchInput.addEventListener("input", performSearch);
        });
    </script>
</body>
</html>
