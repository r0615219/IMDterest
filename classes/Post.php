<?php


class Post
{
    private $m_iID;
    private $m_sTitle;
    private $m_sImage;
    private $m_sDescription;
    private $m_sLink;
    private $m_iTopicsId;
    private $m_iUserId;
    private $m_iUploadtime;
    private $m_iReports;

    public function __set($p_sProperty, $p_vValue)
    {
        switch ($p_sProperty) {
            case 'id':
                $this->m_iID = $p_vValue;
                break;

            case 'title':
                $this->m_sTitle = $p_vValue;
                break;

            case 'image':
                $this->m_sImage = $p_vValue;
                break;

            case 'description':
                $this->m_sDescription = $p_vValue;
                break;

            case 'link':
                $this->m_sLink = $p_vValue;
                break;

            case 'topics_ID':
                $this->m_iTopicsId = $p_vValue;
                break;

            case 'user_ID':
                $this->m_iUserId = $p_vValue;
                break;

            case 'uploadtime':
                $this->m_iUploadtime = $p_vValue;
                break;

            case 'reports':
                $this->m_iReports = $p_vValue;
                break;
        }
    }

    public function __get($p_sProperty)
    {
        switch ($p_sProperty) {
            case 'id':
                return $this->m_iID;
                break;

            case 'title':
                return $this->m_sTitle;
                break;

            case 'image':
                return $this->m_sImage;
                break;

            case 'description':
                return $this->m_sDescription;
                break;

            case 'link':
                return $this->m_sLink;
                break;

            case 'topics_ID':
                return $this->m_iTopicsId;
                break;

            case 'user_ID':
                return $this->m_iUserId;
                break;

            case 'uploadtime':
                return $this->m_iUploadtime;
                break;

            case 'reports':
                return $this->m_iReports;
                break;
        }
    }

    public function savePost()
    {
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO `posts`(`user_ID`, `title`, `image`, `description`, `link`, `topics_ID`, `time`) VALUES (:user_ID, :title, :image, :description, :link, :topics_ID, :time);");
            $statement->bindValue(":user_ID", $_SESSION['userid']);
            $statement->bindValue(":title", $this->m_sTitle);
            $statement->bindValue(":image", $this->m_sImage);
            $statement->bindValue(":description", $this->m_sDescription);
            $statement->bindValue(":link", $this->m_sLink);
            $statement->bindValue(":topics_ID", $this->m_iTopicsId);
            $statement->bindValue(":time", $this->m_iUploadtime);
            $statement->execute();
        } catch (PDOException $e) {
            $error = $e->getMessage();
        }
    }

    public function checkLiked($PostId)
    {
        $conn = Db::getInstance();
        $likecheckstatement = $conn->prepare("SELECT * FROM `likes` WHERE UserId = :userid AND PostId = :postid");
        $likecheckstatement->bindValue(":userid", $_SESSION['userid']);
        $likecheckstatement->bindValue(":postid", $PostId);
        $likecheckstatement->execute();
        $likes = $likecheckstatement->fetch(PDO::FETCH_ASSOC);
        if (empty($likes)) {
            return false;
        } else {
            return true;
        }
    }

    public function countlikes($PostId)
    {
        $conn = Db::getInstance();
        $likecheckstatement = $conn->prepare("SELECT * FROM `likes` WHERE PostId = :postid");
        $likecheckstatement->bindValue(":postid", $PostId);
        $likecheckstatement->execute();
        $rows = $likecheckstatement->rowCount();
        echo $rows;
    }

    public function uploadedWhen($timestamp)
    {
        $verschil = time() - $timestamp;
        if ($verschil > 0 && $verschil < 60) {
            $return = "Posted less than a minute ago";
        } elseif ($verschil > 60 && $verschil < 120) {
            $return = "Posted 1 minute ago";
        } elseif ($verschil > 60 && $verschil < 60 * 60) {
            $x = floor($verschil / 60);
            $return = "Posted " . $x . " minutes ago";
        } elseif ($verschil > 60 * 60 && $verschil < 2 * 60 * 60) {
            $return = "Posted 1 hour ago";
        } elseif ($verschil > 2 * 60 * 60 && $verschil < 24 * 60 * 60) {
            $x = floor($verschil / 360);
            $return = "Posted " . $x . " hours ago";
        } elseif ($verschil > 24 * 60 * 60 && $verschil < 2 * 24 * 60 * 60) {
            $return = "Posted a day ago";
        } elseif ($verschil > 24 * 60 * 60 && $verschil < 7 * 24 * 60 * 60) {
            $x = floor($verschil / (24 * 60 * 60));
            $return = "Posted " . $x . " days ago";
        } elseif ($verschil > 7 * 24 * 60 * 60 && $verschil < 2 * 7 * 24 * 60 * 60) {
            $return = "Posted a week ago";
        } elseif ($verschil > 2 * 7 * 24 * 60 * 60 && $verschil < 30 * 24 * 60 * 60) {
            $x = floor($verschil / (7 * 24 * 60 * 60));
            $return = "Posted " . $x . " weeks ago";
        } elseif ($verschil > 30 * 24 * 60 * 60 && $verschil < 2 * 30 * 24 * 60 * 60) {
            $return = "Posted a month ago";
        } elseif ($verschil > 2 * 30 * 24 * 60 * 60 && $verschil < 12 * 30 * 24 * 60 * 60) {
            $x = floor($verschil / (30 * 24 * 60 * 60));
            $return = "Posted " . $x . " months ago";
        } elseif ($verschil > 365 * 24 * 60 * 60 && $verschil < 372 * 24 * 60 * 60) {
            $return = "Posted a year ago ago";
        } elseif ($verschil > 372 * 24 * 60 * 60) {
            $date = date('d/m/Y', $timestamp);
            if ($date == "01/01/1970") {
                $return = "Posted before the dawn of time";
            } else {
                $return = "Posted on " . $date . " ";
            }
        } else {
            $return = "Posted just now";
        }
        return $return;
    }

    public function reportPost()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE posts SET reports = reports + 1 WHERE id = :id");
        $statement->bindValue(":id", $this->m_iID);
        $statement->execute();
    }

    public function deletePost()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("DELETE FROM posts WHERE id = :id");
        $statement->bindValue(":id", $this->m_iID);
        $statement->execute();
    }


    public function getPostsViaTopic()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM `posts` WHERE `topics_ID` = (:topicsid)");
        $statement->bindValue(":topicsid", $this->m_iTopicsId);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['posts-topic'] = $result;
    }


    public function saveToBoard($board_id)
    {
        //console.log("hey");
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO `boardposts`(`post_id`, `board_id`) VALUES (:post_id,:board_id)");
        $statement->bindvalue(":post_id",$this->m_iID);
        $statement->bindvalue(":board_id",$board_id);
        $res=$statement->execute();

    }

    public function loadToBoard($board_id){
        $conn = Db::getInstance();
        $statement =$conn->prepare("SELECT * FROM `boardposts` WHERE `board_id` = (:board_id)");
        $statement->bindvalue(":board_id",$board_id);
        $statement->execute();
        $res=$statement->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['boardposts_id']=$res;
      }

      public function loadPost($post_id){
        $conn = Db::getInstance();
        $statement =$conn->prepare("SELECT * FROM `posts` WHERE `id` = (:id)");
        $statement->bindvalue(":id",$post_id);
        $statement->execute();
        $res=$statement->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['boardposts']=$res;
      }


    public static function returnPosts($statement, $rows){
        include_once('../emptyStates.php');
        $results=[];
        if ($rows > 0) {
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
                            <div class="boardPin">
                              <form class="pin"  method="post" ?>
                                <button class="btn-pin" type="submit" name="pinned_post" value=<?php echo $res->id ?>><span class="glyphicon glyphicon-pushpin"></span></button>
                                <select name="selected_board" id=selected_board>
                                  <<option selected>Select a board</option>
                                  <?php $board = new board;
                                        $board->loadBoard();
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
                    <?php $value = ob_get_contents();
                    ob_get_clean();
                    array_push($results,$value);
                }
            }

        } else {
            shuffle($emptyStates);
            $value = '<h1 class="emptyState">' . $emptyStates[0] . '</h1>' . "\n" . '<h1 class="emptyStateTxt">Oops, no posts found!</h1><script>$(".LoadMoreBtn").text("No more records!").prop("disabled", true);</script>';
            array_push($results, $value);
        };
        return $results;
    }
}
