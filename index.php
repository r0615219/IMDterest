<?php

    include_once 'classes/User.php';

    if(!empty($_POST)){
        $user = new User();
        $user->Email = $_POST['email'];
        $user->Fullname = $_POST['fullname'];
        $user->Username = $_POST['username'];

        $options = [
            'cost' => 12,
        ];
        $user->Password = password_hash( $_POST['password'], PASSWORD_DEFAULT, $options );

        if( $user->Save() ){
            session_start();
            header('Location: home.php');
        } else {
            echo 'Whoops, something went wrong.';
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>IMDterest Register</title>
</head>
<body>

<div class="signup">
    <form action="" method="POST"">
        <div>
            <label for="email">E-mail</label> <br>
            <input type="email" name="email" id="email">
        </div>
        <div>
            <label for="fullname">Full Name</label> <br>
            <input type="text" name="fullname" id="fullname">
        </div>
        <div>
            <label for="username">Username</label> <br>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="password">Password</label> <br>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <input type="submit" value="Sign Up">
        </div>
    </form>
</div>

<div class="signin"></div>

</body>
</html>