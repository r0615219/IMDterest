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

    include_once 'post.inc.php';

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
    <script src="js/bootstrap.min.js"></script>
    <script src="js/add-btn.js"></script>
    <script src="js/npm.js"></script>
    <script src="js/likebutton.js"></script>
    <script src="js/loadMore.js"></script>
    <script src="js/comment-btn.js"></script>
    <script src="js/location.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>

    <title>IMDterest | Search</title>

    <style>
        .bold{
            font-weight: bold;
            text-transform: uppercase;
        }
    </style>

</head>
<body>

    <?php
    $page = 'search';
    include_once('header.inc.php'); ?>

    <div class="container-search">

        <?php if (isset($error)) {
        echo "<p class='alert alert-danger'>$error</p>";
    } ?>
        <?php if (!empty($success)) {
        echo "<p class='alert alert-success'>$success</p>";
    } ?>

        <h1>Search Results</h1>

        <p><span class="bold"><?php echo $_SESSION['aantalResults']; ?></span> results for <span class="bold"><?php echo $_SESSION['zoekterm']; ?></span> in <span class="bold"><?php echo $_SESSION['zoekselect']; ?></span></p>

    </div>

    <div class="container">


    <?php if ($_SESSION['zoekselect'] == 'posts'): ?>

        <?php foreach ($_SESSION['search'] as $res): ?>

            <?php include("postTemplate.php"); ?>

        <?php endforeach; ?>

    <?php endif; ?>

    <?php if ($_SESSION['zoekselect'] == 'users'): ?>

            <?php foreach ($_SESSION['search'] as $searchItem): ?>

                <div class="userPost">
                    <div class="userPostImg"
                         <?php if (substr($searchItem['image'], 0, 4) === "http"): ?>
                            style="background-image: url(<?php echo $searchItem['image']; ?>);"
                         <?php else: ?>
                            style="background-image: url('images/uploads/userImages/<?php echo $searchItem['image']; ?>');"
                        <?php endif; ?>></div>
                    <div class="userInfo userInfoPreview">
                        <a href="profile.php?userId=<?php echo $searchItem['id']; ?>"><?php echo $searchItem['firstname'] . " " . $searchItem['lastname']; ?></a>
                    </div>
                </div>

            <?php endforeach; ?>

    <?php endif; ?>

    <?php if ($_SESSION['zoekselect'] == 'topics'): ?>

            <?php foreach ($_SESSION['search'] as $searchItem): ?>

                <div class="userPost">
                    <div class="userPostImg"
                        <?php if (substr($searchItem['image'], 0, 4) === "http"): ?>
                            style="background-image: url(<?php echo $searchItem['image']; ?>);"
                        <?php else: ?>
                            style="background-image: url('images/uploads/postImages/<?php echo $searchItem['image']; ?>');"
                        <?php endif; ?>></div>

                    <div class="userInfo userInfoPreview">
                        <a href="topics.php?topicsid=<?php echo $searchItem['id']; ?>"><?php echo $searchItem['name']; ?></a>
                    </div>
                </div>

            <?php endforeach; ?>

    <?php endif; ?>

    </div>

</body>
</html>
