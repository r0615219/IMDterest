<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".php");
});?>
<?php include_once('header.inc.php'); ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/signup-style.css">
    <link rel="stylesheet" href="css/profile.css">

    <link href="https://fonts.googleapis.com/css?family=Nova+Oval" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/npm.js"></script>
    <script src="js/userDetails.js"></script>

    <title>IMDterest | Boards</title>
    </head>
    <body>
      <div class="Boards">
        <?php
        if (!empty($_POST['board_name'])){
          $board = new board;
          $board->subject = $_POST['board_name'];
          $board->saveBoard();


     }?>

      </div>
      <form id="createboard" class="create-board add" method="post">
        <label for="subject">Subject of your board?</label>
        <input type="text" name="board_name" id="board_name">
        <button type="submit" class="btn btn-success addBtn" name="boardsubmit">Create a board!</button>
      </form>
    </body>
