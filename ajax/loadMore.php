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
$position = (($page_number) * 20);
$limit = 20;

//fetch records using page position and item per page.
$conn = Db::getInstance();
$statement = $conn->prepare($query);
$statement->bindValue(":position", $position, PDO::PARAM_INT);
$statement->bindValue(":limit", $limit, PDO::PARAM_INT);
$statement->bindValue(":userid", $_SESSION['userid']);
$statement->execute(); //Execute prepared Query

//output results from database
$rows = $statement->rowCount();
/*print_r('QUERY: ' . $query);
print_r('POSITION: ' . $position);
print_r('LIMIT: ' . $limit);
print_r('USER ID: ' . $_SESSION['userid']);
print_r('GEVONDEN RIJEN: ' . $rows);*/
if ($rows > 0) {
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach ($result as $res) {
        if ($res['reports'] < 3) {
            //fetch values
            include("../postTemplate.php");
        }
    }
} else {
    include_once('../emptyStateMessage.php');
};

echo '<script src="js/likebutton.js"></script>';
echo '<script src="js/comment-btn.js"></script>';
