<?php
spl_autoload_register(function ($class) {
    include_once("classes/" . $class . ".php");
});
if (!empty($_POST)) {
    try {
        if (!empty($_POST['email'] && $_POST['password'])) {
            $user = new User();
            $user->Email = $_POST['email'];
            $user->Password = $_POST['password'];
            if ($user->canLogin()) {
                echo'canlogin';
                $user->handleLogin();
            } else {
                $error = "<p class='alert alert-danger'> Failed to sign in. </p>";
            }
        } else {
            throw new exception("<p class='alert alert-danger'>Failed to sign in. All fields need to be filled in.</p>");
        }
    } catch (exception $e) {
        $error= $e->getMessage();
    }
}

?>

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

    <link href="https://fonts.googleapis.com/css?family=Nova+Oval" rel="stylesheet">

    <title>IMDterest | Sign In</title>
</head>
<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
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
                    <input type="text" placeholder="Email" name="email" id="email" class="form-control">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Password" name="password" id="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-success">Sign in</button>
            </form>
        </div><!--/.navbar-collapse -->
    </div>
</nav>

<div class="jumbotron">
    <div class="container">
        <?php if (isset($error)) {
    echo "<p class='alert alert-danger'>$error</p>";
} ?>
        <h1>A creative way to share ideas!</h1>
        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
        <p>Join our community!</p>
        <p><a class="btn btn-primary btn-lg" href="signup.php" role="button">Sign up</a></p>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/npm.js"></script>

</body>
</html>