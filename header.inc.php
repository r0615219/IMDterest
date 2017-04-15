<?php

    include_once 'classes/Search.php';

    if(!empty($_GET)){
        try{
            $search = new Search();
            $search->Zoekterm = $_GET['search'];
            $search->ZoekSelect = $_GET['search-select'];
            //echo "<script type='text/javascript'>alert('$search->Zoekterm');</script>";
            $search->Zoeken();
        }catch(exception $e){}
    }
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">IMDterest</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="home.php">Home <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Messages</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Topics <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Design</a></li>
                        <li><a href="#">Development</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Photography</a></li>
                        <li><a href="#">Art</a></li>
                        <li><a href="#">UX</a></li>
                        <li><a href="#">Sketches</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">More</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left" method="get" name="searchForm" id="searchForm" action="search-result.php">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search" id="search" name="search">
                    <select class="form-control" name="search-select">
                        <option value="person">Person</option>
                        <option value="post">Post</option>
                        <option value="topic">Topic</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <!--<li><a href="#">Link</a></li>-->
                <li><a href="#"><img class="media-object profile-pic" src="images/uploads/userImages/<?php echo $_SESSION['image'];?>" alt="profile"></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['firstname']; ?> <?php echo $_SESSION['lastname']; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Profile</a></li>
                        <li><a href="settings.php">Settings</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php">Log out</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>