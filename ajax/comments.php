<?php

session_start();

include_once("../classes/Db.php");

include_once("../classes/Comment.php");

$postid=htmlspecialchars($_POST['postid']);

$comment=htmlspecialchars($_POST['comment']);

$userid=$_SESSION['userid'];



$c = new Imdterest\Comment;

$c->post_id=$postid;

$c->comment=$comment;

$c->user_id=$userid;



//Ajax update on submit



$c->saveComment();

echo $c->comment;
