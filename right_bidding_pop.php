<?php
session_start();
include("get_test_details.php");

$test_id = $_GET['biddingtest'];

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


    <title>Absurd - platforma licytacyjna</title>
    <meta name="description" content="Strona do nauki gry w brydża">
    <meta name="keywords" content="brydż, licytacja, rozgrywka, bridge, absurd">
    <meta name="author" content="Joanna Kokot">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">

    <script type="text/javascript" src="js/biddingbox.js">

    </script>
</head>

<body>

    <main>

        <div id="brigde_table">
            <p>Proponowana licytacja</p>
            <table id="bidding_desk">
                <td id="N" class="bidding_desk_column" style="padding: 3px; width: 150px;">N</td>
                <td id="E" class="bidding_desk_column" style="padding: 3px; width: 150px;">E</td>
                <td id="S" class="bidding_desk_column" style="padding: 3px; width: 150px;">S</td>
                <td id="W" class="bidding_desk_column" style="padding: 3px; width: 150px;">W</td>

            </table>
            <div id="bidding_string"><?php get_right_bidding($test_id); ?></div>
        </div>

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