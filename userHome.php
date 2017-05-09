<?php

spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".php");
});
//stuur de gebruiker weg als ze niet zijn ingelogd
if (isset($_SESSION['user'])) {
} else {
    header('Location: signin.php');
}
include_once('emptyStates.php');
?>

<div id="results"></div>

<div class="loadMore">
    <button class="loadMoreBtn loadMoreBtnHome btn btn-primary">Load 20 more</button>
</div>

<?php include_once('addBtn.php'); ?>
