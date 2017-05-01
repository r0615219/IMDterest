<?php
    header ('Content-Type: application/json');
    session_start();
    include_once('../classes/Db.php');
	include_once('../classes/User.php');

if(!empty($_POST) ){
    $user = new User();
    
    if ($user->Follow==FALSE) { //if follow == false, voeg follow record toe aan tabel follows
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO `follows`(`follower`, `user`) VALUES(:usersession,:user_ID)");
        $statement->bindValue(":usersession", $_SESSION['userid']);
        $statement->bindValue(":user_ID", $_POST['user_ID']);
        $statement->execute();
        $user->Follow=TRUE;
    }
    
    if ($user->Follow==TRUE) {
        //if follow == true, verwijder follow record uit tabel follows
    }
    
    //echo json_encode($feedback);
}