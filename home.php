<?php

    session_start();
    spl_autoload_register(function ($class) {
        include_once("classes/" . $class . ".php");
    });
    //stuur de gebruiker weg als ze niet zijn ingelogd
    if (isset($_SESSION['user'])) {
    } else {
        header('Location: signin.php');
    }

//TOPICS
try {
    //1. kijken of gebruiker nog geen topics heeft
    if (!isset($_SESSION['topics'])) {
        //2. indien JA: 5 topics die het meeste voorkomen in user_topics tabel uitlezen als object
        $topicArray = [];
        $conn = Db::getInstance();
        //normaal in 1 statement maar dit wordt niet ondersteund -> in 2 gesplitst
        $statement1 = $conn->prepare("SELECT topics_ID FROM `users_topics` GROUP BY topics_ID ORDER BY count(*) DESC LIMIT 5");
        $statement1->execute();
        while ($res = $statement1->fetch(PDO::FETCH_ASSOC)) {
            $id = $res['topics_ID'];
            $statement2 = $conn->prepare("SELECT * from `topics` where id = :id");
            $statement2->bindValue(":id", (int)$id);
            $statement2->execute();
            $topic = $statement2->fetch(PDO::FETCH_OBJ);
            //3. topics in array steken
            $topicArray[] = $topic;
        }
    }

//4. ZIE chooseTopics.php !!

//5. indien topics gekozen -> topics in databank steken
    if (isset($_POST['selectedTopics'])) {
        $selectedTopics = $_POST['selectedTopics'];
        for ($i = 0; $i < count($selectedTopics); $i++) {
            $usertopic = new Topics();
            $usertopic->id = $selectedTopics[$i];
            $usertopic->saveUserTopic();
        }
        //6. alle topics van user in session steken
        $user = new User;
        $user->Email = $_SESSION['user'];
        $user->getUserTopics();
    }


//7. ZIE userHome.php !!
} catch (Exception $e) {
    $error= $e->getMessage();
}


// post verwerking

try {
    if (isset($_POST['imgSubmit'])) {

        $title = $_POST['title'];

        if($_POST['imgTopic'] == 'none'){ //indien select niet geselecteerd is
            //nieuwe topic opslaan
            $newTopic = new Topics;
            $newTopic->name = $_POST['addTopic'];
            $newTopic->image = strtolower($_FILES['img']['name']);
            $newTopic->getTopicViaName();
            if($newTopic->name = $_POST['addTopic']){ //kijken of de topic al bestaat
                $topicsId = $newTopic->id;
            }else{
                $newTopic->saveTopic();
                //topicId van nieuwe topic ophalen
                $newTopic->getTopicViaName();
                $topicsId = $newTopic->id;
            }
        } else {
            $topicId = $_POST['imgTopic'];
        }

        $description = $_POST['imgDescription'];
        $post = new Post;
        $post->title = $title;
        $post->description = $description;
        $post->uploadtime = time(); //timestamp
        $post->topics_ID = (int)$topicsId;

        if (isset($_FILES['img'])) {
            $bestandsnaam = strtolower($_FILES['img']['name']);

            if (strpos($bestandsnaam, ".png")) {
                move_uploaded_file($_FILES["img"]["tmp_name"],
                    "images/uploads/postImages/" . $post->title . $_SESSION['userid'] . $post->uploadtime . ".png");
                $post->image = $post->title . $_SESSION['userid'] . $post->uploadtime . ".png";
            } elseif (strpos($bestandsnaam, ".jpg")) {
                move_uploaded_file($_FILES["img"]["tmp_name"],
                    "images/uploads/postImages/" . $post->title . $_SESSION['userid'] . $post->uploadtime . ".jpg");
                $post->image = $post->title . $_SESSION['userid'] . $post->uploadtime . ".jpg";
            } elseif (strpos($bestandsnaam, ".gif")) {
                move_uploaded_file($_FILES["img"]["tmp_name"],
                    "images/uploads/postImages/" . $post->title . $_SESSION['userid'] . $post->uploadtime . ".gif");
                $post->image = $post->title . $_SESSION['userid'] . $post->uploadtime . ".gif";
            } else {
                throw new exception("Unable to create post. The uploaded image must be a JPEG, PNG or GIF.");
            }
        } else {
            $post->image = "profile_placeholder.png";
        }

        $post->link = "";
        $post ->savePost();
        $user = new User;
        $user->Email = $_SESSION['user'];
        $user->getUserPosts();
    }
} catch (Exception $e) {
    $error = $e->getMessage();
}

if (isset($_POST['linkSubmit'])) {
    $topicsId = $_POST['linkTopic'];
    $description = $_POST['linkDescription'];
    $link = $_POST['link'];



    $post = new Post;
    $post->description = $description;
    $post->topics_ID = (int)$topicsId;
    $post->link = $link;
    $post->image = $link;
    $post->title = $title;
    $post ->savePost();

    $user = new User;
    $user->Email = $_SESSION['user'];
    $user->getUserPosts();
}

if (isset($_POST['report'])) {
    $post = new Post;
    $post->id = $_POST['report'];
    $post->reportPost();
}

if (isset($_POST['delete'])) {
    $post = new Post;
    $post->id = $_POST['delete'];
    $post->deletePost();
}

////COMMENTS/////

if (!empty($_POST['comment'])) {
  $comment = new Comment;
  $comment->comment =$_POST['comment'];
  $comment->user_id = 1;
  $comment->post_id = $post.post_id;
}

?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/add-btn.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/npm.js"></script>
<script src="js/likebutton.js"></script>

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
    <link rel="stylesheet" href="css/add-button.css">
    <link rel="stylesheet" href="css/posts.css">

    <link href="https://fonts.googleapis.com/css?family=Nova+Oval" rel="stylesheet">

    <title>IMDterest | Home</title>
</head>
<body>

<?php include_once('header.inc.php'); ?>
<div class="container">
<?php if(isset($error)){
    echo "<p class='alert alert-danger'>$error</p>";
}?>
    <?php

    if (isset($_SESSION['topics'])) {
        include_once('userHome.php');
    } else {
        include_once('chooseTopics.php');
    }

    ?>

</div>
</body>
</html>
