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
    private $m_sLocation;
    private $m_iPrivacy;

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

            case 'time':
                $this->m_iUploadtime = $p_vValue;
                break;

            case 'reports':
                $this->m_iReports = $p_vValue;
                break;

            case 'location':
                $this->m_sLocation = $p_vValue;
                break;

            case 'privacy':
                $this->m_iPrivacy = $p_vValue;
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

            case 'time':
                return $this->m_iUploadtime;
                break;

            case 'reports':
                return $this->m_iReports;
                break;

            case 'location':
                return $this->m_sLocation;
                break;

            case 'privacy':
                return $this->m_iPrivacy;
                break;
        }
    }

    public function savePost()
    {
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO `posts`(`user_ID`, `title`, `image`, `description`, `link`, `topics_ID`, `time`, `location`, `privacy`) VALUES (:user_ID, :title, :image, :description, :link, :topics_ID, :time, :location, :privacy);");
            $statement->bindValue(":user_ID", $_SESSION['userid']);
            $statement->bindValue(":title", $this->m_sTitle);
            $statement->bindValue(":image", $this->m_sImage);
            $statement->bindValue(":description", $this->m_sDescription);
            $statement->bindValue(":link", $this->m_sLink);
            $statement->bindValue(":topics_ID", $this->m_iTopicsId);
            $statement->bindValue(":time", $this->m_iUploadtime);
            $statement->bindValue(":location", $this->m_sLocation);
            $statement->bindValue(":privacy",$this->m_iPrivacy);
            $statement->execute();
            //echo "\nPDO::errorInfo() SAVE POST:\n";
            //print_r($conn->errorInfo());
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
        } else if ($verschil > 60 && $verschil < 120) {
            $return = "Posted 1 minute ago";
        } else if ($verschil > 60 && $verschil < 60 * 60) {
            $x = floor($verschil / 60);
            $return = "Posted " . $x . " minutes ago";
        } else if ($verschil > 60 * 60 && $verschil < 2 * 60 * 60) {
            $return = "Posted 1 hour ago";
        } else if ($verschil > 2 * 60 * 60 && $verschil < 24 * 60 * 60) {
            $x = floor($verschil / 360);
            $return = "Posted " . $x . " hours ago";
        } else if ($verschil > 24 * 60 * 60 && $verschil < 2 * 24 * 60 * 60) {
            $return = "Posted a day ago";
        } else if ($verschil > 24 * 60 * 60 && $verschil < 7 * 24 * 60 * 60) {
            $x = floor($verschil / (24 * 60 * 60));
            $return = "Posted " . $x . " days ago";
        } else if ($verschil > 7 * 24 * 60 * 60 && $verschil < 2 * 7 * 24 * 60 * 60) {
            $return = "Posted a week ago";
        } else if ($verschil > 2 * 7 * 24 * 60 * 60 && $verschil < 30 * 24 * 60 * 60) {
            $x = floor($verschil / (7 * 24 * 60 * 60));
            $return = "Posted " . $x . " weeks ago";
        } else if ($verschil > 30 * 24 * 60 * 60 && $verschil < 2 * 30 * 24 * 60 * 60) {
            $return = "Posted a month ago";
        } else if ($verschil > 2 * 30 * 24 * 60 * 60 && $verschil < 12 * 30 * 24 * 60 * 60) {
            $x = floor($verschil / (30 * 24 * 60 * 60));
            $return = "Posted " . $x . " months ago";
        } else if ($verschil > 365 * 24 * 60 * 60 && $verschil < 372 * 24 * 60 * 60) {
            $return = "Posted a year ago ago";
        } else if ($verschil > 372 * 24 * 60 * 60) {
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
        $statement = $conn->prepare("INSERT INTO post_reports (post_id, user_id) VALUES (:post_id, :user_id)");
        $statement->bindValue(":post_id", $this->m_iID);
        $statement->bindValue(":user_id", $_SESSION['userid']);
        $statement->execute();
        $this->countReports();
    }

    public function countReports(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM post_reports WHERE post_id = :post_id");
        $statement->bindValue(":post_id", $this->m_iID);
        $statement->execute();
        $rows = $statement->rowCount();
        if($rows >= 3){
            $this->deletePost();
        }
    }

    public function deletePost()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("DELETE FROM posts WHERE id = :id");
        //Werkt ni, id meegeven met functie//
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

    public function getPostsViaUser()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM `posts` WHERE `user_ID` = (:userid)");
        $statement->bindValue(":userid", $this->m_iUserId);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['userPosts'] = $result;
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

      public function loadfollowedprofile ($userid){
        $conn = Db::getInstance();
        $statement =$conn->prepare("SELECT * FROM `posts` WHERE `user_ID` = :user_id AND `privacy`IN (0,1)");
        $statement->bindvalue(":user_id",$userid);
        $statement->execute();
        $res=$statement->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['ProfilePost']=$res;
      }

      public function loadprofile ($userid){
        $conn = Db::getInstance();
        $statement =$conn->prepare("SELECT * FROM `posts` WHERE `user_ID` = :user_id AND `privacy`=0");
        $statement->bindvalue(":user_id",$userid);
        $statement->execute();
        $res=$statement->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['ProfilePost']=$res;
      }

      public function changeTitle($title_edit, $post_id){
        $conn = Db::getInstance();
        $statement =$conn->prepare("UPDATE `posts` SET `title`=:title WHERE `id` = :post_id");
        $statement->bindValue(":post_id",$post_id);
        $statement->bindValue(":title",$title_edit);
        $statement->execute();
      }

      public function changeDescription($desc_edit, $post_id){
        $conn = Db::getInstance();
        $statement =$conn->prepare("UPDATE `posts` SET `description`=:desc WHERE `id` = :post_id");
        $statement->bindValue(":post_id",$post_id);
        $statement->bindValue(":desc",$desc_edit);
        $statement->execute();
      }
}
