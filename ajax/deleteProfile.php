<?php
header ('Content-Type: application/json');
include_once('../classes/Db.php');
include_once('../classes/User.php');

try{
    $user = new User();
    $user->deleteUser();

    $feedback = [
        "code" => 200,
        "message" => $user->deleteUser()
    ];

} catch (Exception $e) {
    $error = $e->getMessage();
    $feedback = [
            "code" => 500,
            "message" => $error
    ];
}

echo json_encode($feedback);