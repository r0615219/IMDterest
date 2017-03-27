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
$conn = Db::getInstance();
if(!isset($_SESSION['topics'])){
	echo 'empty';
    $statement = $conn->prepare("SELECT * FROM `topics`");
    $statement->execute();
    $res = $statement->rowCount();

    for($i = 1; $i<$res; $i++){
        $topic = $i;
        $topic = new Topics;
        $topic->getTopic($i);
        array_push($topicArray, $topic);
    }
}
else{
	echo 'full';
    foreach($_SESSION['topics'] as $t) {
        $statement = $conn->prepare("SELECT * FROM `topics` where id = :id");
        $statement->bindValue(":id", $t);
        $statement->execute();
        $res = $statement->fetch(PDO::FETCH_ASSOC);
        $topic = new Topics;
        $topic->Name = $res["name"];
        $topic->Image = $res['image'];
        array_push($topicArray, $topic);
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
    <h1 class="h1">Choose 5 topics to follow</h1>
    <form action="" method="post">
        <div class="btn-group btn-block" data-toggle="buttons">
            <?php
            foreach ($topicArray as $t):?>
                <label class="btn topic-div" style="background-image: url(<?php echo $t->Image; ?>);">
                    <input type="checkbox" autocomplete="off"> <?php echo $t->Name; ?>
                </label>
            <?php endforeach; ?>
        </div>
        <button class="btn btn-success save" type="submit">Save topics</button>
    </form>
</div>


</body>
</html>