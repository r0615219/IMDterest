<?php
session_start();
spl_autoload_register(function ($class) {
    include_once("../classes/" . $class . ".php");
});
//include_once('../emptyStates.php');

//sanitize post value
$page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
$query = $_POST["query"];
//throw HTTP error if page number is not valid
if (!is_numeric($page_number)) {
    header('HTTP/1.1 500 Invalid page number!');
    exit();
}

//get current starting point of records
$position = (($page_number - 1) * 20);
$limit = 20;
//fetch records using page position and item per page.
$conn = Db::getInstance();
//$query = "SELECT * FROM posts ORDER BY id DESC LIMIT :position, :limit";
$statement = $conn->prepare($query);

$statement->bindValue(":position", $position, PDO::PARAM_INT);
$statement->bindValue(":limit", $limit, PDO::PARAM_INT);
$statement->bindValue(":email", $_SESSION['user']);
$statement->execute(); //Execute prepared Query

//output results from database
$rows = $statement->rowCount();
$res = Post::returnPosts($statement, $rows);
foreach($res as $r){
    echo $r;
}

echo '<script src="js/likebutton.js"></script>';
echo '<script src="js/comment-btn.js"></script>';
echo '<script src="js/likebutton.js"></script>'
?>
