<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("../classes/" . $class . ".php");
});
include_once('../emptyStates.php');
//sanitize post value
$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);

//throw HTTP error if page number is not valid
if (!is_numeric($page_number)) {
    header('HTTP/1.1 500 Invalid page number!');
    exit();
}

//get current starting point of records
$position = (($page_number - 1) * 20);
$limit = 20;
//fetch records using page position and item per page.
$conn = Db::getInstance();
$statement = $conn->prepare("SELECT * FROM posts ORDER BY id DESC LIMIT :position, :limit");

//bind parameters for markers, where (s = string, i = integer, d = double,  b = blob)
//for more info https://www.sanwebe.com/2013/03/basic-php-mysqli-usage
$statement->bindValue(":position", $position, PDO::PARAM_INT);
$statement->bindValue(":limit", $limit, PDO::PARAM_INT);
$statement->execute(); //Execute prepared Query

//output results from database
$rows = $statement->rowCount();
if ($rows > 0) {
    $_SESSION['posts'] = true;
    while ($res = $statement->fetchObject("Post")) {
        if ($res->reports < 3) {
            //fetch values
            ob_start(); ?>
            <div class="userPost">
                <div class="userPostImg"
                     style="background-image: url('<?php if ($res->link == '') {echo './images/uploads/postImages/';} echo $res->image; ?>');">
                    <a href="topics.php?topicsid=<?php echo $res->topics_ID; ?>"
                       class="btn btn-link btn-topic-img"><?php
                        $topic = new Topics();
                        $topic->id = $res->topics_ID;
                        $topic->getTopic();
                        echo $topic->name; ?></a>
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                            <li><a href="#" data-toggle="modal" data-target="#report<?php echo $res->id ?>"
                                   type="submit">Report post</a></li>
                            <li><a href="#">Unfollow</a></li>
                            <li role="separator" class="divider"></li>
                            <?php if ($res->user_ID == $_SESSION['userid']): ?>

                                <li><a href="#" data-toggle="modal" data-target="#delete<?php echo $res->id ?>"
                                       type="submit">Delete</a></li>

                            <?php endif; ?>
                        </ul>
                    </div>
                </div>

                <div class="userPostTopic">
                    <h3>
                        <a href="#" data-toggle="modal"
                           data-target="#postModal<?php echo $res->id ?>"><?php echo $res->title; ?></a>
                    </h3>
                </div>
                <?php $post = new Post; ?>
                <div class="userPostDescription">
                    <h4><?php echo $res->description; ?>
                        <small> <?php echo $post->uploadedWhen($res->time); ?></small>
                    </h4>
                </div>
                <div class="userPostInfo">

                    <div class="userInfo">
                        <a href="#">
                            <img class="media-object profile-pic" src="images/uploads/userImages/<?php
                            $user = new User;
                            $user->id = $res->user_ID;
                            $user->getUserInfo();
                            echo $user->Image; ?>" alt="post">
                        </a>
                        <a href="userDetails.php?userId=<?php echo $user->id ?>">
                            <?php echo $user->Firstname . " " . $user->Lastname; ?>
                        </a>

                        <div class="postId"><?php echo $res->id; ?></div>
                    </div>

                    <div class="likes">
                        <div class="likeBtn">
                            <a href="#">
                                <?php
                                $post = new Post;
                                $postid = $res->id;
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
                            $postid = $res->id;
                            $post->countlikes($postid); ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- REPORT post -->
            <div class="modal fade" id="report<?php echo $res->id ?>" role="dialog">
                <div class="modal-dialog">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Are you sure you want to report this post?</h4>
                        </div>
                        <div class="modal-body">

                            <form action="" method="post" enctype="multipart/form-data">

                                <h2><?php echo $res->title; ?></h2>

                                <button class="btn btn-default btn-danger" type="submit" name="report"
                                        value="<?php echo $res->id; ?>">Report
                                </button>
                                <button class="btn btn-default" data-dismiss="modal">Cancel</button>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

            <!-- DELETE post -->
            <div class="modal fade" id="delete<?php echo $res->id ?>" role="dialog">
                <div class="modal-dialog">

                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title">Are you sure you want to delete this post?</h4>
                        </div>
                        <div class="modal-body">

                            <form action="" method="post" enctype="multipart/form-data">

                                <h2><?php echo $res->title; ?></h2>

                                <button class="btn btn-default btn-danger" type="submit" name="delete"
                                        value="<?php echo $res->id; ?>">Delete
                                </button>
                                <button class="btn btn-default" data-dismiss="modal">Cancel</button>

                            </form>

                        </div>

                    </div>

                </div>
            </div>

            <!-- Post Modal -->
            <div id="postModal<?php echo $res->id ?>" class="modal fade" role="dialog">
                <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"><?php echo $res->title; ?></h4>
                        </div>
                        <div class="modal-body">
                            <div class="flex-modal">
                                <div class="post">
                                    <img src="<?php if ($res->link == '') {echo './images/uploads/postImages/';} echo $res->image; ?>" alt="post-image">
                                    <p><?php echo $res->description; ?></p>
                                </div>

                        <div class="comments-form">
                            <div class="panel panel-default">
                                <div class="panel-heading comment-list">

                                        <?php
                                        $comment = new Comment;
                                        $comment->loadComment($res->id);
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
                                        <input type="hidden" name="post_id" id="post_id" value="<?php echo $res->id; ?>">
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
            <?php echo ob_get_clean();
        }
    }
} else {
    $_SESSION['posts'] = false;
    shuffle($emptyStates);
    echo '<h1 class="emptyState">' . $emptyStates[0] . '</h1>' . "\n" . '<h1 class="emptyStateTxt">Oops, no posts found!</h1><script>$(".LoadMoreBtn").text("No more records!").prop("disabled", true);</script>';
};

echo '<script src="js/likebutton.js"></script>';
echo '<script src="js/comment-btn.js"></script>';
echo '<script src="js/likebutton.js"></script>'
?>
