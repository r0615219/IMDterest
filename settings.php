<?php
session_start();
//stuur de gebruiker weg als ze niet zijn ingelogd
if (isset($_SESSION['user'])) {
} else {
    header('Location: signin.php');
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

    <title>IMDterest | Settings</title>
</head>
<body>

<?php include_once('header.inc.php'); ?>

<div class="container" style="margin-top:50px;">
    <h1 class="media-heading">Account settings</h1>
    <div class="media-body">
        <form action="" method="post">
            <label for="fullname">Full name</label>
            <input type="text" value="<?php echo $_SESSION['fullname']; ?>" id="fullname" name="fullname"
                   class="form-control">

            <label for="email" style="margin-top:20px;">Email</label>
            <input type="text" value="<?php echo $_SESSION['email']; ?>" id="email" name="email"
                   class="form-control">

            <label for="username" style="margin-top:20px;">Username</label>
            <input type="text" value="<?php echo $_SESSION['user']; ?>" id="username" name="username"
                   class="form-control">

            <div class="media">
                <img src="<?php echo $_SESSION['image']; ?>" alt="profile picture" style="margin-top:20px;">
                <button class="btn media">Change profile picture</button>
            </div>

            <label for="password" style="margin-top:20px;" class="col-xs-12">Password</label>
            <a href="#" class="col-xs-12">Change your password</a>

            <button type="submit" class="btn btn-success" style="margin-top: 50px;">Save settings</button>

        </form>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/npm.js"></script>

</body>
</html>