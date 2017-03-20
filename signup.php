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
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
    <title>IMDterest | Sign In</title>
</head>
<body>

<h1>Welcome to IMDterest!</h1>

<h2>Please sign up</h2>

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
            <input type="submit" value="Sign up">
        </div>
    </form>
</div>

<p>You have already an account? <a href="signin.php">Sign in.</a></p>

</body>
</html>