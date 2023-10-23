<?php
require './src/dbConnect.php';
require './configs/global.php';
?>
<form action="#" method="post">
  <ul>
    <li>
      <label for="name">Nom&nbsp;:</label>
      <input type="text" id="name" name="name" />
    </li>
    <li>
      <label for="surname">prenom&nbsp;:</label>
      <input type="text" id="surname" name="surname" />
    </li>
    <li>
      <label for="email">email&nbsp;:</label>
      <input type="text" id="email" name="email" />
    </li>
    <li>
      <label for="tel">tel&nbsp;:</label>
      <input type="text" id="tel" name="tel" />
    </li>
  </ul>
   <input type="submit">
</form>

<?php 
if(isset($_POST['name']) && isset($_POST['surname']) && isset($_POST['email']) && isset($_POST['tel'])){
  $connection->query(queryBuilder('c', 'annuaire_nws', ['name' => $_POST['name']],['surname' => $_POST['surname']],['email' => $_POST['email']],['tel' => $_POST['tel']]));
}
