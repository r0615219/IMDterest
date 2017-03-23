<?php

include_once 'classes/User.php';
//autoloading?

if(!empty($_POST)){
    $user = new User();
    $user->Email = $_POST['email'];
    $user->Fullname = $_POST['fullname'];
    $user->Username = $_POST['username'];
    $user->Password = $_POST['password'];


    if( $user->Register()){
        session_start();
        $_SESSION['user']=$user->Username;
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
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/signup-style.css">

    <link href="https://fonts.googleapis.com/css?family=Nova+Oval" rel="stylesheet">

    <title>IMDterest | Sign Up</title>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">IMDterest</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <!--<form class="navbar-form navbar-right" method="post">
                <div class="form-group">
                    <input type="text" placeholder="Username" name="username" id="username" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
            </form>-->
            <form class="navbar-form navbar-right">
                <p class="white">Already have an account? &nbsp; <a class="btn btn-success" href="signin.php">Sign in!</a> </p>

            </form>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<div class="jumbotron">
    <div class="container">
        <h1>A creative way to share ideas!</h1>
        <p>Join our community!</p>
        <!--<div class="signup">
            <form action="" method="POST">
                <div class="flex">
                    <div>
                        <input type="email" name="email" id="email" placeholder="E-mail">
                    </div>
                    <div>
                        <input type="text" name="fullname" id="fullname" placeholder="Full Name">
                    </div>
                </div>
                <div class="flex">
                    <div>
                        <input type="text" name="username" id="username" placeholder="Username">
                    </div>
                    <div>
                        <input type="password" name="password" id="password" placeholder="Password">
                    </div>
                </div>
                <div>
                    <input type="submit" value="Sign up">
                </div>
            </form>
            <p>You have already an account? <a href="signin.php">Sign in.</a></p>
        </div>-->

        <form action="post">
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                <input type="text" class="form-control" placeholder="Full Name" name="fullname" id="fullname" aria-describedby="basic-addon1">
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
                <input type="email" class="form-control" placeholder="E-mail" name="email" id="email" aria-describedby="basic-addon1">
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span></span>
                <input type="text" class="form-control" placeholder="Username" name="username" id="username" aria-describedby="basic-addon1">
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-align-left" aria-hidden="true"></span></span>
                <input type="password" class="form-control" placeholder="Password" name="password" id="password" aria-describedby="basic-addon1">
            </div>
            <br>
            <button type="submit" class="btn btn-primary btn-lg" role="button">Sign up</button>
        </form>

    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/npm.js"></script>

</body>
</html>