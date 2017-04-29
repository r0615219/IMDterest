<?php
    header ('Content-Type: application/json');
    session_start();
    include_once('../classes/Db.php');
	include_once('../classes/User.php');

if(!empty($_POST) ){
    $user = new User();
    
    if ($user->Follow==FALSE) { //if follow == false, voeg follow record toe aan tabel follows
        $statement = $conn->prepare("INSERT INTO `follows`(`follower`, `user`) VALUES(:usersession,:postid)");
        $statement->bindValue(":usersession", $_SESSION['userid']);
        $statement->bindValue(":postid", $postid);
        $statement->execute();
        $user->Follow=TRUE;
    }
    
    if ($user->Follow==TRUE) {
        //if follow == true, verwijder follow record uit tabel follows
    }
    
    //echo json_encode($feedback);
}