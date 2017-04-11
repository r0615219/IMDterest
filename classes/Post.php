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

            case 'topicsId':
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

            case 'topicsId':
                return $this->m_iTopicsId;
                break;
        }
    }

    public function save(){
        $conn = Db::getInstance();
        //id van user ophalen en in $res1 steken
        $statement1 = $conn->prepare("SELECT id FROM `users` WHERE email = :email");
        $statement1->bindValue(":email", $_SESSION['user']);
        $statement1->execute();
        $res1 = $statement1->fetch(PDO::FETCH_ASSOC);
        $userID = $res1["id"];

        $statement = $conn->prepare("INSERT INTO `posts` (`user_ID`, `image`, `description`, `link`, `topics_ID`) VALUES (:user_ID :image, :description, :link, :topicsID);");
        $statement->bindValue(":user_ID", $userID);
        $statement->bindValue(":image", $this->m_sImage);
        $statement->bindValue(":description", $this->m_sDescription);
        $statement->bindValue(":link", $this->m_sLink);
        $statement->bindValue(":topicsID", $this->m_iTopicsId);
        $statement->execute();
    }
}