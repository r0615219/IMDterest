<?php
session_start();
/*spl_autoload_register(function ($class) {
    include_once("../classes/" . $class . ".php");
});*/
include_once("classes/board.php");
include_once("classes/Comment.php");
include_once("classes/Db.php");
include_once("classes/Post.php");
include_once("classes/Search.php");
include_once("classes/Topics.php");
include_once("classes/User.php");

if (!empty($_POST['comment'])) {
    echo "SHIT";
}
