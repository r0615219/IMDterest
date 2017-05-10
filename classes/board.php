<?php

class board
{
    private $m_iID;
    private $m_sSubject;
    private $m_iUserId;
    private $m_sVisibility;

    public function __set($p_sProperty, $p_vValue)
    {
        switch ($p_sProperty) {
            case 'id':
                $this->m_iID = $p_vValue;
                break;

            case 'subject':
                $this->m_sSubject = $p_vValue;
                break;

            case 'user_id':
                $this->$m_iUserId = $p_vValue;
                break;

            case 'visibility':
                $this->$m_sVisibility = $p_vValue;
                break;
        }
    }

    public function __get($p_sProperty)
    {
        switch ($p_sProperty) {
            case 'id':
                return $this->m_iID;
                break;

            case 'subject':
                return $this->m_sSubject;
                break;

            case 'user_id':
                return $this->$m_iUserId;
                break;

            case 'visibility':
                return $this->$m_sVisibility;
                break;
        }
    }

    public function saveBoard()
    {
        $conn = Db::getInstance();
        $addboard = $conn->prepare("INSERT INTO boards (`subject`, `user_id`, `visibility`) VALUES (:subject,:user_id,:visibility)");
        $addboard->bindValue(":subject", $_POST['board_name']);
        $addboard->bindValue(":user_id", $_SESSION['userid']);
        $addboard->bindValue(":visibility", $_POST['visibility']);
        $addboard->execute();
    }

    public function loadBoard()
    {
        $conn = Db::getInstance();
        $loadboard = $conn->prepare("SELECT * FROM boards WHERE `user_id` = :user_id OR `visibility` = 'yes'");
        $loadboard->bindValue(":user_id", $_SESSION['userid']);
        $loadboard->execute();
        $res = $loadboard->fetchall(PDO::FETCH_ASSOC);
        $_SESSION['boards'] = $res;
    }

    public function loadMyBoard()
    {
        $conn = Db::getInstance();
        $loadboard = $conn->prepare("SELECT * FROM boards WHERE `user_id` = :user_id");
        $loadboard->bindValue(":user_id", $_SESSION['userid']);
        $loadboard->execute();
        $res = $loadboard->fetchall(PDO::FETCH_ASSOC);
        echo "\nPDO::errorInfo():\n";
        //print_r($loadboard->errorInfo());
        $_SESSION['boards'] = $res;
    }

}
