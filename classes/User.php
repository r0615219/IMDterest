<?php

    class User {
        private $m_sEmail;
        private $m_sFirstname;
        private $m_sLastname;
        private $m_sPassword;
        private $m_sImage;
        private $m_aTopics=[];

        public function __set($p_sProperty, $p_vValue){
          if(empty($p_vValue)){
                  throw new Exception ('There are empty fields.');}
            switch ( $p_sProperty ){
                case "Email":
                    $this->m_sEmail = $p_vValue;
                    break;
                case "Firstname":
                    $this->m_sFirstname = $p_vValue;
                    break;
                case "Lastname":
                    $this->m_sLastname = $p_vValue;
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
                case "Firstname":
                    return $this->m_sFirstname;
                    break;
                case "Lastname":
                    return $this->m_sLastname;
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
            if(strlen($this->m_sPassword)<6){
            throw new Exception ('This password is too short!');}
            $this->m_sPassword = password_hash( $this->m_sPassword, PASSWORD_DEFAULT, $options );

            $conn = Db::getInstance();
            $statement = $conn->prepare("INSERT INTO users (`email`, `firstname`, `lastname`, `password`, `image`) VALUES (:email, :firstname, :lastname, :password, :image);");
            $statement->bindValue(":email", $this->m_sEmail);
              $checkduplicate = $conn->prepare("SELECT * FROM `users` WHERE (email =:email)");
              $checkduplicate->bindValue(":email",$this->m_sEmail);
              $checkduplicate->execute();
              $found_duplicates = $checkduplicate->fetch(PDO::FETCH_ASSOC);
              if (!empty($found_duplicates)) {
                echo"oh no";
                throw new Exception("email already registered");}
            $statement->bindValue(":firstname", $this->m_sFirstname);
            $statement->bindValue(":lastname", $this->m_sLastname);
            $statement->bindValue(":password", $this->m_sPassword);
            $statement->bindValue(":image", $this->m_sImage);
            $result = $statement->execute();
            return $result;
        }

        public function CanLogin(){ //checken of we mogen inloggen

            $conn = Db::getInstance();
            $statement = $conn->prepare("SELECT * FROM `users` WHERE (email = :email)");
            $statement->bindValue(":email", $this->m_sEmail);
            $statement->execute();
            $res = $statement->fetch(PDO::FETCH_ASSOC);
            $password = $res["password"];
            if(password_verify($this->m_sPassword, $password)){
                return true;
            } else {
                throw new exception("Failed to sign in. Wrong password or email.");
            }
        }

        public function HandleLogin() { //inloggen
            try {
                $conn = Db::getInstance();
                $statement = $conn->prepare("SELECT * FROM `users` WHERE (email = :email)");
                $statement->bindValue(":email", $this->m_sEmail);
                $statement->execute();
                $res = $statement->fetch(PDO::FETCH_ASSOC);
                $firstname = $res["firstname"];
                $lastname = $res["lastname"];
                $email = $res["email"];
                $image = $res["image"];
                session_start();
                $_SESSION['user'] = $this->m_sFirstname;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['email'] = $email;
                $_SESSION['image'] = $image;

                $statement = $conn->prepare("SELECT * FROM `users_topics` WHERE users_ID in (SELECT id from users where email = :email)");
                $statement->bindValue(":email", $this->m_sEmail);
                $statement->execute();
                $res = $statement->rowCount();
                if($res > 0){
                    $res = $statement->fetchAll(PDO::FETCH_ASSOC);
                    $topics = [];
                    array_push($topics, $res['topics_ID']);
                    $_SESSION['topics'] = $topics;
                }


                header('Location: home.php');
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        }



        public function updateDatabase(){

            try {
                //alles dat in de velden staat wordt heringesteld in de database
                $conn = Db::getInstance();
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $statement = $conn->prepare("UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, password = :password where username = :oldUsername");
                $statement->bindValue(":firstname", $this->m_sFirstname);
                $statement->bindValue(":lastname", $this->m_sLastname);
                $statement->bindValue(":email", $this->m_sEmail);
                
                //PASSWORD:
                if (!empty($_POST['newPassword'])) {
                    // hier zetten we de input als een nieuw gehast wachtwoord in de database
                    if ($_POST['newPassword'] == $_POST['password']) {
                        throw new exception("Unable to change the password. Your new password can't be the same as your current one.");
                    } else if ($_POST['newPassword'] != $_POST['controlPassword']) {
                        throw new exception("Unable to change the password. Your passwords don't match.");
                    } else {
                        //checken of het oude paswoord overeen komt met het huidige
                    $stmt1 = $conn->prepare("SELECT * FROM `users` WHERE (email = :oldemail)");
                    $stmt1->bindValue(":oldemail", $_SESSION['email']);
                    $stmt1->execute();
                    $res = $stmt1->fetch(PDO::FETCH_ASSOC);
                    $controleerpassword = $res["password"];
                    if(password_verify($_POST['password'], $controleerpassword)){
                    //nieuw passwoord in database zetten
                        $options = [
                            'cost' => 12,
                        ];
                        $this->m_sPassword = password_hash($_POST['newPassword'], PASSWORD_DEFAULT, $options);
                        $statement->bindValue(":password", $this->m_sPassword);
                    } else {
                        throw new exception("Unable to change the password. Your current password was wrong.");
                    }
                    }

                } else {

                    //hier wordt het huidige wachtwoord opnieuw in de database geset als de gebruiker geen nieuw wachtwoord heeft ingesteld
                    $stmt2 = $conn->prepare("SELECT * FROM `users` WHERE (email = :oldemail)");
                    $stmt2->bindValue(":oldemail", $_SESSION['email']);
                    $stmt2->execute();
                    $res = $stmt2->fetch(PDO::FETCH_ASSOC);
                    $password = $res["password"];
                    $statement->bindValue(":password", $password);
                }
                
                
                $statement->bindValue(":oldemail", $_SESSION['user']);
                $statement->execute();
                $_SESSION['user']=$this->m_sFirstname;
                $_SESSION['firstname']=$this->m_sFirstname;
                $_SESSION['lastname']=$this->m_sLastname;
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
