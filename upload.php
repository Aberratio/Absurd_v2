<?php
session_start();
include("connect.php");
?>
<?php

if (!isset($_SESSION['is_logged'])) {

    header("location: menu.php");
} else { ?>
    <!DOCTYPE HTML>
    <html lang="pl">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <script src="https://kit.fontawesome.com/fe0a0fefeb.js" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="css/bootstrap.css" />
        <link rel="stylesheet" href="css/style.css" />
        <title>Absurd - Bridge Platform</title>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>

    <!-- NAVBAR -->

    <nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top py-1">
        <div class="container">
            <a class="navbar-brand" href="menu.php">
                <img src="img/logo_Asia_rev.png" alt="" width="50" height="50" />
                <h3 class="d-inline align-middle">Absurd</h3>
                <img src="img/logo_Domi_rev.png" alt="" width="50" height="50" />
            </a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <p class="text-light"> Points: <?php echo $_SESSION['player_points']; ?> </p>
                    </li>
                    <li class="nav-item">
                        <img class='profile_picture_nav' src='<?php echo $_SESSION['profile_picture']; ?>'>
                        <i style="color:white;"><?php echo $_SESSION['user']; ?></i>
                    </li>
                    <li class="nav-item">
                        <a class="text-decoration-none text-light" href="logout.php">Log Out</a>
                    </li>
            </div>
        </div>
    </nav>

    <!-- MENU -->

    <body>
        <div class="site-container">
            <div class="row mb-5 mt-5">
                <!-- PLAYER PANEL-->
                <div class="col-sm-10 col-lg-6 mx-auto">
                    <div class="container mt-5">
                        <div class="card">
                            <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                                Update profile picture
                            </h4>
                            <div class="option_container mx-3 mt-2">
                                <div class="option">
                                    <div class="row">
                                        <div class="col-sm-2">
                                        </div>
                                        <?php
                                        $user = $_SESSION['email'];
                                        $get_user = "select * from bridgeplayers where email='$user'";
                                        $run_user = mysqli_query($con, $get_user);
                                        $row = mysqli_fetch_array($run_user);

                                        $user_name = $row['user'];
                                        $user_profile = $row['profile_picture'];
                                        ?>
                                        <div class="col-sm-8">
                                            <div class='row'>
                                                <div class='col-sm-2'>
                                                </div>
                                                <div class='col-sm-8 mb-3'>
                                                    <h2 class="text-capitalize"><?php echo $user_name; ?></h2>
                                                    <img class='profile_picture' src='<?php echo $user_profile; ?>'>

                                                    <form method='post' enctype='multipart/form-data' class="mt-2">
                                                        <div id='update_profile'>
                                                            <input type='file' name='u_image' size='60' />
                                                        </div>
                                                        <input class="btn btn-secondary mt-3 btn-block" type="submit" name="update" value="Update" />
                                                </div>
                                                </form>
                                            </div>
                                        </div><br><br>

                                        <?php

                                        if (isset($_POST['update'])) {

                                            $u_image = $_FILES['u_image']['name'];
                                            $image_tmp = $_FILES['u_image']['tmp_name'];
                                            $random_number = rand(1, 100);

                                            if ($u_image == '') {
                                                echo "<script>alert('Select a profile picture!')</script>";
                                                echo "<script>window.open('upload.php','_self')</script>";
                                                exit();
                                            } else {

                                                move_uploaded_file($image_tmp, "img/$u_image.$random_number");


                                                $update = "update bridgeplayers set profile_picture='img/$u_image.$random_number' where email='$user'";

                                                $run = mysqli_query($con, $update);

                                                if ($run) {

                                                    echo "<script>alert('Profile updated!')</script>";


                                                    $_SESSION['profile_picture'] = "img/$u_image.$random_number";

                                                    echo "<script>window.open('upload.php','_self')</script>";
                                                }
                                            }
                                        }


                                        ?>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>
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

} ?>