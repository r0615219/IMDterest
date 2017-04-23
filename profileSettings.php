<?php
session_start();
spl_autoload_register(function($class){
    include_once("classes/" . $class . ".php");
});
//stuur de gebruiker weg als ze niet zijn ingelogd
if (isset($_SESSION['user'])) {
} else {
    header('Location: signin.php');
}

if(!empty($_POST)){
    try {
        $user = new User;
        
        if (!empty($_POST['firstname'])) {
            $user->Firstname = $_POST['firstname'];
        }
        
        if (!empty($_POST['lastname'])) {
            $user->Lastname = $_POST['lastname'];
        }
        
        if (!empty($_POST['email'])) {
            $user->Email = $_POST['email'];
        }
        
        //oud passwoord
        if (!empty($_POST['password'])) {
            $user->Password = $_POST['password'];
        }
    
        if (!empty($_FILES['image']['name'])) {

            $bestandsnaam = strtolower($_FILES['image']['name']);
            
            if (strpos($bestandsnaam, ".png")){
                        move_uploaded_file($_FILES["image"]["tmp_name"],
                "images/uploads/userImages/" . $_SESSION['userid'] . ".png");
                        $user->Image = $_SESSION['userid'] . ".png";
                    } else if(strpos($bestandsnaam, ".jpg")){
                        move_uploaded_file($_FILES["image"]["tmp_name"],
                "images/uploads/userImages/" . $_SESSION['userid'] . ".jpg");
                        $user->Image = $_SESSION['userid'] . ".jpg";
                    } else if(strpos($bestandsnaam, ".gif")){
                        move_uploaded_file($_FILES["image"]["tmp_name"],
                "images/uploads/userImages/" . $_SESSION['userid'] . ".gif");
                        $user->Image = $_SESSION['userid'] . ".gif";
                    } else {
                throw new exception("Unable to change profile picture. The uploaded file must be a JPEG, PNG or GIF.");
            }
        }
        
        $user->updateDatabase();
        
    } catch (Exception $e) {
        $error = $e->getMessage();
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/npm.js"></script>

    <title>IMDterest | Settings</title>
</head>
<body>

<?php include_once('header.inc.php'); ?>



<div class="container" style="margin-top:50px;">
    <?php if(isset($error)){
        echo "<p>$error</p>";
    } ?>
    <h1 class="media-heading">Account settings</h1>
    <div class="media-body">
        <form enctype="multipart/form-data" action="" method="post">
           
            <label for="firstname">First name</label>
            <input type="text" value="<?php echo $_SESSION['firstname']; ?>" id="firstname" name="firstname"
                   class="form-control">
            
            <label for="lastname">Last name</label>
            <input type="text" value="<?php echo $_SESSION['lastname']; ?>" id="lastname" name="lastname"
                   class="form-control">
            
            <label for="email" style="margin-top:30px;">Email</label>
            <input type="text" value="<?php echo $_SESSION['user']; ?>" id="email" name="email"
                   class="form-control">

            <div class="media" style="margin-top:30px;">
                <img src="images/uploads/userImages/<?php echo $_SESSION['image']; ?>" alt="profile picture" style="max-width:150px;">
                <button type="button" class="btn media" data-toggle="modal" data-target="#uploadImage">Change profile picture</button>


                <div class="modal fade" id="uploadImage" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Upload profile picture</h4>
                            </div>
                            <div class="modal-body">
                                <input type="file" name="image">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default" data-dismiss="modal">Save</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div style="margin-top:30px;">
                <label for="password" class="col-xs-12">Password</label>
                <button type="button" class="btn btn-link" data-toggle="modal" data-target="#changePassword">Change your password</button>

                <div class="modal fade" id="changePassword" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Change password</h4>
                            </div>
                            <div class="modal-body">
                                <div class="input-group">
                                    <label for="password">Current password</label>
                                    <input type="password" class="form-control" placeholder="Current password" name="password" id="password" aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group">
                                    <label for="newPassword">New password</label>
                                    <input type="password" class="form-control" placeholder="New password" name="newPassword" id="newPassword" aria-describedby="basic-addon1">
                                </div>

                                <div class="input-group">
                                    <label for="controlPassword">Repeat new password</label>
                                    <input type="password" class="form-control" placeholder="Repeat new password" name="controlPassword" id="controlPassword" aria-describedby="basic-addon1">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-default" data-dismiss="modal">Save</button>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-success" style="margin-top: 50px;">Save settings</button>

        </form>
    </div>
</div>




</body>
</html>