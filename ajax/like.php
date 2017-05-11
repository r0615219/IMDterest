<?php
header('Content-Type: application/json');
session_start();
include_once("../classes/Db.php");


  $userid=$_SESSION['userid'];
  $postid=$_POST['id'];
  $action=$_POST['action'];
  $liked;
if (($_POST['action']=='toggle')) {
    //HARTJE UPDATEN
  $conn = Db::getInstance();
    $likecheckstatement = $conn->prepare("SELECT * FROM `likes` WHERE UserId = :userid AND PostId = :postid");
    $likecheckstatement->bindValue(":userid", $userid);
    $likecheckstatement->bindValue(":postid", $postid);
    $likecheckstatement->execute();
    $likes = $likecheckstatement->fetch(PDO::FETCH_OBJ);

    if (empty($likes)) {
        $addlike = $conn->prepare("INSERT INTO `likes`(`UserId`, `PostId`) VALUES(:userid,:postid)");
        $addlike->bindValue(":userid", $userid);
        $addlike->bindValue(":postid", $postid);
        $addlike->execute();
        $liked = 1;
    };

    if (!empty($likes)) {
        $removelikes = $conn->prepare("DELETE FROM `likes` WHERE UserId = :userid AND PostId = :postid");
        $removelikes->bindValue(":userid", $userid);
        $removelikes->bindValue(":postid", $postid);
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
