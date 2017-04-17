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

        public function zoeken(){
            $conn = Db::getInstance();
            if($this->m_sZoekSelect == 'posts'){
                $statement = $conn->prepare("SELECT * FROM `posts` WHERE `description` LIKE CONCAT('%', :zoekterm ,'%')");
            } elseif ($this->m_sZoekSelect == 'users'){
                $statement = $conn->prepare("SELECT * FROM `users` WHERE `firstname` LIKE CONCAT('%', :zoekterm ,'%')");
            } elseif ($this->m_sZoekSelect == 'topics'){
                $statement = $conn->prepare("SELECT * FROM `topics` WHERE `name` LIKE CONCAT('%', :zoekterm ,'%')");
            }
            $statement->bindValue(":zoekterm", $this->m_sZoekterm);
            $statement->execute();
            $searchResult = $statement->fetchAll(PDO::FETCH_ASSOC);
            $_SESSION['aantalResults'] = $statement->rowCount();
            $_SESSION['search'] = $searchResult;
            $_SESSION['zoekterm'] = $this->m_sZoekterm;
            $_SESSION['zoekselect'] = $this->m_sZoekSelect;


        }

    }