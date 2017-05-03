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

    if($_GET['topicsid'] != 0){
        $topicInfo = new Topics();
        $topicInfo->id = $_GET['topicsid'];
        $topicInfo->getTopic();

        $topicPost = new Post();
        $topicPost->topics_ID = $_GET['topicsid'];
        $topicPost->getPostsViaTopic();
    } else {
        $allTopics = new Topics();
        $allTopics->getAllTopics();
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

<?php if($_GET['topicsid'] != 0): ?>

    <div class="container-search">

        <h1><?php echo $topicInfo->name; ?></h1>

    </div>

    <div class="container">

    <?php if(isset($error)){ echo "<p class='alert alert-danger'>$error</p>"; } ?>


    <?php foreach ($_SESSION['posts-topic'] as $p): ?>

            <div class="userPost">
                <div class="userPostImg"
                    <?php if (substr($p['image'], 0, 4) === "http"): ?>
                        style="background-image: url(<?php echo $p['image']; ?>);"
                    <?php else: ?>
                        style="background-image: url('images/uploads/postImages/<?php echo $p['image']; ?>');"
                    <?php endif; ?>>
                    <a href="topics.php?topicsid=<?php echo $p['topics_ID'] ?>" class="btn btn-link btn-topic-img"><?php echo $topicInfo->name; ?></a>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="#" data-toggle="modal" data-target="#report<?php echo $p['id']; ?>" type="submit">Report post</a></li>
                            <li><a href="#">Unfollow</a></li>
                            <li role="separator" class="divider"></li>
                            <?php if ($p['user_ID'] == $_SESSION['userid']): ?>

                                <li><a href="#" data-toggle="modal" data-target="#delete<?php echo $p['id']; ?>" type="submit">Delete</a></li>

                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="userPostTopic">
                    <h3>
                        <a href="#" data-toggle="modal" data-target="#postModal<?php echo $p['id']; ?>"><?php echo $p['title']; ?></a>
                    </h3>
                </div>
                <?php $post = new Post; ?>
                <div class="userPostDescription"><h4><?php echo $p['description']; ?> <small> <?php //echo $post->uploadedWhen($p->time); ?></small></h4></div>
                <hr>
                <div class="userPostInfo">

                    <div class="userInfo">
                        <a href="#">
                            <img class="media-object profile-pic" src="images/uploads/userImages/<?php
                            $user = new User;
                            $user->id = $p['user_ID'];
                            $user->getUserInfo();
                            echo $user->Image; ?>" alt="post">
                        </a>
                        <a href="userDetails.php?userId=<?php echo $user->id ?>">
                            <?php echo $user->Firstname . " " . $user->Lastname; ?>
                        </a>

                        <div class="postId"><?php echo $p['id']; ?></div>
                    </div>

                    <div class="likes">
                        <div class="likeBtn">
                            <a href="#">
                                <?php
                                $post = new Post;
                                $postid = $p['id'];
                                $liked=$post->checkLiked($postid);
                                if ($liked==false) {
                                    echo '<img class="media-object" src="images/icons/heart.svg" alt="heart">';
                                } else {
                                    echo '<img class="media-object" src="images/icons/heart_filled.svg" alt="heart">';
                                } ?>
                            </a>
                        </div>
                        <div class="likeAmount">
                            <?php
                            $postid = $p['id'];
                            $post->countlikes($postid); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- REPORT post -->
            <div class="modal fade" id="report<?php echo $p['id']; ?>" role="dialog">
                <div class="modal-dialog">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Are you sure you want to report this post?</h4>
                        </div>
                        <div class="modal-body">

                            <form action="" method="post" enctype="multipart/form-data">

                                <h2><?php echo $p['title']; ?></h2>

                                <button class="btn btn-default btn-danger" type="submit" name="report" value="<?php echo $res->id; ?>">Report</button>
                                <button class="btn btn-default" data-dismiss="modal" >Cancel</button>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

            <!-- DELETE post -->
            <div class="modal fade" id="delete<?php echo $p['id']; ?>" role="dialog">
                <div class="modal-dialog">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Are you sure you want to delete this post?</h4>
                        </div>
                        <div class="modal-body">

                            <form action="" method="post" enctype="multipart/form-data">

                                <h2><?php echo $p['title']; ?></h2>

                                <button class="btn btn-default btn-danger" type="submit" name="delete" value="<?php echo $res->id; ?>">Delete</button>
                                <button class="btn btn-default" data-dismiss="modal" >Cancel</button>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

            <!-- Post Modal -->
            <div id="postModal<?php echo $p['id']; ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><?php echo $p['title']; ?></h4>
                        </div>
                        <div class="modal-body">
                            <div class="flex-modal">
                                <div class="post">
                                    <img src="images/uploads/postImages/<?php echo $p['image']; ?>" alt="post-image">
                                    <p><?php echo $p['description']; ?></p>
                                </div>
                                <div class="comments">
                                    <form action="post">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <p>Hier komen de comments van users</p>
                                            </div>
                                            <div class="input-group">
                                                <span class="input-group-addon profile-comment" id="basic-addon1"><img src="images/uploads/userImages/<?php echo $_SESSION['image']; ?>" alt=""></span>
                                                <input type="text" class="form-control" placeholder="Leave a comment..." name="comment" id="comment" aria-describedby="basic-addon1">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-arrow-right" type="submit"></span></span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

    <?php endforeach; ?>

    </div>

<?php endif; ?>

<?php if($_GET['topicsid'] == 0): ?>

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
                        style="background-image: url('images/uploads/postImages/<?php echo $t['image']; ?>');"
                    <?php endif; ?>></div>

                <div class="userPostTopic">
                    <h3>
                        <a href="topics.php?topicsid=<?php echo $t['id']; ?>">
                            <?php echo $t['name']; ?>
                        </a>
                    </h3>
                </div>
            </div>

        <?php endforeach; ?>

    </div>

<?php endif; ?>

</body>
</html>
