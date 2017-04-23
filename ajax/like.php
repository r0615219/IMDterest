<?php
session_start();
include_once("../classes/Db.php");


  $userid=$_SESSION['userid'];
  $postid=$_POST['id'];
  $action=$_POST['action'];
  $liked;
if (($_POST['action']=='toggle')){
//HARTJE UPDATEN
  $conn = Db::getInstance();
  $likecheckstatement = $conn->prepare("SELECT * FROM `likes` WHERE UserId = :userid AND PostId = :postid");
  $likecheckstatement->bindValue(":userid", (int)$userid);
  $likecheckstatement->bindValue(":postid", (int)$postid);
  $likecheckstatement->execute();
  $likes = $likecheckstatement->fetch(PDO::FETCH_OBJ);

  if (empty($likes)) {
    $addlike = $conn->prepare("INSERT INTO `likes`(`UserId`, `PostId`) VALUES(:userid,:postid)");
    $addlike->bindValue(":userid", (int)$userid);
    $addlike->bindValue(":postid", (int)$postid);
    $addlike->execute();
    $liked = 1;
  };

  if (!empty($likes)) {
    $removelikes = $conn->prepare("DELETE FROM `likes` WHERE UserId = :userid AND PostId = :postid");
    $removelikes->bindValue(":userid", (int)$userid);
    $removelikes->bindValue(":postid", (int)$postid);
    $removelikes->execute();
    $liked = 0;
  };
  echo $liked;
}

//TELLER UPDATEN
if ($_POST['action']=='count') {
    $conn = Db::getInstance();
    $likecheckstatement = $conn->prepare("SELECT * FROM `likes` WHERE PostId = :postid");
    $likecheckstatement->bindValue(":postid", $postid);
    $likecheckstatement->execute();
    $rows = $likecheckstatement->rowCount();
    echo $rows;
}


?>
