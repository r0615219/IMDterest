<?php
session_start();
spl_autoload_register(function($class){
    include_once("../classes/" . $class . ".php");
});
include_once('../emptyStates.php');
//sanitize post value
$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

//throw HTTP error if page number is not valid
if(!is_numeric($page_number)){
    header('HTTP/1.1 500 Invalid page number!');
    exit();
}

//get current starting point of records
$position = (($page_number-1) * 20);
$limit = 20;
//fetch records using page position and item per page.
$conn = Db::getInstance();
$statement = $conn->prepare("SELECT * FROM posts where user_ID in (SELECT id FROM `users` WHERE email = :email) ORDER BY id DESC LIMIT :position, :limit");

//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
//for more info https://www.sanwebe.com/2013/03/basic-php-mysqli-usage
$statement->bindValue(":position", $position, PDO::PARAM_INT);
$statement->bindValue(":limit", $limit, PDO::PARAM_INT);
$statement->bindValue(":email", $_SESSION['user']);
$statement->execute(); //Execute prepared Query

//output results from database
$rows = $statement->rowCount();
if($rows > 0){
    $_SESSION['posts'] = true;
    while($res = $statement->fetch(PDO::FETCH_OBJ)) { //fetch values
        ob_start(); ?>
        <div class="userPost">
            <div class="userPostImg" style="background-image: url(images/uploads/postImages/<?php echo $res->image; ?>);">
                <button class="btn btn-link btn-topic-img"><?php
                    $topic = new Topics();
                    $topic->id = $res->topics_ID;
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
                        <?php if($res->user_ID == $_SESSION['id']): ?>

                        <li><a href="#">Delete</a></li> <!--via ajax post verwijderen + kijken of post van user is-->

                        <?php endif; ?>
                    </ul>
                </div>
            </div>
            <div class="userPostTopic">
                <h3>
                    <a href="#"><?php echo $res->title; ?></a>
                </h3>
            </div>
            <div class="userPostDescription"><h4><?php echo $res->description; ?></h4></div>
            <hr>
            <div class="userPostInfo">

                <div class="userInfo">
                    <a href="#">
                        <img class="media-object profile-pic" src="images/uploads/userImages/<?php
                        $user = new User;
                        $user->id = $res->user_ID;
                        $user->getUserInfo();
                        echo $user->Image;
                        ?>" alt="post">
                    </a>
                    <a href="#">
                        <?php echo $user->Firstname . " " . $user->Lastname; ?>
                    </a>

                    <div class="postId"><?php //echo " #".$res->id; ?></div>
                </div>

                <div class="likes">
                    <div class="likeBtn">
                        <a href="#">
                            <?php
                            $post = new Post;
                            $postid = $res->id;
                            $liked=$post->checkLiked($postid);
                            if ($liked==false) {
                                echo '<img class="media-object" src="images/icons/heart.svg" alt="heart">';
                            }
                            else {
                                echo '<img class="media-object" src="images/icons/heart_filled.svg" alt="heart">';
                            }
                            ?>
                        </a>
                    </div>
                    <div class="likeAmount">
                        <?php
                        $postid = $res->id;
                        $post->countlikes($postid);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php echo ob_get_clean();
    }
}

else{
    $_SESSION['posts'] = false;
    shuffle($emptyStates);
    echo '<h1 class="emptyState">' . $emptyStates[0] . '</h1>'."\n".'<h1 class="emptyStateTxt">Oops, no posts found!</h1>';

}


 ?>