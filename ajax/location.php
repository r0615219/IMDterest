<?php
<<<<<<< HEAD
    session_start();
    include_once('../classes/Post.php');
    $location = $_POST['varLocation'];
    $locationPost = new Post();
    $locationPost->getPostsViaTopic($location);
    //$locationPost->location = $location;
    //$locationPost->printLocation($location);
    //echo 'Locatie : '.$location;
=======
session_start();
include_once('../classes/Post.php');
$location = $_POST['varLocation'];
$locationPost = new Post();
//$locationPost->location = $location;
//$locationPost->printLocation($location);
echo 'De locatie is'.$location;
>>>>>>> a517b75b373d2f78e319cdbcfbe190f1d938e549
