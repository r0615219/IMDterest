<?php
    header ('Content-Type: application/json');
    session_start();
    include_once('../classes/Db.php');
	include_once('../classes/User.php');

if(!empty($_POST) ){
    $user = new User();
    
    $user->getUserDetails($_POST['user_ID']);
    
    if ($user->Follow==FALSE) { //if follow == false, voeg follow record toe aan tabel follows
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO `follows`(`follower`, `user`) VALUES(:usersession,:user_ID)");
        $statement->bindValue(":usersession", $_SESSION['userid']);
        $statement->bindValue(":user_ID", $_POST['user_ID']);
        $statement->execute();
    }
    
    if ($user->Follow==TRUE) {
        //if follow == true, verwijder follow record uit tabel follows
        $conn = Db::getInstance();
        $statement = $conn->prepare("DELETE FROM `follows` WHERE follower = :usersession AND user = :user_ID");
        $statement->bindValue(":usersession", $_SESSION['userid']);
        $statement->bindValue(":user_ID", $_POST['user_ID']);
        $statement->execute();
    }
    
    //echo json_encode($feedback);
}