<?php
session_start();

include("connect.php");

if (!isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    exit();
}

$steps = 0;

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
                            Player Menu Panel
                        </h4>
                        <div class="option_container mx-3 mt-2">
                            <div class="option">
                                <!-- BIDDING QUIZ-->
                                <div class="card mb-4">
                                    <div class="row no-gutters mt-2">
                                        <div class="col-auto">
                                            <a href="choose_partner_bidding.php?type=0" class="d-block p-auto">
                                                <i class="fas fa-box fa-6x m-3"></i>
                                            </a>
                                        </div>
                                        <div class="col ml-1">
                                            <div class="card-block px-2">
                                                <h4 class="card-title font-weight-bold text-capitalize">
                                                    Bidding quiz
                                                </h4>
                                                <p class="card-text">
                                                    Have you ever struggled finding a convenient date for your bidding training with your partner? Now that's not a problem! Try asynchronous bidding quizzes.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- RANKING -->
                                <div class="card mb-4">
                                    <div class="row no-gutters mt-2">
                                        <div class="col-auto">
                                            <a href="ranking.php" class="d-block">
                                                <i class="fas fa-trophy fa-6x m-3"></i>
                                            </a>
                                        </div>
                                        <div class="col ml-1">
                                            <div class="card-block px-2">
                                                <h4 class="card-title font-weight-bold text-capitalize">
                                                    Ranking
                                                </h4>
                                                <p class="card-text">

                                                    Check your achievements. How do you compare to other players? Are you in the TOP 50?
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- SETTINGS-->
                                <div class="card mb-4">
                                    <div class="row no-gutters mt-2">
                                        <div class="col-auto">
                                            <a href="account_settings.php" class="d-block">
                                                <i class="fas fa-cog fa-6x m-3"></i>
                                            </a>
                                        </div>
                                        <div class="col ml-1">
                                            <div class="card-block px-2">
                                                <h4 class="card-title font-weight-bold text-capitalize">
                                                    Settings
                                                </h4>
                                                <p class="card-text">
                                                    Here you can change your profile picture, password, set a different e-mail address or edit information about yourself.
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php if ($_SESSION['role'] == 1) {
                                    echo "
            <div class='col-sm-4'>
                <figure>
                    <a href='choose_partner_bidding.php?type=1'><img src='img/testy.png' class='img-fluid menu_view_container-box' alt='licytacja'></a>
                    <figcaption>Testy na zgodność w parze</figcaption>
                </figure>
            </div>";
                                }
                                ?>

                                <?php if ($_SESSION['role'] == 0) {
                                    echo "
            <div class='col-sm-4'>
                <figure>
                    <a href='admin_panel.php'><img src='img/archiwum.png' class='img-fluid menu_view_container-box' alt='licytacja'></a>
                    <figcaption>Archiwum</figcaption>
                </figure>
            </div>";
                                }
                                ?>

                                <?php if ($_SESSION['role'] == 1) {
                                    echo "
            <div class='col-sm-4'>
                <figure>
                    <a href='administration.php'><img src='img/archiwum.png' class='img-fluid menu_view_container-box' alt='licytacja'></a>
                    <figcaption>Panel Administratora</figcaption>
                </figure>
            </div>";
                                }
                                ?>
                                <!-- ADD TESTS-->
                                <?php if ($_SESSION['role'] == 1 or $_SESSION['role'] == 2) {
                                    echo "

                                    <div class='card mb-4'>
                                    <div class='row no-gutters mt-2'>
                                        <div class='col-auto'>
                                            <a href='admin_panel.php' class='d-block'>
                                                <i class='fas fa-plus-square fa-6x m-3'></i>
                                            </a>
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
                                </div>";
                                }
                                ?>

                                <!-- TRAINING GROUPS-->
                                <?php if ($_SESSION['role'] == 1 or $_SESSION['role'] == 2) {
                                    echo "

                                    <div class='card mb-4'>
                                    <div class='row no-gutters mt-2'>
                                        <div class='col-auto'>
                                            <a href='training_groups.php' class='d-block'>
                                                <i class='fas fa-users fa-4x m-3'></i>
                                            </a>
                                        </div>
                                        <div class='col ml-1'>
                                            <div class='card-block px-2'>
                                                <h4 class='card-title font-weight-bold text-capitalize'>
                                                    Training groups
                                                </h4>
                                                <p class='card-text'>
                                                    Add your pairs, challenge them in the form of new bidding sets and monitor their progress. 
                                                    A good trainer must be up to date!
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>";
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

            <!-- NEWS -->
            <div class="col-sm-10 col-md-6 col-lg-4 mx-auto">
                <div class="container mt-5">
                    <div class="card process text-center py-2">
                        <h3 class="d-block text-center py-2 mt-2 mx-3 text-capitalize">
                            What you have to do?
                        </h3>
                        <hr class="hr-dark py-3" />

                        <?php if ($_SESSION['profile_picture'] == "img/profil.png") {

                            echo "<div class='mx-auto mb-3' style='max-width: 18rem;'>
                                <a class='text-decoration-none d-block' href='upload.php'>
                                    <i class='fas fa-camera fa-4x process-icon'>
                                        <div class='process-step'>" . ++$steps . "</div>
                                    </i>
                                    <h4>Change your profile picture</h4>
                                    <p>
                                        It will be more convenient and pleasant to use this application</p>
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
                                <h4>Send nicknames</h4>
                                <p>
                                    Send yours and your partners name to one of our treners and wait for sets from him.
                                </p>
                            </a>
                        </div>";
                        }
                        ?>

                        <div class="mx-auto mb-3" style="max-width: 18rem;">
                            <a class="text-decoration-none d-block" href="ranking.php">
                                <i class="fas fa-medal fa-4x process-icon my-2">
                                    <div class="process-step"><?php echo ++$steps; ?></div>
                                </i>
                                <h4>Bid and check your score in ranking</h4>
                                <p>You can check your progress both in the overall ranking, as in separate rankings at each problem</p>
                            </a>
                        </div>

                        <div class="mx-auto mb-3" style="max-width: 18rem;">
                            <a class="text-decoration-none d-block" href="choose_partner_bidding.php?type=0">
                                <i class="fas fa-people-carry fa-4x process-icon my-2">
                                    <div class="process-step"><?php echo ++$steps; ?></div>
                                </i>
                                <h4>Analyse tests with your partner</h4>
                                <p>Did you finish the test? Congratulations! However, remember that this is only half the battle. To improve your skills, you should discuss each hand with your partner.</p>
                            </a>
                        </div>

                        <div class="mx-auto mb-3" style="max-width: 18rem;">
                            <div>
                                <i class="fas fa-grin-wink fa-4x process-icon my-2">
                                    <div class="process-step"><?php echo ++$steps; ?></div>
                                </i>
                                <h4>Good luck and have fun! ♥ ♥ ♥</h4>
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