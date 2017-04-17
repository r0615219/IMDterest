<?php

class Post{
    private $m_iID;
    private $m_sImage;
    private $m_sDescription;
    private $m_sLink;
    private $m_iTopicsId;

    public function __set($p_sProperty, $p_vValue){
        switch ( $p_sProperty ){
            case 'id':
                $this->m_iID = $p_vValue;
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
        }
    }

    public function __get($p_sProperty){
        switch ( $p_sProperty ){
            case 'id':
                return $this->m_iID;
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
        }
    }

    public function savePost(){
        try {
            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO `posts` (`user_ID`, `image`, `description`, `link`, `topics_ID`) VALUES (:user_ID, :image, :description, :link, :topics_ID);");
            $statement->bindValue(":user_ID", $_SESSION['userid']);
            $statement->bindValue(":image", $this->m_sImage);
            $statement->bindValue(":description", $this->m_sDescription);
            $statement->bindValue(":link", $this->m_sLink);
            $statement->bindValue(":topics_ID", $this->m_iTopicsId);
            $statement->execute();
            $arr = $statement->errorInfo();
            print_r($arr);

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

}
