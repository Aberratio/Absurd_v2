<?php
session_start();
include("get_test_details.php");
include("get_next_bidding_page.php");

$test_id = $_GET['biddingtest'];
$test_main_id = $_GET['test_main_id'];
$test_number = $_GET['test_number'];
$friend = $_GET['friend'];

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
                            <ul class="pagination pagination-sm justify-content-between mb-0">
                                <?php get_previous_bidding_page($test_number, $test_id, $friend); ?>
                                <li>Points - Problem <?php echo $test_number; ?></li>
                                <?php get_next_bidding_page($test_number, $test_id, $friend); ?>
                            </ul>
                        </h4>
                        <div class="option_container mx-3 mt-2">
                            <div class="option">

                                <!-- POINTS PAGE <div class='col-auto'> -->
                                <div class="card mb-4">
                                    <div class="row no-gutters mt-2">
                                        <div class='col ml-1'>
                                            <div class='card-block px-2' style="display: table;">
                                                <h4>
                                                    <a href="ranking_test.php?test_id=<?php echo $test_main_id ?>"> Ranking </a>
                                                </h4>
                                                <p class='card-text'>
                                                    <?php get_both_hands($test_id); ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div id="points_table" style="float: left; margin-left: 30px;">
                                            <?php get_points_table($test_id); ?>
                                        </div>

                                        <div style="clear: both;"> </div>

                                        <div id="bidding" style="float:left; margin-top: 50px;">
                                            <p>Our bidding</p>
                                            <table id="bidding_desk">
                                                <td id="N" class="bidding_desk_column" style="padding: 3px; width: 150px;">N</td>
                                                <td id="E" class="bidding_desk_column" style="padding: 3px; width: 150px;">E</td>
                                                <td id="S" class="bidding_desk_column" style="padding: 3px; width: 150px;">S</td>
                                                <td id="W" class="bidding_desk_column" style="padding: 3px; width: 150px;">W</td>

                                            </table>
                                            <div id="bidding_string"><?php get_bidding($test_id); ?></div>
                                        </div>

                                        <div id="bidding" style="float:left; margin-top: 50px;">

                                            <a target="bidding" href="right_bidding_pop.php?biddingtest=$test_id" onclick="window.open('right_bidding_pop.php?biddingtest=<?php echo $test_id; ?>', 'Right bidding').focus(); return false">
                                                Proposed bidding</a>

                                            <div id="biddingbox" style="display: none;">

                                                <div id="biddingbox_top">
                                                </div>
                                                <div id="biddingbox_bottom">
                                                    <button type="submit" class="biddingbox_bottom_button"">&#10060;</button>
                                                        <button type=" submit" class="biddingbox_bottom_button" onclick="declare(36)">PASS</button>
                                                    <button type="submit" class="biddingbox_bottom_button"">&#10060;&#10060;</button> <!-- blue XX--> 
                                                        <button type=" submit" class="biddingbox_bottom_button biddingbox_bottom_button_back" onclick="declare(37)">&#128584;</button>

                                                </div>
                                                <?php update_player_bidding($test_id, $friend); ?>
                                            </div>
                                            <div style="clear: both;"> </div>
                                        </div>


                                    </div>
                                </div>
                                <!-- POINTS PAGE END-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- NEWS -->
            <div class="col-sm-10 col-md-6 col-lg-4 mx-auto">
                <div class="container mt-5">
                    <div class="card">
                        <h4 class="d-block text-center py-2 mt-2 mx-3 text-capitalize">
                            News
                        </h4>
                        <hr class="hr-dark py-3" />

                        <div class="card mx-auto mb-3 border-danger mb-3" style="max-width: 18rem;">
                            <div class="card-body text-danger">
                                <p class="card-text">
                                    Some quick example text to build on the card title and make
                                    up the bulk of the card's content.
                                </p>
                            </div>
                        </div>

                        <div class="card mx-auto mb-3 border-warning mb-3" style="max-width: 18rem;">
                            <div class="card-body text-warning">
                                <p class="card-text">
                                    Some quick example text to build on the card title and make
                                    up the bulk of the card's content.
                                </p>
                            </div>
                        </div>
                        <div class="card mx-auto mb-3 border-info mb-3" style="max-width: 18rem;">
                            <div class="card-body text-info">
                                <p class="card-text">
                                    Some quick example text to build on the card title and make
                                    up the bulk of the card's content.
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