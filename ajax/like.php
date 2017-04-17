<?php
session_start();
include_once("../classes/Db.php");
echo $_SESSION['userid'];
echo $_POST['id'];

$userid=$_SESSION['userid'];
$postid=$_POST['id'];

$conn = Db::getInstance();
$likecheckstatement = $conn->prepare("SELECT * FROM `likes` WHERE UserId = :userid AND PostId = :postid");
$likecheckstatement->bindValue(":userid", (int)$userid);
$likecheckstatement->bindValue(":postid", (int)$postid);
$likecheckstatement->execute();
$likes = $likecheckstatement->fetch(PDO::FETCH_OBJ);

var_dump($likes)
?>
