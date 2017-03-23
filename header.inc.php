<!--<header>
    <h1>IMDterest</h1>

    <div class="profile">
        <a href="settings.php" class="profile_link"><img src="http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png" alt="Profile Picture" class="profilepicture"></a>
        <a href="logout.php" class="logout">Log out</a>
    </div>
</header>-->

<!--<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">IMDterest</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <form class="navbar-form navbar-right" method="post">
                <div class="form-group">
                    <input type="text" placeholder="Username" name="username" id="username" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
            </form>
        </div>
    </div>
</nav>-->

<nav class="navbar navbar-inverse navbar-fixed-top"> //navbar-default
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
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                <!--<li><a href="#">Link</a></li>-->
                <li><a href="#"><img class="media-object profile-pic" src="http://www.gfcactivatingland.org/media/uploads/images/profile_placeholder.png" alt="profile"></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['fullname']; ?> <span class="caret"></span></a>
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