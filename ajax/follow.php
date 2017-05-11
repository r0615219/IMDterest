<?php

header ('Content-Type: application/json');

session_start();

include_once('../classes/Db.php');

include_once('../classes/User.php');

try{

    if(!empty($_POST) ){

        $user = new User();

        $user->checkFollow($_POST['user_ID']);

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



        $user->countfollow($_POST['user_ID']);

    }

    $feedback = [

        "code" => 200,

        "message" => $user->Follow,

        "followers" => $user->Followers

    ];

} catch (Exception $e) {

    $error = $e->getMessage();

    $feedback = [

        "code" => 500,

        "message" => $error

    ];

}

echo json_encode($feedback);

