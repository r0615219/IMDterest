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

$topicsId = $_GET['linkTopic'];
$link = $_GET['url'];
$title = '';
$image = '';
$description = '';
if(strpos($link, 'https://') === false || strpos($link, 'http://') === false){
    $link = 'http://'.$link;
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

    //get site's first image
    /*$nodeImage = $doc->getElementsByTagName('img');
    $image = str_replace(' ', '%20', $link . $nodeImage[0]->getAttribute('src'));
*/
    $description = get_meta_tags($link)['description'];
    $nodeImage = $doc->getElementsByTagName('img');
}


if (isset($_POST['img'])) {
    $image = str_replace(' ', '%20', $_POST['img']);

    $post = new Post;
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

    header('Location: home.php');
}

?>
<link rel="stylesheet" href="css/topics.css">
<h1>Choose which image you want to save</h1>
<form action="" method="post">
    <div class="btn-group btn-block" data-toggle="buttons">
        <?php

        foreach ($nodeImage as $node):?>
            <label class="btn topic-div" style="background-image: url(<?php if(strpos($node->getAttribute('src'), 'http') === false){echo $link;} echo $node->getAttribute('src'); ?>);">
                <input type="radio" name="img" value="<?php echo $node->getAttribute('src'); ?>">
            </label>
        <?php endforeach; ?>
    </div>
    <button class="btn btn-success save" type="submit">Save this image</button>
</form>
