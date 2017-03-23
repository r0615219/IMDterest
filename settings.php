<?php
session_start();
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

<!-- todo: werkt nog niet! :( -->

<?php include_once('header.inc.php'); ?>

<div class="settings">
    <div class="profile_link"><img src="<?php
        foreach($_SESSION['user'] as $item){
            echo $item->Image;
        }?>" alt="Profile Picture" class="profilepicture"></div>
</div>

<div class="media">
    <div class="media-left">
            <img class="media-object" src="http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png" alt="profile pic">
    </div>
    <div class="media-body">
        <h4 class="media-heading"><?php echo $_SESSION['fullname']; ?></h4>
        <p>Username : <?php echo $_SESSION['user']; ?></p>
        <p>Email : <?php echo $_SESSION['email']; ?></p>
    </div>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/npm.js"></script>

</body>
</html>