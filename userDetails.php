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

    <title>IMDterest | Profile</title>
</head>
<body>

<?php include_once('header.inc.php'); ?>



<div class="container" style="margin-top:50px;">
    <?php if (isset($error)) {
    echo "<p>$error</p>";
} ?>

    <div class="head-profile">
        <div class="head-profile-name">
            <img src="images/uploads/userImages/<?php echo $_SESSION['image']; ?>" alt="profile picture">

            <h1 class="media-heading"><?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?></h1>
        </div>

        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="profileSettings.php">Edit profile</a></li>
            </ul>
        </div>
    </div>

    <div class="media-body">

        <!-- Hier komen de posts van de user -->

    </div>
</div>




</body>
</html>