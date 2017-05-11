<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".php");
});?>
<?php
$page='boards';
 include_once('header.inc.php');
 ?><!doctype html>
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
    <link rel="stylesheet" href="css/boards.css">

    <link href="https://fonts.googleapis.com/css?family=Nova+Oval" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/npm.js"></script>
    <script src="js/userDetails.js"></script>

    <title>IMDterest | Boards</title>
    </head>
    <body>

      <div class="boards">
        <?php //Board binnenhalen
          $board = new Board();
          $board->loadBoard();
          $boards=$_SESSION['boards'];
          //print_r($_SESSION['boards']);
      foreach ($boards as $b):?>

          <div class="board userPost">
            <div class="board-title">
            <h2 class="pin_title"> <?php echo($b['subject']); ?></h2> 
            </div>
            <div class="board-pins">
              <?php
              $boardpins = new post;
              $board_id = $b['id'];
              $boardpins->loadToBoard($board_id);
              $boardpins=$_SESSION['boardposts_id'];
              foreach ($boardpins as $p) {
                  $post = new post;
                  $post_id=$p['post_id'];
                //echo $post_id;
                $post->loadPost($post_id);
                  $posts=$_SESSION['boardposts'];
                //print_r($posts);
                foreach ($posts as $p) {
                    //print_r($p);
                echo "<div class='boardPost'>";
                    echo"<p>".$p['title']."<p/>";
                    echo "<img class='board-image' src=./images/uploads/postImages/".$p['image'].">";
                    echo "</div>";
                }
              }

               ?>
            </div>
          </div>

      <?php endforeach; ?>
    </div>



      <?php
      //Board aanmaken
      if (!empty($_POST['board_name'])) {
          $board = new Board();
          $board->subject = $_POST['board_name'];
          $board->saveBoard();
      }?>


      <form id="createboard" class="create-board add" method="post">
        <label for="subject">Subject of your board?</label>
        <input type="text" name="board_name" id="board_name">
        <label for="visibility">Do you want this board to be visible for others?</label>
        <input type="radio" name="visibility" value="yes" checked> Yes
        <input type="radio" name="visibility" value="no"> No
        <button type="submit" class="btn btn-success addBtn" name="boardsubmit">Create a board!</button>
      </form>
    </body>
