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
if ($user->Follow == TRUE) {
    $follow = "following";
}
if ($user->Follow == FALSE) {
    $follow = "follow";
}
$userPosts = new Post();
$userPosts->user_ID = $userId;
$userPosts->getPostsViaUser();

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
    <link rel="stylesheet" href="css/topics.css">
    <link rel="stylesheet" href="css/signup-style.css">
    <link rel="stylesheet" href="css/posts.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="stylesheet" href="css/follow.css">


    <link href="https://fonts.googleapis.com/css?family=Nova+Oval" rel="stylesheet">

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


    <title>IMDterest | Profile</title>
</head>
<body>

<?php
$page = 'profile';
include_once('header.inc.php');
?>


<div class="container" style="margin-top:50px;">
    <?php if (isset($error)) {
        echo "<p class='alert alert-danger'>$error</p>";
    } ?>
    <?php if (!empty($success)) {
        echo "<p class='alert alert-success'>$success</p>";
    } ?>

    <div class="head-profile">
        <div class="head-profile-name">
            <img src="images/uploads/userImages/<?php echo $user->Image; ?>" alt="profile picture">

            <h1 class="media-heading"><?php echo $user->Firstname; ?> <?php echo $user->Lastname; ?>
                <small id="followers"> <?php echo $user->Followers; ?> followers</small>
            </h1>
        </div>

        <?php if ($userId == $_SESSION['userid']): ?>
            <div class="btn-group">
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
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

        <?php if (empty($_SESSION['userPosts'])): ?>

            <h3>No posts yet!</h3>

        <?php endif; ?>

        <?php foreach ($_SESSION['userPosts'] as $res): ?>

            <?php include("postTemplate.php"); ?>

        <?php endforeach; ?>
    </div>
</div>
</body>
</html>