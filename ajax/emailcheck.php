<?php
header ('Content-Type: application/json');
session_start();
include_once('../classes/Db.php');
include_once('../classes/User.php');

  $conn = Db::getInstance();
  $statement = $conn->prepare("SELECT * FROM `users` WHERE (email = :email)");
  $statement->bindValue(":email",$_POST['email']);
  $res=$statement->execute();
  $rows = $statement->rowCount();
    if ($rows==1) {
      echo 1;}
    else {
      echo 0;
    }
    
 ?>
