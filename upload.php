<?php
session_start();
include("connect.php");
?>
<?php

if ($_SESSION['language'] == 1) {
    include("lang/lang_eng.php");
} else {
    include("lang/lang_pl.php");
}

$infos = new Infos();

if (!isset($_SESSION['is_logged'])) {

    header("location: menu.php");
} else { ?>

    <?php include 'templates/header.php'; ?>
    <?php include 'templates/navbar.php'; ?>

    <!-- MENU -->

    <body>
        <div class="site-container">
            <div class="row mb-5 mt-5">
                <!-- PLAYER PANEL-->
                <div class="col-sm-10 col-lg-6 mx-auto">
                    <div class="container mt-5">
                        <div class="card">
                            <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                                <?php echo $infos->change_profile_picture; ?>
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
                                                echo "<script>alert('" . $infos->select_profile_picture . "')</script>";
                                                echo "<script>window.open('upload.php','_self')</script>";
                                                exit();
                                            } else {

                                                move_uploaded_file($image_tmp, "img/$u_image.$random_number");


                                                $update = "update bridgeplayers set profile_picture='img/$u_image.$random_number'
                                                 where email='$user'";

                                                $run = mysqli_query($con, $update);

                                                if ($run) {

                                                    echo "<script>alert('" . $infos->my_groups . "')</script>";


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
                    <a href="https://www.facebook.com/joanna.gertrud.kokot/" target="_blank">Aberratio</a>. All Rights Reserved
                </p>
            </div>
        </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
    </body>

    </html>

<?php

} ?>