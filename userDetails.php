<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".php");
});
//stuur de gebruiker weg als ze niet zijn ingelogd
if (isset($_SESSION['user'])) {
} else {
    header('Location: signin.php');
}

$userId = $_GET['userId'];

if($userId == $_SESSION['userid']){
    header('Location: profile.php');
}

$user = new User;
$user->getUserDetails($userId);

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
    <link rel="stylesheet" href="css/profile.css">

    <link href="https://fonts.googleapis.com/css?family=Nova+Oval" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/npm.js"></script>
    <script src="js/followbutton.js"></script>

    <title>IMDterest | <?php echo $user->Firstname . " " .$user->Lastname; ?></title>
</head>
<body>

<?php
$page = 'userdetails';
include_once('header.inc.php'); ?>



<div class="container" style="margin-top:50px;">
    <?php if (isset($error)) {
    echo "<p>$error</p>";
} ?>

    <div class="head-profile">
        <div class="head-profile-name">
            <img src="images/uploads/userImages/<?php echo $user->Image; ?>" alt="profile picture">

            <h1 class="media-heading"><?php echo $user->Firstname; ?> <?php echo $user->Lastname; ?></h1>
        </div>
        
        <button type="button" class="btn" id="follow"> Follow </button>
    </div>

    <div class="media-body">

        <!-- Hier komen de posts van de user -->

    </div>
</div>




</body>
</html>