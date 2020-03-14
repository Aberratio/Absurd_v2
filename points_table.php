<?php
session_start();
include("get_test_details.php");

$test_id = $_GET['biddingtest'];
$test_main_id = $_GET['test_main_id'];
$test_number = $_GET['test_number'];

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

<body>
    <main>

        <div id="brigde_table">

            <div style="text-align: center; font-size: 34px; margin-top: 20px;">Zadanie <?php echo $test_number; ?></div>
            <p> <a href="ranking_test.php?test_id=<?php echo $test_main_id ?>"> Ranking </a> </p>
            <div id="cards">

                <div style="float: left;">
                    <?php get_both_hands($test_id); ?>
                </div>
                <div id="points_table" style="float: left; margin-left: 260px;">
                    <?php get_points_table($test_id); ?>
                </div>
            </div>

            <div style="clear: both;"> </div>

            <div id="bidding" style="float:left; margin-top: 50px;">
                <p>Licytacja pary</p>
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
                    Proponowana licytacja</a>

                <div id="biddingbox" style="display: none;">

                    <div id="biddingbox_top">
                    </div>
                    <div id="biddingbox_bottom">
                        <button type="submit" class="biddingbox_bottom_button"">&#10060;</button>
            <button type=" submit" class="biddingbox_bottom_button" onclick="declare(36)">PASS</button>
                        <button type="submit" class="biddingbox_bottom_button"">&#10060;&#10060;</button> <!-- blue XX--> 
            <button type=" submit" class="biddingbox_bottom_button biddingbox_bottom_button_back" onclick="declare(38)">&#128584;</button>

                    </div>
                    <?php update_bidding($test_id); ?>
                </div>
                <div style="clear: both;"> </div>
            </div>

    </main>


    <footer>

    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>