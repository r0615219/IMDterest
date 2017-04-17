<?php

class Search{
    private $m_sZoekterm;
    private $m_sZoekSelect;

    public function __set($p_sProperty, $p_vValue){
        switch ( $p_sProperty ){
            case 'Zoekterm':
                $this->m_sZoekterm = $p_vValue;
                break;
            case 'ZoekSelect':
                $this->m_sZoekSelect = $p_vValue;
                break;
        }
    }

    public function __get($p_sProperty){
        switch ( $p_sProperty ){
            case 'Zoekterm':
                return $this->m_sZoekterm;
                break;
            case 'ZoekSelect':
                return $this->m_sZoekSelect;
                break;
        }
    }

    public function Zoeken(){
        $conn = Db::getInstance();
        if($this->m_sZoekSelect = 'post'){
            $statement = $conn->prepare("SELECT * FROM `posts` WHERE `description` LIKE '%(:zoekterm)%'");
            $statement->bindValue(':zoekterm', $this->m_sZoekterm);
            $statement->execute();
            $searchResult = $statement->fetch(PDO::FETCH_ASSOC);
            //header('Location: search-result.php');
            return $searchResult;
        } else if($this->m_sZoekSelect = 'person'){
            echo "You selected Person";
        } else if($this->m_sZoekSelect = 'topic'){
            echo "You selected Topic";
        }
    }

}