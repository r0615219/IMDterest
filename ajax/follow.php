<?php
    header ('Content-Type: application/json');
    
    include_once('../classes/Db.php');
	include_once('../classes/User.php');

if(!empty($_POST) ){
    
    //check of follow == true was of niet
    
    //if follow == true, verwijder follow record uit tabel follows
    
    //if follow == false, voeg follow record toe aan tabel follows 
    
    //echo json_encode($feedback);
}