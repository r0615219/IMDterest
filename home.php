<?php
    session_start();
spl_autoload_register(function($class){
    include_once("classes/" . $class . ".php");
});
    //stuur de gebruiker weg als ze niet zijn ingelogd
    if( isset( $_SESSION['user'] ) ){
    }
    else {
        header('Location: signin.php');
    }
$topicArray = [];
$userTopics = [];

// alle topics uit databank halen en in topicArray steken
$conn = Db::getInstance();
$statement = $conn->prepare("SELECT * FROM `topics`");
$statement->execute();
$res = $statement->rowCount();

for($i = 1; $i<$res; $i++){
    $topic = $i;
    $topic = new Topics;
    $topic->getTopic($i);
    array_push($topicArray, $topic);
}

//kijken of de gebruiker topics al heeft.
//indien ja, deze topics is userTopics array steken
if(isset($_SESSION['topics'])){
    foreach($_SESSION['topics'] as $t) {
        $statement = $conn->prepare("SELECT * FROM `topics` where id = :id");
        $statement->bindValue(":id", $t);
        $statement->execute();
        $res = $statement->fetch(PDO::FETCH_ASSOC);
        $topic = new Topics;
        $topic->Name = $res["name"];
        $topic->Image = $res['image'];
        array_push($userTopics, $topic);
    }
}

if (isset($_POST['selectedTopics'])) {
    $selectedTopics = $_POST['selectedTopics'];
    for ($i=0; $i<count($selectedTopics); $i++) {
        $usertopic = new Topics();
        $usertopic->Name = $selectedTopics[$i];
        $usertopic->saveUserTopic();
    }
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/npm.js"></script>

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
    <link rel="stylesheet" href="css/topics.css">

    <link href="https://fonts.googleapis.com/css?family=Nova+Oval" rel="stylesheet">

    <title>IMDterest | Home</title>
</head>
<body>

<?php include_once('header.inc.php'); ?>
<div class="container">

    <?php

    if(isset($_SESSION['topics'])){
        include_once('userHome.php');
    }
    else{
        include_once('chooseTopics.php');
    }

    ?>

</div>

</body>
</html>