<?php

spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".php");
});

try {

    if (!empty($_GET['search']) && !empty($_GET['search-select'])) {
        $search = new Search();
        $search->Zoekterm = htmlspecialchars($_GET['search']);
        $search->ZoekSelect = htmlspecialchars($_GET['search-select']);
        $search->zoeken();
    }

} catch (Exception $e) {
    $error = $e->getMessage();
}

?>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                    data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="index.php">IMDterest</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li <?php echo ($page == 'home') ? "class='active'" : ""; ?>><a href="index.php">Home <span
                                class="sr-only">(current)</span></a></li>
                <li <?php echo ($page == 'explore') ? "class='active'" : ""; ?>><a href="explore.php">Explore</a></li>
                <li <?php echo ($page == 'topics') ? "class='active'" : ""; ?>class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Topics <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <?php foreach ($_SESSION['topics'] as $t): ?>
                            <li><a href="topics.php?topicsid=<?php echo $t->id; ?>"><?php echo $t->name; ?></a></li>
                        <?php endforeach; ?>
                        <li role="separator" class="divider"></li>
                        <li><a <a href="topics.php?topicsid=0">More</a></li>
                    </ul>
                </li>
                <li <?php echo ($page == 'boards') ? "class='active'" : ""; ?>><a href="boards.php">Boards</a></li>
            </ul>
            <form class="navbar-form navbar-left" method="get" name="searchForm" id="searchForm"
                  action="search-result.php">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" id="search" name="search">
                    <select class="form-control" name="search-select">
                        <option value="posts">Posts</option>
                        <option value="users">Users</option>
                        <option value="topics">Topics</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-default">
                    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>&nbsp;
                </button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <li><a href="profile.php?userId=<?php echo $_SESSION['userid']; ?>"><img class="media-object profile-pic"
                                               src="images/uploads/userImages/<?php echo $_SESSION['image']; ?>"
                                               alt="profile"></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false"><?php echo $_SESSION['firstname'], ' ', $_SESSION['lastname']; ?>
                        <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="profile.php?userId=<?php echo $_SESSION['userid']; ?>">Profile</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php">Log out</a></li>
                    </ul>
                </li>

            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

