<?php

// post verwerking

// VIA IMAGE POSTEN

try {

    if (isset($_POST['imgSubmit'])) {

        if ($_POST['title'] != '') {

            $title = $_POST['title'];

        } else {

            throw new ErrorException("Please fill in a title.");

        }

        if ($_POST['imgDescription'] != '') {

            $description = $_POST['imgDescription'];

        } else {

            throw new ErrorException("Please fill in a description.");

        }



        $post = new Post;

        $post->title = $title;

        $post->description = $description;

        $post->time = time(); //timestamp



        if (isset($_FILES['img'])) {



            if ($_FILES['img']['size'] < 8388608) {

                $bestandsnaam = strtolower($_FILES['img']['name']);



                if (strpos($bestandsnaam, ".png")) {

                    move_uploaded_file($_FILES["img"]["tmp_name"],

                        "images/uploads/postImages/" . str_replace(' ', '', $post->title) . $_SESSION['userid'] . $post->time . ".png");

                    $post->image = str_replace(' ', '', $post->title) . $_SESSION['userid'] . $post->time . ".png";



                } elseif (strpos($bestandsnaam, ".jpg")) {

                    move_uploaded_file($_FILES["img"]["tmp_name"],

                        "images/uploads/postImages/" . str_replace(' ', '', $post->title) . $_SESSION['userid'] . $post->time . ".jpg");

                    $post->image = str_replace(' ', '', $post->title) . $_SESSION['userid'] . $post->time . ".jpg";



                } elseif (strpos($bestandsnaam, ".gif")) {

                    move_uploaded_file($_FILES["img"]["tmp_name"],

                        "images/uploads/postImages/" . str_replace(' ', '', $post->title) . $_SESSION['userid'] . $post->time . ".gif");

                    $post->image = str_replace(' ', '', $post->title) . $_SESSION['userid'] . $post->time . ".gif";



                } else {

                    throw new ErrorException("Unable to create post. The uploaded image must be a JPEG, PNG or GIF.");

                }

            } else {

                throw new ErrorException("Your image size has to be smaller than 8MB.");

            }

        } else {

            throw new ErrorException("Please upload an image.");

        }



        if ($_POST['imgTopic'] == 'none') { //indien select niet geselecteerd is

            if ($_POST['addTopic'] != '') {//nieuwe topic opslaan

                $newTopic = new Topics;

                $newTopic->name = htmlspecialchars($_POST['addTopic']);

                $newTopic->image = str_replace(' ', '', strtolower($_FILES['img']['name']));



                if ($newTopic->checkAvailability() == 'match') {

                    $topicsId = $newTopic->id;

                } else {

                    $newTopic->image = $post->image;

                    copy('images/uploads/postImages/' . $post->image, 'images/topics/' . $post->image);

                    $newTopic->saveTopic();

                    //topicId van nieuwe topic ophalen

                    $newTopic->getTopicViaName();

                    $topicsId = $newTopic->id;

                }



                $newTopic->saveUserTopic();

                array_push($_SESSION['topics'], $newTopic);

            } else {

                throw new ErrorException("Please select a topic.");

            }

        } else {

            $topicsId = htmlspecialchars($_POST['imgTopic']);

        }



        $post->topics_ID = (int)$topicsId;

        $post->link = "";

        $post->location = htmlspecialchars($_POST['location']);

        $post->privacy = htmlspecialchars($_POST['privacy']);

        $post->savePost();

        $user = new User;

        $user->Email = $_SESSION['user'];

        $user->getUserPosts();



        $success = "Post succesfully saved";

    }



} catch (Exception $e) {

    $error = $e->getMessage();

}



// VIA LINK POSTEN

try {

    if (isset($_POST['linkSubmit'])) {

        $post = new Post;

        if ($_POST['url'] != '') {

            $link = htmlspecialchars($_POST['url']);

        } else {

            throw new ErrorException("Please fill in a link.");

        }

        $title = '';

        $image = '';

        $description = '';

        if (strpos($link, 'https://') === false && strpos($link, 'http://') === false) {

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

                        $image = $link . $image;

                    }

                    $image = str_replace(' ', '', $image);

                    break;

                }

            }



            if ($_POST['linkTopic'] == 'none') { //indien select niet geselecteerd is

                //nieuwe topic opslaan

                if ($_POST['addTopic'] != '') {//nieuwe topic opslaan

                    $newTopic = new Topics;

                    $newTopic->name = htmlspecialchars($_POST['addTopic']);

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

                    throw new ErrorException("Please select a topic.");

                }

            } else {

                $topicsId = htmlspecialchars($_POST['linkTopic']);

            }



            $post->time = time(); //timestamp

            $post->description = $description;

            $post->topics_ID = (int)$topicsId;

            $post->link = $link;

            $post->image = $image;

            $post->title = $title;

            $post->location = htmlspecialchars($_POST['location']);

            $post->privacy = htmlspecialchars($_POST['privacy']);

            $post->savePost();



            $user = new User;

            $user->Email = $_SESSION['user'];

            $user->getUserPosts();



            $success = "Post succesfully saved";

        }

    }

} catch (Exception $e) {

    $error = $e->getMessage();

}



if (isset($_POST['report'])) {

    $post = new Post;

    $post->id = htmlspecialchars($_POST['report']);

    $post->reportPost();

    $success = "This post is reported as spam";

}



if (isset($_POST['delete'])) {

    $post = new Post;

    $post->id = htmlspecialchars($_POST['delete']);

    $post->deletePost();

    $success = "Post succesfully deleted";

}



////COMMENTS/////

if (!empty($_POST['comment'])) {

    $comment = new Comment;

    $comment->comment = htmlspecialchars($_POST['comment']);

    $comment->post_id = htmlspecialchars($_POST['post_id']);

    $comment->saveComment();

}



////BOARDS////

if (isset($_POST['pinned_post'])) {

    if (!empty($_POST['selected_board'])) {

        $post = new Post();

//  echo $_POST['selected_board'];

        $post->id = htmlspecialchars($_POST['pinned_post']);

        $board_id = htmlspecialchars($_POST['selected_board']);

        $post->saveToBoard($board_id);

        $success = "Post succesfully saved";

    }

}




///EDITS////
if (!empty($_POST['edit-title'])) {
  $post = new Post();
  $title_edit = htmlspecialchars($_POST['edit-title']);
  $post_id = htmlspecialchars($_POST['edit']);
  $post->changeTitle($title_edit,$post_id);
}

if (!empty($_POST['edit-description'])) {
  $post = new Post();
  $desc_edit = htmlspecialchars($_POST['edit-description']);
  $post_id = htmlspecialchars($_POST['edit']);
  $post->changeDescription($desc_edit,$post_id);
}
