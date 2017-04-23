<?php
    session_start();

    spl_autoload_register(function($class){
        include_once("classes/" . $class . ".php");
    });

    //stuur de gebruiker weg als ze niet zijn ingelogd
    if( isset( $_SESSION['user'] ) ){
    } else {
        header('Location: signin.php');
    }

?>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/npm.js"></script>

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

    <?php include_once('header.inc.php'); ?>

    <?php if(isset($error)){
            echo $error;
        }
    ?>

    <div class="container-search">

        <h1>Search Results</h1>

        <p><span class="bold"><?php echo $_SESSION['aantalResults']; ?></span> results for <span class="bold"><?php echo $_SESSION['zoekterm']; ?></span> in <span class="bold"><?php echo $_SESSION['zoekselect']; ?></span></p>

    </div>

    <?php if($_SESSION['zoekselect'] == 'posts'): ?>

        <div class="container">

        <?php foreach ($_SESSION['search'] as $searchItem): ?>

            <div class="userPost">
                <div class="userPostImg" style="background-image: url(images/uploads/postImages/<?php echo $searchItem['image']; ?>);">
                    <button class="btn btn-link btn-topic-img"><?php
                        $topic = new Topics();
                        $topic->id = $searchItem['topics_ID'];
                        $topic->getTopic();
                        echo $topic->name;
                        ?></button>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="#">Report post</a></li>
                            <li><a href="#">Unfollow</a></li>
                            <li role="separator" class="divider"></li>
                            <?php if($searchItem['user_ID'] == $_SESSION['userid']): ?>

                                <li><a href="#">Delete</a></li> <!--via ajax post verwijderen + kijken of post van user is-->

                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
                <div class="userPostTopic">
                    <h3>
                        <a href="#"><?php echo $searchItem['title'] ?></a>
                    </h3>
                </div>
                <div class="userPostDescription"><h4><?php echo $searchItem['description']; ?></h4></div>
                <hr>
                <div class="userPostInfo">

                    <div class="userInfo">
                        <a href="#">
                            <img class="media-object profile-pic" src="images/uploads/userImages/<?php
                            $user = new User;
                            $user->id = $searchItem['user_ID'];
                            $user->getUserInfo();
                            echo $user->Image;
                            ?>" alt="post">
                        </a>
                        <a href="#">
                            <?php
                            echo $user->Firstname . " " . $user->Lastname;
                            ?>
                        </a>
                    </div>

                    <div class="likeBtn">
                        <a href="#">
                            <img class="media-object" src="images/icons/heart.svg" alt="heart">
                        </a>
                    </div>

                </div>
            </div>

        <?php endforeach; ?>

        </div>

    <?php endif; ?>

    <?php if($_SESSION['zoekselect'] == 'users'): ?>

        <div class="container">

            <?php foreach ($_SESSION['search'] as $searchItem): ?>

                <div class="userPost">
                    <div class="userPostImg"
                         <?php if(substr( $searchItem['image'], 0, 4 ) === "http"): ?>
                            style="background-image: url(<?php echo $searchItem['image']; ?>);"
                         <?php else: ?>
                            style="background-image: url(images/uploads/userImages/<?php echo $searchItem['image']; ?>);"
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

    <?php if($_SESSION['zoekselect'] == 'topics'): ?>

        <div class="container">

            <?php foreach ($_SESSION['search'] as $searchItem): ?>

                <div class="userPost">
                    <div class="userPostImg" style="background-image: url(<?php echo $searchItem['image']; ?>);"></div>
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