<?php
session_start();
include("find_set.php");

if (!isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    exit();
}
?>

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

    <script type="text/javascript" src="js/biddingbox.js">

    </script>
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
                            Find bidding set
                        </h4>
                        <div class="option_container mx-3 mt-2">
                            <div class="page">

                                <div class="accordion-option">
                                    <a href="javascript:void(0)" class="toggle-accordion active" accordion-id="#accordion"></a>
                                </div>
                                <div class="clearfix"></div>
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <?php search_for_folders($_GET['friend'], $_GET['type'], $_SESSION['id']); ?>
                                </div>
                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <!-- END PLAYER PANEL-->


            <!-- LEVEL DESCRIPTION -->
            <div class="col-sm-10 col-md-6 col-lg-4 mx-auto">
                <div class="container mt-5">
                    <div class="card">
                        <h4 class="d-block text-center py-2 mt-2 mx-3 text-capitalize">
                            Description of levels
                        </h4>
                        <hr class="hr-dark py-3" />

                        <div class="card mx-auto mb-3 border-success mb-3" style="max-width: 18rem;">
                            <div class="card-body text-success">
                                <h4 class="card-title">Level I</h4>
                                <hr />
                                <p class="card-text">
                                    Beginner sets. The dealer is not important. There are no difficult hands to bid.
                                </p>
                            </div>
                        </div>

                        <div class="card mx-auto mb-3 border-warning mb-3" style="max-width: 18rem;">
                            <div class="card-body text-warning">
                                <h4 class="card-title">Level II</h4>
                                <hr />
                                <p class="card-text">
                                    Intermediate sets. There are more difficult hands but the dealer is still not important.
                                </p>
                            </div>
                        </div>
                        <div class="card mx-auto mb-3 border-danger mb-3" style="max-width: 18rem;">
                            <div class="card-body text-danger">
                                <h4 class="card-title">Level III</h4>
                                <hr />
                                <p class="card-text">
                                    This is for experts. You can find here interesting hands and you don't get points, if there is the wrong declarer.
                                </p>
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