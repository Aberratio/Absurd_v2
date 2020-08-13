<?php
session_start();

include("connect.php");


if ($_SESSION['language'] == 1) {
    include("lang/lang_eng.php");
} else {
    include("lang/lang_pl.php");
}

$infos = new Infos();

if (!isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    exit();
}

$steps = 0;

?>

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
                            <?php echo $infos->player_menu_panel; ?>
                        </h4>
                        <div class="option_container mx-3 mt-2">
                            <div class="option">

                                <!-- TOURNAMENT GENERATOR-->
                                <?php if ($_SESSION['role'] == 1) {
                                    echo "
                                    <a class='text-decoration-none' href='folder_view.php' >
                                    <div class='card mb-4'>
                                    <div class='row no-gutters mt-2'>
                                        <div class='col-auto'>
                                                <i class='fas fa-plus-square fa-6x m-3'></i>
                                        </div>
                                        <div class='col ml-1'>
                                            <div class='card-block px-2'>
                                                <h4 class='card-title font-weight-bold text-capitalize'>
                                                " . $infos->tournament_generator_header . "
                                                </h4>
                                                <p class='card-text'>
                                                " . $infos->tournament_generator_description . "
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>";
                                }
                                ?>

                                <!-- BRIDGE TESTS-->
                                <?php if ($_SESSION['role'] == 1) {
                                    echo "

                                    <a href='choose_bridge_set.php' class='text-decoration-none'>
                                    <div class='card mb-4'>
                                    <div class='row no-gutters mt-2'>
                                        <div class='col-auto'>
                                                <i class='fas fa-plus-square fa-6x m-3'></i>
                                        </div>
                                        <div class='col ml-1'>
                                            <div class='card-block px-2'>
                                                <h4 class='card-title font-weight-bold text-capitalize'>
                                                    Bridge tests
                                                </h4>
                                                <p class='card-text'>
                                                    No i będzie się działo xDDDDDDDDD
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>";
                                }
                                ?>

                                <!-- COMPETITION -->
                                <a href="competition.php" class='text-decoration-none'>
                                    <div class="card mb-4">
                                        <div class="row no-gutters mt-2">
                                            <div class="col-auto">
                                                <i class="fas fa-medal fa-6x m-3"></i>
                                            </div>
                                            <div class="col ml-1">
                                                <div class="card-block px-2">
                                                    <h4 class="card-title font-weight-bold text-capitalize">
                                                        <?php echo $infos->competition_header; ?>
                                                    </h4>
                                                    <p class="card-text">
                                                        <?php echo $infos->competition_description; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- BIDDING QUIZ-->
                                <a href="choose_partner_bidding.php?type=0" class='text-decoration-none'>
                                    <div class="card mb-4">
                                        <div class="row no-gutters mt-2">
                                            <div class="col-auto">
                                                <i class="fas fa-box fa-6x m-3"></i>
                                            </div>
                                            <div class="col ml-1">
                                                <div class="card-block px-2">
                                                    <h4 class="card-title font-weight-bold text-capitalize">
                                                        <?php echo $infos->bidding_quiz_header; ?>
                                                    </h4>
                                                    <p class="card-text">
                                                        <?php echo $infos->bidding_quiz_description; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- RANKING -->
                                <a href="ranking.php" class='text-decoration-none'>
                                    <div class="card mb-4">
                                        <div class="row no-gutters mt-2">
                                            <div class="col-auto">
                                                <i class="fas fa-trophy fa-6x m-3"></i>
                                            </div>
                                            <div class="col ml-1">
                                                <div class="card-block px-2">
                                                    <h4 class="card-title font-weight-bold text-capitalize">
                                                        <?php echo $infos->ranking_header; ?>
                                                    </h4>
                                                    <p class="card-text">
                                                        <?php echo  $infos->ranking_description; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- SETTINGS-->
                                <a href="account_settings.php" class='text-decoration-none'>
                                    <div class="card mb-4">
                                        <div class="row no-gutters mt-2">
                                            <div class="col-auto">
                                                <i class="fas fa-cog fa-6x m-3"></i>
                                            </div>
                                            <div class="col ml-1">
                                                <div class="card-block px-2">
                                                    <h4 class="card-title font-weight-bold text-capitalize">
                                                        <?php echo $infos->settings_header; ?>
                                                    </h4>
                                                    <p class="card-text">
                                                        <?php echo $infos->settings_description; ?>
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <!-- TESTY NA ZGODNOŚĆ W PARZE -->
                                <?php if ($_SESSION['role'] == 1) {
                                    echo "

                                    <a href='choose_partner_bidding.php?type=1' class='text-decoration-none'>
                                    <div class='card mb-4'>
                                    <div class='row no-gutters mt-2'>
                                        <div class='col-auto'>
                                                <i class='fas fa-plus-square fa-6x m-3'></i>
                                        </div>
                                        <div class='col ml-1'>
                                            <div class='card-block px-2'>
                                                <h4 class='card-title font-weight-bold text-capitalize'>
                                                Testy na zgodność w parze
                                                </h4>
                                                <p class='card-text'>
                                                    Create a new set and add your own tests. 
                                                    You can also edit old sets.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>";
                                }
                                ?>

                                <!-- ARCHIWUM -->
                                <?php if ($_SESSION['role'] == 1) {
                                    echo "

                                    <a href='#' class='text-decoration-none'>
                                    <div class='card mb-4'>
                                    <div class='row no-gutters mt-2'>
                                        <div class='col-auto'>
                                                <i class='fas fa-plus-square fa-6x m-3'></i>
                                        </div>
                                        <div class='col ml-1'>
                                            <div class='card-block px-2'>
                                                <h4 class='card-title font-weight-bold text-capitalize'>
                                                    Archiwum
                                                </h4>
                                                <p class='card-text'>
                                                    Create a new set and add your own tests. 
                                                    You can also edit old sets.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>";
                                }
                                ?>

                                <!-- ADMIN PANEL-->
                                <?php if ($_SESSION['role'] == 1) {
                                    echo "
                                    <a href='administration.php' class='text-decoration-none'>
                                        <div class='card mb-4'>
                                            <div class='row no-gutters mt-2'>
                                                <div class='col-auto'>
                                                        <i class='fas fa-plus-square fa-6x m-3'></i>
                                                </div>
                                                <div class='col ml-1'>
                                                    <div class='card-block px-2'>
                                                        <h4 class='card-title font-weight-bold text-capitalize'>
                                                            Admin Panel
                                                        </h4>
                                                        <p class='card-text'>
                                                            Create a new set and add your own tests. 
                                                            You can also edit old sets.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>";
                                }
                                ?>

                                <!-- ADD TESTS-->
                                <?php if ($_SESSION['role'] == 1) {
                                    echo "

                                    <a href='admin_panel.php' class='text-decoration-none'>
                                    <div class='card mb-4'>
                                    <div class='row no-gutters mt-2'>
                                        <div class='col-auto'>
                                                <i class='fas fa-plus-square fa-6x m-3'></i>
                                        </div>
                                        <div class='col ml-1'>
                                            <div class='card-block px-2'>
                                                <h4 class='card-title font-weight-bold text-capitalize'>
                                                    Add tests
                                                </h4>
                                                <p class='card-text'>
                                                    Create a new set and add your own tests. 
                                                    You can also edit old sets.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </a>";
                                }
                                ?>

                                <!-- TRAINING GROUPS-->
                                <?php if ($_SESSION['role'] == 1 or $_SESSION['role'] == 2) {
                                    echo "
                                    <a href='training_groups.php' class='text-decoration-none'>
                                        <div class='card mb-4'>
                                            <div class='row no-gutters mt-2'>
                                                <div class='col-auto'>
                                                        <i class='fas fa-user-graduate fa-6x m-3'></i>
                                                </div>
                                                <div class='col ml-1'>
                                                    <div class='card-block px-2'>
                                                        <h4 class='card-title font-weight-bold text-capitalize'>
                                                        " . $infos->training_groups_header . "
                                                        </h4>
                                                        <p class='card-text'>
                                                        " . $infos->training_groups_description . "
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>";
                                }
                                ?>
                                <!-- ABOUT US-->
                                <?php if ($_SESSION['role'] != null) {
                                    echo "
                                    <a href='about_us.php' class='text-decoration-none'>
                                        <div class='card mb-4'>
                                            <div class='row no-gutters mt-2'>
                                                <div class='col-auto'>
                                                        <i class='fas fa-user-graduate fa-6x m-3'></i>
                                                </div>
                                                <div class='col ml-1'>
                                                    <div class='card-block px-2'>
                                                        <h4 class='card-title font-weight-bold text-capitalize'>
                                                        " .$infos->about_us.  "
                                                        </h4>
                                                        <p class='card-text'>
                                                        " .$infos->about_us_description . "
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>";
                                }
                                ?>

                                <!-- <?php
                                        if ($_SESSION['role'] == 1) {
                                            echo "
              <div class='col-sm-4'>
                  <figure>
                      <a href='#'><img src='img/punkty_absurdu.png' class='img-fluid menu_view_container-box' alt='licytacja'></a>                   
                      <figcaption>Punkty absurdu</figcaption>
                  </figure>
              </div>
              ";
                                        }
                                        ?> -->
                                <!-- 
            <?php
            if ($_SESSION['role'] == 1) {
                echo "
                    <div class='col-sm-4'>
                        <figure>
                            <a href='#'><img src='img/kreator.png' class='img-fluid menu_view_container-box' alt='licytacja'></a>                   
                            <figcaption>Kreator KK</figcaption>
                        </figure>
                    </div>
                    ";
            }
            ?> -->

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- WHAT YOU HAVE TO DO -->
            <div class="col-sm-10 col-lg-4 mx-auto">
                <div class="container mt-5">
                    <div class="card process text-center py-2">
                        <h3 class="d-block text-center py-2 mt-2 mx-3 text-capitalize">
                            <?php echo $infos->what_you_have_to_do; ?>
                        </h3>
                        <hr class="hr-dark py-3" />

                        <?php if ($_SESSION['profile_picture'] == "img/profil.png") {

                            echo "<div class='mx-auto mb-3' style='max-width: 18rem;'>
                                <a class='text-decoration-none d-block' href='upload.php'>
                                    <i class='fas fa-camera fa-4x process-icon'>
                                        <div class='process-step'>" . ++$steps . "</div>
                                    </i>
                                    <h4>" . $infos->change_profile_picture_header . "</h4>
                                    <p>
                                    " . $infos->change_profile_picture_description . "    
                                    </p>
                                </a>
                            </div>";
                        }
                        ?>

                        <?php

                        global $con;

                        $get_user = 'SELECT * FROM bridgeplayers RIGHT JOIN training_groups ON id = id_second_player WHERE id_first_player = ' . $_SESSION["id"] . ' or id_second_player = ' . $_SESSION["id"] . '';

                        $run_user = mysqli_query($con, $get_user);


                        $partners = 0;

                        while ($row_user = mysqli_fetch_array($run_user)) {
                            $partners++;
                        }


                        if ($partners == 0) {
                            echo "<div class='mx-auto mb-3' style='max-width: 18rem;'>
                            <a class='text-decoration-none d-block' href='#'>
                                <i class='fas fa-mail-bulk fa-4x process-icon my-2'>
                                    <div class='process-step'>" . ++$steps . "</div>
                                </i>
                                <h4>" . $infos->send_nicknames_header . "</h4>
                                <p>
                                " . $infos->send_nicknames_description . "
                                </p>
                            </a>
                        </div>";
                        }
                        ?>

                        <div class="mx-auto mb-3" style="max-width: 18rem;">
                            <a class="text-decoration-none d-block" href="ranking.php">
                                <i class="fas fa-users fa-4x process-icon my-2">
                                    <div class="process-step"><?php echo ++$steps; ?></div>
                                </i>
                                <h4><?php echo $infos->ranking_header; ?></h4>
                                <p><?php echo $infos->ranking_description; ?></p>
                            </a>
                        </div>

                        <div class="mx-auto mb-3" style="max-width: 18rem;">
                            <a class="text-decoration-none d-block" href="choose_partner_bidding.php?type=0">
                                <i class="fas fa-people-carry fa-4x process-icon my-2">
                                    <div class="process-step"><?php echo ++$steps; ?></div>
                                </i>
                                <h4><?php echo $infos->analyse_tests_header; ?></h4>
                                <p><?php echo $infos->analyse_tests_description; ?></p>
                            </a>
                        </div>

                        <div class="mx-auto mb-3" style="max-width: 18rem;">
                            <div>
                                <i class="fas fa-grin-wink fa-4x process-icon my-2">
                                    <div class="process-step"><?php echo ++$steps; ?></div>
                                </i>
                                <h4><?php echo $infos->good_luck_header; ?></h4>
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