<?php
    header ('Content-Type: application/json');
    
    include_once('../classes/Db.php');
	include_once('../classes/User.php');

if(!empty($_POST) ){
    $user = new User();
    
    if ($user->Follow==true) {
        //if follow == true, verwijder follow record uit tabel follows
    }
    
    if ($user->Follow==false) {
        //if follow == false, voeg follow record toe aan tabel follows 
    }
    
    //echo json_encode($feedback);
}