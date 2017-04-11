<?php

session_start();
spl_autoload_register(function($class){
        include_once("classes/" . $class . ".php");
    });

$required = array('email', 'fullname', 'username', 'password');
try{
if(!empty($_POST)){
    $user = new User();
    $user->Email = $_POST['email'];
    $user->Firstname = $_POST['firstname'];
    $user->Lastname = $_POST['lastname'];
    $user->Username = $_POST['username'];
    $user->Password = $_POST['password'];
    $user->Image = "http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png";

      if( $user->Register()){
          $user->HandleLogin();
      }
  }

}catch (Exception $e) {
  $error = $e->getMessage();
  foreach($required as $field) {
  if (empty($_POST[$field])) {
    echo '<style type="text/css">
          #'.$field.'{border:4px solid red;
          background-color: #FFA3A3;}
          </style>';
      $missingfields = 1;}}
  if (strlen($_POST['password'])<6) {
    echo '<style type="text/css">
          #password{border:4px solid red;
          background-color: #FFA3A3;}
          </style>';
      $shortpassword = 1;}
  if ($error=="email already registered") {
    echo '<style type="text/css">
          #email{border:4px solid red;
          background-color: #FFA3A3;}
          </style>';
    $duplicatemail = 1;
  }
};?>

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

        <form method="post">
        <?php
          if (isset($missingfields)) {
            echo "<div class='error'> You didn't fill in all the fields!</div>";
          }
          if(!empty($_POST['password']) && strlen($_POST['password'])<6){
            echo "<div class='error'> This password is too short!</div>";
          }
          if (isset($duplicatemail)) {
            echo "<div class='error'> This email is already in use!</div>";
          }

          ?>

            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                <input type="text" class="form-control" placeholder="First Name" name="firstname" id="firstname" aria-describedby="basic-addon1">
            </div>
            <br>
            <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><span class="glyphicon glyphicon-user" aria-hidden="true"></span></span>
                <input type="text" class="form-control" placeholder="Last Name" name="lastname" id="lastname" aria-describedby="basic-addon1">
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
