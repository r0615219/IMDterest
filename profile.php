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
    if($user->Follow==TRUE){
        $follow = "following";
    }
    if($user->Follow==FALSE){
        $follow = "follow";
    }

    $userPosts = new Post();
    $userPosts->user_ID = $userId;
    $userPosts->getPostsViaUser();




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
    <link rel="stylesheet" href="css/topics.css">
    <link rel="stylesheet" href="css/signup-style.css">
    <link rel="stylesheet" href="css/posts.css">
    <link rel="stylesheet" href="css/profile.css">


    <link href="https://fonts.googleapis.com/css?family=Nova+Oval" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css?family=Nova+Oval" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/npm.js"></script>

    <title>IMDterest | Profile</title>
</head>
<body>

<?php
    $page = 'profile';
    include_once('header.inc.php');
?>



<div class="container" style="margin-top:50px;">
    <?php if (isset($error)) { echo "<p>$error</p>"; } ?>

    <div class="head-profile">
        <div class="head-profile-name">
            <img src="images/uploads/userImages/<?php echo $user->Image; ?>" alt="profile picture">

            <h1 class="media-heading"><?php echo $user->Firstname; ?> <?php echo $user->Lastname; ?> <small id="followers"> <?php echo $user->Followers; ?> followers </small> </h1>
        </div>

        <?php if($userId == $_SESSION['userid']): ?>
        <div class="btn-group">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span> <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><a href="profileSettings.php">Edit profile</a></li>
            </ul>
        </div>
        <?php else: ?>

        <button type="button" id="follow" class="btn <?php echo $follow; ?>"> <?php echo $follow; ?> </button>

        <?php endif; ?>

    </div>

    <div class="media-body container">

        <!-- Hier komen de posts van de user -->

            <?php if(empty($_SESSION['userPosts'])): ?>

                <h3>No posts yet!</h3>

            <?php endif; ?>

            <?php foreach ($_SESSION['userPosts'] as $res): ?>

                <div class="userPost">
                    <div class="userPostImg"
                         style="background-image: url('<?php if ($res['link'] == '') {echo './images/uploads/postImages/';} echo $res['image']; ?>');">
                        <a href="topics.php?topicsid=<?php echo $res['topics_ID']; ?>"
                           class="btn btn-link btn-topic-img"><?php
                            $topic = new Topics();
                            $topic->id = $res['topics_ID'];
                            $topic->getTopic();
                            echo $topic->name; ?></a>
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                <span class="caret"></span>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                                <li><a href="#" data-toggle="modal" data-target="#report<?php echo $res['id']; ?>"
                                       type="submit">Report post</a></li>
                                <li><a href="#">Unfollow</a></li>
                                <li role="separator" class="divider"></li>
                                <?php if ($res['user_ID'] == $_SESSION['userid']): ?>

                                    <li><a href="#" data-toggle="modal" data-target="#delete<?php echo $res['id']; ?>"
                                           type="submit">Delete</a></li>

                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>

                    <div class="userPostTopic">
                        <h3>
                            <a href="#" data-toggle="modal"
                               data-target="#postModal<?php echo $res['id']; ?>"><?php echo $res['title']; ?></a>
                        </h3>
                    </div>
                    <?php $post = new Post; ?>
                    <div class="userPostDescription">
                        <h4>
                            <small> <?php echo $post->uploadedWhen($res['time']); ?></small>
                            <small> <?php echo " ".$res['location']; ?></small>
                            <br/>
                            <?php echo $res['description']; ?>
                        </h4>
                    </div>
                    <div class="userPostInfo">

                        <div class="userInfo">
                            <a href="#">
                                <img class="media-object profile-pic" src="images/uploads/userImages/<?php
                                $user = new User;
                                $user->id = $res['user_ID'];
                                $user->getUserInfo();
                                echo $user->Image; ?>" alt="post">
                            </a>
                            <a href="profile.php?userId=<?php echo $user->id ?>">
                                <?php echo $user->Firstname . " " . $user->Lastname; ?>
                            </a>

                            <div class="postId"><?php echo $res['id']; ?></div>
                        </div>
                        <div class="boardPin">
                            <form class="pin"  method="post" ?>
                                <button class="btn-pin" type="submit" name="pinned_post" value=<?php echo $res['id'] ?>><span class="glyphicon glyphicon-pushpin"></span></button>
                                <select name="selected_board" id=selected_board>
                                    <<option selected>Select a board</option>
                                    <?php $board = new board;
                                    $board->loadMyBoard();
                                    $boards=$_SESSION['boards'];
                                    foreach ($boards as $b ) {

                                        echo"<option value=".$b["id"].">".$b['subject']."</option>";
                                    }




                                    ?>
                                </select>
                            </form>
                            <?php



                            ?>

                        </div>
                        <div class="likes">
                            <div class="likeBtn">
                                <a href="#">
                                    <?php
                                    $post = new Post;
                                    $postid = $res['id'];
                                    $liked = $post->checkLiked($postid);
                                    if ($liked == false) {
                                        echo '<img class="media-object" src="images/icons/heart.svg" alt="heart">';
                                    } else {
                                        echo '<img class="media-object" src="images/icons/heart_filled.svg" alt="heart">';
                                    } ?>
                                </a>
                            </div>
                            <div class="likeAmount">
                                <?php
                                $postid = $res['id'];
                                $post->countlikes($postid); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- REPORT post -->
                <div class="modal fade" id="report<?php echo $res['id'] ?>" role="dialog">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Are you sure you want to report this post?</h4>
                            </div>
                            <div class="modal-body">

                                <form action="" method="post" enctype="multipart/form-data">

                                    <h2><?php echo $res['title']; ?></h2>

                                    <button class="btn btn-default btn-danger" type="submit" name="report"
                                            value="<?php echo $res['id']; ?>">Report
                                    </button>
                                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>

                                </form>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- DELETE post -->
                <div class="modal fade" id="delete<?php echo $res['id'] ?>" role="dialog">
                    <div class="modal-dialog">

                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Are you sure you want to delete this post?</h4>
                            </div>
                            <div class="modal-body">

                                <form action="" method="post" enctype="multipart/form-data">

                                    <h2><?php echo $res['title']; ?></h2>

                                    <button class="btn btn-default btn-danger" type="submit" name="delete"
                                            value="<?php echo $res['id']; ?>">Delete
                                    </button>
                                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>

                                </form>

                            </div>

                        </div>

                    </div>
                </div>

                <!-- Post Modal -->
                <div id="postModal<?php echo $res['id']; ?>" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><?php echo $res['title']; ?></h4>
                            </div>
                            <div class="modal-body">
                                <div class="flex-modal">
                                    <div class="post">
                                        <img src="<?php if ($res['link'] == '') {echo './images/uploads/postImages/';} echo $res['image']; ?>" alt="post-image">
                                        <p><?php echo $res['description']; ?></p>
                                    </div>

                                    <div class="comments-form">
                                        <div class="panel panel-default">
                                            <div class="panel-heading comment-list">

                                                <?php
                                                $comment = new Comment;
                                                $comment->loadComment($res['id']);
                                                $comment=$_SESSION['comments'];
                                                foreach ($comment as $c) {
                                                    echo "<div>";
                                                    print_r($c['comment']);
                                                    echo "</div>";
                                                }; ?>

                                            </div>
                                            <form class="comment-form" method="post">
                                                <div class="input-group">
                                                    <span class="input-group-addon profile-comment" id="basic-addon1"><img src="images/uploads/userImages/<?php echo $_SESSION['image']; ?>" alt=""></span>
                                                    <input type="text" class="form-control" placeholder="Leave a comment..." name="comment" id="comment-text" aria-describedby="basic-addon1">
                                                    <input type="hidden" name="post_id" id="post_id" value="<?php echo $res['id']; ?>">
                                                    <button type="submit" name="button" id="comment-btn"><span class="input-group-addon"><span class="glyphicon glyphicon-arrow-right" type="submit"></span></span></button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            <?php endforeach; ?>

    </div>
</div>




</body>
</html>