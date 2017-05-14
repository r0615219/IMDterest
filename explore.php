<?php

session_start();
/*spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".php");
});*/
include_once("classes/board.php");
include_once("classes/Comment.php");
include_once("classes/Db.php");
include_once("classes/Post.php");
include_once("classes/Search.php");
include_once("classes/Topics.php");
include_once("classes/User.php");

//stuur de gebruiker weg als ze niet zijn ingelogd
if (isset($_SESSION['user'])) {
} else {
    header('Location: signin.php');
}
include_once('post.inc.php');
?><!doctype html>
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
    <link rel="stylesheet" href="css/topics.css">
    <link rel="stylesheet" href="css/add-button.css">
    <link rel="stylesheet" href="css/posts.css">

    <link href="https://fonts.googleapis.com/css?family=Nova+Oval" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/add-btn.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/npm.js"></script>
    <script src="js/likebutton.js"></script>
    <script src="js/loadMore.js"></script>
    <script src="js/comment-btn.js"></script>
    <script src="js/location.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

    <title>IMDterest | Explore</title>
</head>
<body>
    <?php
    $page = 'explore';
    include_once('header.inc.php');
    include_once('emptyStates.php'); ?>
    <div class="container">

        <?php if (isset($error)) {
        echo "<p class='alert alert-danger'>$error</p>";
    } ?>
        <?php if (!empty($success)) {
        echo "<p class='alert alert-success'>$success</p>";
    } ?>

        <div id="results"></div>

        <div class="loadMore">
            <button class="loadMoreBtn loadMoreBtnExplore btn btn-primary">Load 20 more</button>
        </div>

        <?php include_once('addBtn.php'); ?>
    </div>
</body>
</html>