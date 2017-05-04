<?php
session_start();

spl_autoload_register(function ($class) {

    include_once("classes/" . $class . ".php");

});

//stuur de gebruiker weg als ze niet zijn ingelogd

if (!isset($_SESSION['user'])) {

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

            $statement2 = $conn->prepare("SELECT * FROM `topics` WHERE id = :id");

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

    $error = $e->getMessage();

}





// post verwerking



try {

    if (isset($_POST['imgSubmit'])) {

        $title = $_POST['title'];

        $description = $_POST['imgDescription'];

        var_dump($title);



        $post = new Post;

        $post->title = $title;

        $post->description = $description;

        $post->time = time(); //timestamp

        var_dump($post->time);





        if (isset($_FILES['img'])) {

            $bestandsnaam = strtolower($_FILES['img']['name']);



            if (strpos($bestandsnaam, ".png")) {

                move_uploaded_file($_FILES["img"]["tmp_name"], str_replace(' ', '%20',

                    "images/uploads/postImages/" . $post->title . $_SESSION['userid'] . $post->uploadtime . ".png"));

                $post->image = str_replace(' ', '%20', $post->title . $_SESSION['userid'] . $post->uploadtime . ".png");

            } elseif (strpos($bestandsnaam, ".jpg")) {

                move_uploaded_file($_FILES["img"]["tmp_name"], str_replace(' ', '%20',

                    "images/uploads/postImages/" . $post->title . $_SESSION['userid'] . $post->uploadtime . ".jpg"));

                $post->image = str_replace(' ', '%20', $post->title . $_SESSION['userid'] . $post->uploadtime . ".jpg");

            } elseif (strpos($bestandsnaam, ".gif")) {

                move_uploaded_file($_FILES["img"]["tmp_name"], str_replace(' ', '%20',

                    "images/uploads/postImages/" . $post->title . $_SESSION['userid'] . $post->uploadtime . ".gif"));

                $post->image = str_replace(' ', '%20', $post->title . $_SESSION['userid'] . $post->uploadtime . ".gif");

            } else {

                throw new exception("Unable to create post. The uploaded image must be a JPEG, PNG or GIF.");

            }

        } else {

            $post->image = "profile_placeholder.png";

        }



        if ($_POST['imgTopic'] == 'none') { //indien select niet geselecteerd is

            //nieuwe topic opslaan

            $newTopic = new Topics;

            $newTopic->name = $_POST['addTopic'];

            $newTopic->image = str_replace(' ', '%20', strtolower($_FILES['img']['name']));



            if ($newTopic->checkAvailability() == 'match') {

                $topicsId = $newTopic->id;

            } else {

                $newTopic->image = $post->image;

                $newTopic->saveTopic();

                //topicId van nieuwe topic ophalen

                $newTopic->getTopicViaName();

                $topicsId = $newTopic->id;

            }



            $newTopic->saveUserTopic();

            array_push($_SESSION['topics'], $newTopic);

        } else {

            $topicsId = $_POST['imgTopic'];

        }



        $post->topics_ID = (int)$topicsId;

        $post->link = "";

        $post->savePost();

        $user = new User;

        $user->Email = $_SESSION['user'];

        $user->getUserPosts();



    }

} catch (Exception $e) {

    $error = $e->getMessage();

}



if (isset($_POST['linkSubmit'])) {

    $post = new Post;



    $link = $_POST['url'];

    $title = '';

    $image = '';

    $description = '';

    if (strpos($link, 'https://') === false || strpos($link, 'http://') === false) {

        $link = 'http://' . $link;

    }



    $html = file_get_contents($link); //get the html returned from the following url

    $doc = new DOMDocument();

    libxml_use_internal_errors(TRUE); //disable libxml errors



    if (!empty($html)) { //if any html is actually returned

        $doc->loadHTML($html);

        libxml_clear_errors(); //remove errors for yucky html

        $xpath = new DOMXPath($doc);



//get site's title

        $nodeTitle = $xpath->query('//title');

        $title = $nodeTitle[0]->nodeValue;



//get description

        if (array_key_exists('description', get_meta_tags($link))) {

            $description = get_meta_tags($link)['description'];

        } else {

            $description = $title;

        }



//get all found images

        $nodeImage = $doc->getElementsByTagName('img');

        for ($i = 0; $i <= count($nodeImage); $i++) {

            if ($nodeImage[$i]->getAttribute('src') != '') {

                $image = $nodeImage[$i]->getAttribute('src');

                if (strpos($nodeImage[$i]->getAttribute('src'), '../') === true) {

                    $image = str_replace("../", "/", $nodeImage[$i]->getAttribute('src'));

                }

                if (strpos($nodeImage[$i]->getAttribute('src'), 'http') === false) {

                    $image = $link.$image;

                }

                $image = str_replace(' ', '%20', $image);

                break;



            }

        }



        if ($_POST['linkTopic'] == 'none') { //indien select niet geselecteerd is

//nieuwe topic opslaan

            $newTopic = new Topics;

            $newTopic->name = $_POST['addTopic'];

            $newTopic->image = $image;



            if ($newTopic->checkAvailability() == 'match') {

                $topicsId = $newTopic->id;

            } else {

                $newTopic->saveTopic();

//topicId van nieuwe topic ophalen

                $newTopic->getTopicViaName();

                $topicsId = $newTopic->id;

            }



            $newTopic->saveUserTopic();

            array_push($_SESSION['topics'], $newTopic);

        } else {

            $topicsId = $_POST['linkTopic'];

        }



        $post->time = time(); //timestamp

        $post->description = $description;

        $post->topics_ID = (int)$topicsId;

        $post->link = $link;

        $post->image = $image;

        $post->title = $title;

        $post->savePost();



        $user = new User;

        $user->Email = $_SESSION['user'];

        $user->getUserPosts();

    }

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

  $comment = new comment;

  $comment->comment = $_POST['comment'];

  $comment->post_id = $_POST['post_id'];

  $comment->saveComment();

}


////BOARDS////
if(isset($_POST['pinned_post'])){
  if(!empty($_POST['selected_board'])){
  $post = new Post;
//  echo $_POST['selected_board'];
  $post->id = $_POST['pinned_post'];
  $board_id = $_POST['selected_board'];
  $post->saveToBoard($board_id);

  }
}

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

    <link rel="stylesheet" href="css/topics.css">

    <link rel="stylesheet" href="css/add-button.css">

    <link rel="stylesheet" href="css/posts.css">



    <link href="https://fonts.googleapis.com/css?family=Nova+Oval" rel="stylesheet">


<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>

<script src="js/bootstrap.min.js"></script>

<script src="js/add-btn.js"></script>

<script src="js/npm.js"></script>

<script src="js/likebutton.js"></script>

<script src="js/loadMore.js"></script>

<script src="js/comment-btn.js"></script>

<script src="js/location.js"></script>

<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>




    <title>IMDterest | Home</title>

</head>

<body>



<?php

$page = 'home';

include_once('header.inc.php'); ?>

<div class="container">

    <?php if (isset($error)) {

        echo "<p class='alert alert-danger'>$error</p>";

    } ?>

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

