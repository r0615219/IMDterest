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

    if ($_GET['topicsid'] != 0) {
        $topicInfo = new Imdterest\Topics;
        $topicInfo->id = $_GET['topicsid'];
        $topicInfo->getTopic();

        $topicPost = new Imdterest\Post();
        $topicPost->topics_ID = $_GET['topicsid'];
        $topicPost->getPostsViaTopic();
    } else {
        Imdterest\Topics::getAllTopics();
    }

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

    <title>IMDterest | Topics</title>
</head>
<body>

<?php
$page = 'topics';
include_once('header.inc.php'); ?>

<?php if ($_GET['topicsid'] != 0): ?>

    <div class="container-search">

        <h1><?php echo $topicInfo->name; ?></h1>

    </div>

    <div class="container">

    <?php if (isset($error)) {
    echo "<p class='alert alert-danger'>$error</p>";
} ?>


    <?php foreach ($_SESSION['posts-topic'] as $res): ?>

        <?php include("postTemplate.php"); ?>

    <?php endforeach; ?>

    </div>

<?php endif; ?>

<?php if ($_GET['topicsid'] == 0): ?>

    <div class="container-search">

        <h1>Topics</h1>

    </div>

    <div class="container">

        <?php foreach ($_SESSION['alltopics'] as $t): ?>

            <div class="userPost">
                <div class="userPostImg"
                    <?php if (substr($t['image'], 0, 4) === "http"): ?>
                        style="background-image: url(<?php echo $t['image']; ?>);"
                    <?php else: ?>
                        style="background-image: url('images/topics/<?php echo $t['image']; ?>');"
                    <?php endif; ?>></div>

                <div class="userInfo userInfoPreview">
                    <a href="topics.php?topicsid=<?php echo $t['id']; ?>"><?php echo $t['name']; ?></a>
                </div>
            </div>

        <?php endforeach; ?>

    </div>

<?php endif; ?>

</body>
</html>
