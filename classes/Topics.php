<?php
session_start();

class Topics
{
    private $m_iID;
    private $m_sName;
    private $m_sImage;

    public function __set($p_sProperty, $p_vValue)
    {
        switch ($p_sProperty) {
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

    public function __get($p_sProperty)
    {
        switch ($p_sProperty) {
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

    public function getTopic()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM `topics` WHERE id = :id");
        $statement->bindValue(":id", $this->m_iID);
        $statement->execute();
        $res = $statement->fetch(PDO::FETCH_ASSOC);
        $this->m_sName = $res['name'];
        $this->m_sImage = $res['image'];
    }

    public static function chooseTopics()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT t.id, t.name, t.image FROM topics t INNER JOIN users_topics ut ON t.id = ut.topics_ID GROUP BY ut.topics_ID ORDER BY count(ut.topics_ID) DESC LIMIT 5;");
        $statement->execute();
        $rows = $statement->rowCount();
        if ($rows > 0) {
            while ($topic = $statement->fetch(PDO::FETCH_OBJ)) {
                $_SESSION['chooseTopics'][] = $topic;
            }
        } else {
            $statement = $conn->prepare("SELECT * FROM topics LIMIT 5");
            $statement->execute();
            while ($topic = $statement->fetch(PDO::FETCH_OBJ)) {
                $_SESSION['chooseTopics'][] = $topic;
            }
        }
    }

    public function getTopicViaName()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM `topics` WHERE name = :name");
        $statement->bindValue(":name", $this->m_sName);
        $statement->execute();
        $res = $statement->fetch(PDO::FETCH_ASSOC);
        $this->m_iID = $res['id'];
        $this->m_sImage = $res['image'];
        $this->m_sName = $res['name'];
    }

    /*public function getPostsViaTopic()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM `posts` WHERE `topics_ID` = (:topicsid)");
        $statement->bindValue(":topicsid", $this->m_iID);
        $statement->execute();
        $result = $statement->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['posts-topic'] = $result;
    }*/

    //functie om een nieuw aangemaakte topic op te slaan
    public function saveTopic()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO `topics`(`name`, `image`) VALUES (:name, :image);");
        $statement->bindValue(":name", $this->m_sName);
        $statement->bindValue(":image", $this->m_sImage);
        $statement->execute();
    }

    //functie om topic aan user te koppelen
    public function saveUserTopic()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("INSERT INTO `users_topics` (`users_ID`, `topics_ID`) VALUES (:userID, :topicsID);");
        $statement->bindValue(":userID", $_SESSION['userid']);
        $statement->bindValue(":topicsID", $this->m_iID);
        $statement->execute();
    }

    public function checkAvailability()
    {
        $conn = Db::getInstance();
        $statement = $conn->prepare("SELECT * FROM `topics`");
        $statement->execute();
        while ($res = $statement->fetch(PDO::FETCH_OBJ)) {
            if ($res->name == $this->name) {
                $this->id = $res->id;
                return 'match';
            }
        }
        return 'no match';
    }
}
