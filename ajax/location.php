<?php
    session_start();
    include_once('../classes/Post.php');
    $location = $_POST['varLocation'];
    $locationPost = new Post();
    $locationPost->getPostsViaTopic($location);
    //$locationPost->location = $location;
    //$locationPost->printLocation($location);
    //echo 'Locatie : '.$location;
