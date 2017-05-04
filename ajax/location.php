<?php
    session_start();
    include_once('../classes/Post.php');

    $location = $_POST['varLocation'];
    echo $location;
