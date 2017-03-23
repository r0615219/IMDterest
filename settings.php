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
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/style-home.css">

    <link href="https://fonts.googleapis.com/css?family=Nova+Oval" rel="stylesheet">

    <title>IMDterest</title>
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

</body>
</html>