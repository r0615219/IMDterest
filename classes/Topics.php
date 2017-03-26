<?php

class Topics{
    private $m_sName;
    private $m_sImage;

    public function __set($p_sProperty, $p_vValue){
        switch ( $p_sProperty ){
            case 'Name':
                $this->m_sName = $p_vValue;
                break;

            case 'Image':
                $this->m_sImage = $p_vValue;
                break;
        }
    }

    public function __get($p_sProperty){
        switch ( $p_sProperty ){
            case 'Name':
                return $this->m_sName;
                break;

            case 'Image':
                return $this->m_sImage;
                break;
        }
    }

    public function getTopic($p_iId){
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM `topics` WHERE id = :id");
        $statement->bindValue(":id", $p_iId);
        $statement->execute();
        $res = $statement->fetch(PDO::FETCH_ASSOC);
        $this->m_sName = $res['name'];
        $this->m_sImage = $res['image'];
    }
}