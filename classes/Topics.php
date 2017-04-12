<?php

class Topics{
    private $m_iID;
    private $m_sName;
    private $m_sImage;

    public function __set($p_sProperty, $p_vValue){
        switch ( $p_sProperty ){
            case 'id':
                $this->m_iID = $p_vValue;
                break;
            case 'name':
                $this->m_sName = $p_vValue;
                break;

            case 'image':
                $this->m_sImage = $p_vValue;
                break;
        }
    }

    public function __get($p_sProperty){
        switch ( $p_sProperty ){
            case 'id':
                return $this->m_iID;
                break;
            case 'name':
                return $this->m_sName;
                break;

            case 'image':
                return $this->m_sImage;
                break;
        }
    }

    public function getTopic(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM `topics` WHERE id = :id");
        $statement->bindValue(":id", $this->m_iID);
        $statement->execute();
        $res = $statement->fetch(PDO::FETCH_ASSOC);
        $this->m_sName = $res['name'];
        $this->m_sImage = $res['image'];
    }

    //functie om een nieuw aangemaakte topic op te slaan
    public function saveTopic(){}

    //functie om topic aan user te koppelen
    public function saveUserTopic(){
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO `users_topics` (`users_ID`, `topics_ID`) VALUES (:userID, :topicsID);");
        $statement->bindValue(":userID", $_SESSION['userID']);
        $statement->bindValue(":topicsID", $this->m_iID);
        $result = $statement->execute();
    }
}