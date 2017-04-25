<?php

class Post{
    private $m_iID;
    private $m_sTitle;
    private $m_sImage;
    private $m_sDescription;
    private $m_sLink;
    private $m_iTopicsId;
    private $m_iUserId;
    private $m_iUploadtime;
    private $m_iReports;

    public function __set($p_sProperty, $p_vValue){
        switch ( $p_sProperty ){
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

    public function __get($p_sProperty){
        switch ( $p_sProperty ){
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

    public function savePost(){
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
        }
        catch (PDOException $e) {
           $error = $e->getMessage();
        }

    }

    public function checkLiked($PostId){
      $conn = Db::getInstance();
      $likecheckstatement = $conn->prepare("SELECT * FROM `likes` WHERE UserId = :userid AND PostId = :postid");
      $likecheckstatement->bindValue(":userid", $_SESSION['userid']);
      $likecheckstatement->bindValue(":postid", $PostId);
      $likecheckstatement->execute();
      $likes = $likecheckstatement->fetch(PDO::FETCH_ASSOC);
      if (empty($likes)) {
        return false;
      }
      else {
        return true;
      }
    }

    public function countlikes($PostId){
      $conn = Db::getInstance();
      $likecheckstatement = $conn->prepare("SELECT * FROM `likes` WHERE PostId = :postid");
      $likecheckstatement->bindValue(":postid", $PostId);
      $likecheckstatement->execute();
      $rows = $likecheckstatement->rowCount();
      echo $rows;
    }

    public function reportPost(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("UPDATE posts SET reports = reports + 1 WHERE id = :id");
        $statement->bindValue(":id", $this->m_iID);
        $statement->execute();
    }

    public function deletePost(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("DELETE from posts WHERE id = :id");
        $statement->bindValue(":id", $this->m_iID);
        $statement->execute();
    }
}
