<?php
session_start();
include("get_test_details.php");

$test_id = $_GET['biddingtest'];
$test_number = $_GET['test_number'];

if (!isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatile" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>Absurd - Bridge Platform</title>
    <meta name="description" content="Strona do nauki gry w brydża">
    <meta name="keywords" content="brydż, licytacja, rozgrywka, bridge, absurd">
    <meta name="author" content="Joanna Kokot">

    <script src="https://kit.fontawesome.com/fe0a0fefeb.js" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <script type="text/javascript" src="js/biddingbox.js">

    </script>
</head>

<body>

    <header>
        <nav class="navbar navbar-dark bg-absurd-col-light navbar-expand-md">
            <a class="navbar-brand" href="menu.php">
                <img src="img/logo.png" widht="30" height="30" class="d-inline-block mr-1 align-bottom" alt="">
                Absurd
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainmenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="info.php">O stronie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Kontakt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            &nbsp;&nbsp;<img class='profile_picture' style='width:30px; height: 30px; border: 1px solid black; border-radius: 75%;' src='<?php echo $_SESSION['profile_picture']; ?>'>&nbsp;&nbsp;&nbsp;(<i><?php echo $_SESSION['user']; ?></i>) <b>Wyloguj</b></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <main>

        <div id="brigde_table">
            <div id="cards">
                <div style="text-align: center; font-size: 34px; margin-top: 20px;">Zadanie <?php echo $test_number; ?></div>
                <div class='player_turn'> Kolej gracza: <b style='color: rgb(251, 255, 0);'>
                        <div id="turn"><?php get_player($test_id); ?></div>
                    </b>
                </div>

                <?php get_hand($test_id); ?>

            </div>
            <div id="bidding">
                <table id="bidding_desk">
                    <td id="N" class="bidding_desk_column" style="padding: 3px; width: 150px;">S</td>
                    <td id="E" class="bidding_desk_column" style="padding: 3px; width: 150px;">W</td>
                    <td id="S" class="bidding_desk_column" style="padding: 3px; width: 150px;">N</td>
                    <td id="W" class="bidding_desk_column" style="padding: 3px; width: 150px;">E</td>

                </table>
                <div id="bidding_string"><?php get_bidding($test_id); ?></div>
            </div>
            <div id="biddingbox">
                <div id="biddingbox_top">
                </div>
                <div id="biddingbox_bottom">
                    <button type="submit" class="biddingbox_bottom_button"">&#10060;</button>
            <button type=" submit" class="biddingbox_bottom_button" onclick="declare(36)">PASS</button>
                    <button type="submit" class="biddingbox_bottom_button"">&#10060;&#10060;</button> <!-- blue XX--> 
            <button type=" submit" class="biddingbox_bottom_button biddingbox_bottom_button_back">&#128584;</button>

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