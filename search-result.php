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

?><!doctype html>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/npm.js"></script>

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

    <?php if (isset($error)) {
    echo $error;
}
    ?>

    <div class="container-search">

        <h1>Search Results</h1>

        <p><span class="bold"><?php echo $_SESSION['aantalResults']; ?></span> results for <span class="bold"><?php echo $_SESSION['zoekterm']; ?></span> in <span class="bold"><?php echo $_SESSION['zoekselect']; ?></span></p>

    </div>

    <?php if ($_SESSION['zoekselect'] == 'posts'): ?>

        <div class="container">

        <?php foreach ($_SESSION['search'] as $res): ?>

            <?php include("postTemplate.php"); ?>

        <?php endforeach; ?>

        </div>

    <?php endif; ?>

    <?php if ($_SESSION['zoekselect'] == 'users'): ?>

        <div class="container">

            <?php foreach ($_SESSION['search'] as $searchItem): ?>

                <div class="userPost">
                    <div class="userPostImg"
                         <?php if (substr($searchItem['image'], 0, 4) === "http"): ?>
                            style="background-image: url(<?php echo $searchItem['image']; ?>);"
                         <?php else: ?>
                            style="background-image: url('images/uploads/userImages/<?php echo $searchItem['image']; ?>');"
                        <?php endif; ?>></div>
                    <div class="userPostTopic">
                        <h3>
                            <a href="#">
                                <?php echo $searchItem['firstname'] . " " . $searchItem['lastname']; ?>
                            </a>
                        </h3>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

    <?php if ($_SESSION['zoekselect'] == 'topics'): ?>

        <div class="container">

            <?php foreach ($_SESSION['search'] as $searchItem): ?>

                <div class="userPost">
                    <div class="userPostImg"
                        <?php if (substr($searchItem['image'], 0, 4) === "http"): ?>
                            style="background-image: url(<?php echo $searchItem['image']; ?>);"
                        <?php else: ?>
                            style="background-image: url('images/uploads/postImages/<?php echo $searchItem['image']; ?>');"
                        <?php endif; ?>></div>

                    <div class="userPostTopic">
                        <h3>
                            <a href="#">
                                <?php echo $searchItem['name']; ?>
                            </a>
                        </h3>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>

    <?php endif; ?>

</body>
</html>
