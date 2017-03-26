<?php

    class User {
        private $m_sEmail;
        private $m_sFullname;
        private $m_sUsername;
        private $m_sPassword;
        private $m_sImage;
        private $m_aTopics=[];

        public function __set($p_sProperty, $p_vValue){
            switch ( $p_sProperty ){
                case "Email":
                    /*if(empty($p_vValue)){
                        throw new Exception ('E-mail cannot be empty.');
                    }*/
                    $this->m_sEmail = $p_vValue;
                    break;
                case "Fullname":
                    $this->m_sFullname = $p_vValue;
                    break;
                case "Username":
                    $this->m_sUsername = $p_vValue;
                    break;
                case "Password":
                    $this->m_sPassword = $p_vValue;
                    break;
                case "Image":
                    $this->m_sImage = $p_vValue;
                    break;
                case "Topics":
                    array_push($this->m_aTopics, $p_vValue);
                    break;
            }

        }

        public function __get($p_sProperty){
            switch($p_sProperty){
                case "Email":
                    return $this->m_sEmail;
                    break;
                case "Fullname":
                    return $this->m_sFullname;
                    break;
                case "Username":
                    return $this->m_sUsername;
                    break;
                case "Password":
                    return $this->m_sPassword;
                    break;
                case "Image":
                    return $this->m_sImage;
                    break;
                case "Topics":
                    return $this->m_aTopics;
            }
        }

        public function Register(){

            $options = [
                'cost' => 12,
            ];
            $this->m_sPassword = password_hash( $this->m_sPassword, PASSWORD_DEFAULT, $options );

            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO users (`email`, `fullname`, `username`, `password`, `image`) VALUES (:email, :fullname, :username, :password, :image);");
            $statement->bindValue(":email", $this->m_sEmail);
            $statement->bindValue(":fullname", $this->m_sFullname);
            $statement->bindValue(":username", $this->m_sUsername);
            $statement->bindValue(":password", $this->m_sPassword);
            $statement->bindValue(":image", $this->m_sImage);
            $result = $statement->execute();
            return $result;
        }
        
        public function CanLogin(){ //checken of we mogen inloggen
            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM `users` WHERE (username = :username)");
            $statement->bindValue(":username", $this->m_sUsername);
            $statement->execute();
            $res = $statement->fetch(PDO::FETCH_ASSOC);
            $password = $res["password"];
            if(password_verify($this->m_sPassword, $password)){
                return true;
            } else {
                throw new exception("Failed to sign in. Wrong password or username.");
            }
        }
        
        public function HandleLogin() { //inloggen
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare("SELECT * FROM `users` WHERE (username = :username)");
                $statement->bindValue(":username", $this->m_sUsername);
                $statement->execute();
                $res = $statement->fetch(PDO::FETCH_ASSOC);
                $fullname = $res["fullname"];
                $email = $res["email"];
                $image = $res["image"];
                session_start();
                $_SESSION['user'] = $this->m_sUsername;
                $_SESSION['fullname'] = $fullname;
                $_SESSION['email'] = $email;
                $_SESSION['image'] = $image;

                $statement = $conn->prepare("SELECT * FROM `users_topics` WHERE users_ID in (SELECT id from users where username = :username)");
                $statement->bindValue(":username", $this->m_sUsername);
                $statement->execute();
                $res = $statement->fetchAll(PDO::FETCH_ASSOC);
                $topics = [];
                array_push($topics, $res['topics_ID']);
                $_SESSION['topics'] = $topics;

                header('Location: home.php');
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }



        public function updateDatabase(){

            try {
                $conn = Db::getInstance();
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $conn->prepare("UPDATE users SET fullname = :fullname, username = :username, email = :email, password = :password where username = :oldUsername");
                $statement->bindValue(":fullname", $this->m_sFullname);
                $statement->bindValue(":username", $this->m_sUsername);
                $statement->bindValue(":email", $this->m_sEmail);


                if ($this->m_sPassword != '') {
                    $options = [
                        'cost' => 12,
                    ];
                    $this->m_sPassword = password_hash($this->m_sPassword, PASSWORD_DEFAULT, $options);
                    $statement->bindValue(":password", $this->m_sPassword);

                } else {

                    //todo: HELP HELP HELP WERKT NIET -> geeft leeg wachtwoord in
                    $stmt = $conn->prepare("SELECT * FROM `users` WHERE (username = :username)");
                    $stmt->bindValue(":username", $this->m_sUsername);
                    $stmt->execute();
                    $res = $stmt->fetch(PDO::FETCH_ASSOC);
                    $password = $res["password"];
                    $statement->bindValue(":password", $password);
                }


                $statement->bindValue(":oldUsername", $_SESSION['user']);
                $statement->execute();
                $_SESSION['user']=$this->m_sUsername;
                $_SESSION['fullname']=$this->m_sFullname;
                $_SESSION['email']=$this->m_sEmail;
                $_SESSION['image']=$this->m_sImage;
                echo $statement->rowCount() . " records UPDATED successfully";
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }

            $conn = null;
        }

        public function addTopic(){}
    }


