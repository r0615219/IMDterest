<?php
session_start();
include_once('../classes/Post.php');
$location = $_POST['varLocation'];
$locationPost = new Post();
//$locationPost->location = $location;
//$locationPost->printLocation($location);
echo 'De locatie is'.$location;