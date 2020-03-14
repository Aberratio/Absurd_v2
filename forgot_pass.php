<?php

if ((isset($_SESSION['is_logged'])) && ($_SESSION['is_logged'] == true)) {
    header('Location: menu.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <script src="https://kit.fontawesome.com/fe0a0fefeb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Absurd - Bridge Platform</title>
</head>

<body>
    <div class="site-container">
        <div class="container mt-5">
            <div class="card main-form p-5 m-auto">
                <!-- LOGO -->
                <div class="row align-items-center justify-content-center mb-3">
                    <img class="col-5 col-sm-3 col-md-3 logo mr-sm-3" src="img/logo_Asia.png" alt="Absurd - logo" class="logo" />
                    <h1 class="col-12 col-sm-5 text-center">Absurd</h1>
                    <img class="col-5 col-sm-3 col-md-3 logo mr-sm-3" src="img/logo_Domi.png" alt="Absurd - logo" class="logo" />
                </div>

                <!-- REGISTER FORM -->

                <form>
                    <!-- TEXT FIELD GROUPS -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text "><i class="fas fa-user"></i></span>
                        </div>
                        <input class="form-control" type="text" id="nickname" placeholder="Nickname" />
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text "><i class="fas fa-envelope"></i></span>
                        </div>
                        <input class="form-control" type="email" id="email" placeholder="Email" />
                    </div>

                    <button class="btn btn-secondary btn-block" type="submit">
                        Reset password
                    </button>
                    <div class="mb-4 mt-4">
                        <p class="text-center">OR</p>
                    </div>
                    <a class="btn btn-primary btn-block" href="index.php">
                        However I remember my password</a>
                </form>
            </div>
        </div>

        <!-- FOOTER -->

        <div class="navbar fixed-bottom justify-content-center align-content-center" id="main-footer">
            <div class="footer-container">
                <p class="copyright">
                    Copyright &copy; 2020 by
                    <a href="https://www.facebook.com/joanna.kokot.37" target="_blank">Aberratio</a>. All Rights Reserved
                </p>
            </div>
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>

</html>

<?php
session_start();

include("connect.php");

if (isset($_POST['submit'])) {

    $email = htmlentities(mysqli_real_escape_string($con, $_POST['email']));
    $recovery_account = htmlentities(mysqli_real_escape_string($con, $_POST['cezar']));

    $select_user = "select * from users where user_email='$email' AND forgotten_answer='$recovery_account'";

    $query = mysqli_query($con, $select_user);

    $check_user = mysqli_num_rows($query);

    if ($check_user == 1) {

        $_SESSION['user_email'] = $email;

        echo "<script>window.open('create_password.php','_self')</script>";
    } else {
        echo "<script>alert('Your Email or your cezar number is Incorrect')</script>";
        echo "<script>window.open('forgot_pass.php','_self')</script>";
    }
}


?>