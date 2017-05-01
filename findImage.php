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


$post = new Post;

$link = $_GET['url'];
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
}

$image = str_replace(' ', '%20', $_POST['choosePostImage']);

if ($_GET['linkTopic'] == 'none') { //indien select niet geselecteerd is
    //nieuwe topic opslaan
    $newTopic = new Topics;
    $newTopic->name = $_GET['addTopic'];
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
    $topicsId = $_GET['linkTopic'];
}

$post->uploadtime = time(); //timestamp
$post->description = $description;
$post->topics_ID = (int)$topicsId;
$post->link = $link;
$post->image = $image;
$post->title = $title;
$post->savePost();

$user = new User;
$user->Email = $_SESSION['user'];
$user->getUserPosts();


?>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/signup-style.css">
    <link rel="stylesheet" href="css/topics.css">
    <link rel="stylesheet" href="css/add-button.css">
    <link rel="stylesheet" href="css/posts.css">

    <link href="https://fonts.googleapis.com/css?familhy=Nova+Oval" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

<?php include_once('header.inc.php'); ?>

    <div class="btn-group btn-block block" data-toggle="buttons">
        <div class="container">
            <h1 class="h1">Which image do you want to save</h1>
            <?php foreach ($nodeImage as $node): ?>
                <?php if ($node->getAttribute('src') !== ''): ?>
                    <button class="btn topic-div"
                            name="choosePostImage"
                            style="background-image: url(<?php if (strpos($node->getAttribute('src'), '../') === true) {
                                echo str_replace("../", "/", $node->getAttribute('src'));
                            }
                            if (strpos($node->getAttribute('src'), 'http') === false) {
                                echo $link;
                            }
                            echo $node->getAttribute('src'); ?>);"
                            value="<?php if (strpos($node->getAttribute('src'), '../') === true) {
                                echo str_replace("../", "/", $node->getAttribute('src'));
                            }
                            if (strpos($node->getAttribute('src'), 'http') === false) {
                                echo $link;
                            }
                            echo $node->getAttribute('src'); ?>);"
                    >
                    </button>
                <?php endif; endforeach; ?>
        </div>
    </div>


<?php
/**
 * 1. link en topic meegeven
 * 2. description en titel op halen
 * 3. afbeeldingen uitlezen
 * 4. gekozen afbeelding opslaan
 *
 */