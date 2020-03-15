<?php
$con = mysqli_connect("sql8.netmark.pl", "filipmar_asia", "asia123", "filipmar_asia") or die("Connection was not established");

function get_hand($test)
{
    global $con;

    $get_test_query = 'SELECT * from bidding_tests JOIN player_bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test
        WHERE (player_bidding_tests.id_player_test = ' . $test . ')';

    $run_biddingtest = mysqli_query($con, $get_test_query);

    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $first = $row_biddingtest['first_player'];
        echo '<b><div class="hand m-auto" id="hand" style="display: table;">';

        if ($first == $_SESSION['id']) {
            echo 'N';
            $cards_view = $row_biddingtest['N_hand'];
        } else {
            echo 'S';
            $cards_view = $row_biddingtest['S_hand'];
        }
        echo '</div></b>';

        get_cards_on_hand($cards_view);
    }
}

function get_both_hands($test)
{
    global $con;

    $get_test_query = 'SELECT * from bidding_tests JOIN player_bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test
        WHERE (player_bidding_tests.id_player_test = ' . $test . ')';

    $run_biddingtest = mysqli_query($con, $get_test_query);

    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $first_user = $row_biddingtest['first_player'];
        $second_user = $row_biddingtest['second_player'];

        $first = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bridgeplayers WHERE id = "' . $first_user . '"'));
        $second = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bridgeplayers WHERE id = "' . $second_user . '"'));
        echo '<b"><div class="hand m-auto" id="hand">';

        echo 'N (' . $second['user'] . ')';
        get_cards_on_hand($row_biddingtest['S_hand']);

        echo 'S (' . $first['user'] . ')';
        get_cards_on_hand($row_biddingtest['N_hand']);
        echo '</div></b>';
    }
}

function get_cards_on_hand($cards_view)
{
    $card_div = explode(";", $cards_view);

    echo '
            <div class="card_table_view m-auto" style="display: table;">
                <table>
                <tr>
                    <td style="color:blue">&spades;</td>
                    <td class="cards_view spades">' . $card_div[0] . '</td>
                </tr>
                <tr>
                    <td style="color:red">&hearts;</td>
                    <td class="cards_view hearts">' . $card_div[1] . '</td>
                </tr>
                <tr>
                    <td style="color:orange">&diams;</td>
                    <td class="cards_view diamonds">' . $card_div[2] . '</td>
                </tr>
                <tr>
                    <td style="color:green">&clubs;</td>
                    <td class="cards_view clubs">' . $card_div[3] . '</td>
                </tr>
                </table> 
            </div>   
            ';
}


function get_bidding($test)
{
    global $con;

    $get_test_query = 'SELECT * from bidding_tests JOIN player_bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test
        WHERE (player_bidding_tests.id_player_test = ' . $test . ')';

    $run_biddingtest = mysqli_query($con, $get_test_query);

    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $bidding_string = $row_biddingtest['bidding_string'];
        echo $bidding_string;
    }
}


function get_right_bidding($test)
{
    global $con;

    $get_test_query = 'SELECT * from bidding_tests JOIN player_bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test
        WHERE (player_bidding_tests.id_player_test = ' . $test . ')';

    $run_biddingtest = mysqli_query($con, $get_test_query);

    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {

        $id_test = $row_biddingtest['id_test'];

        $get_good_test_query = 'SELECT * from bidding_tests JOIN player_bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test
			WHERE (player_bidding_tests.id_test = ' . $id_test . ') and (((first_player = 26) and (second_player = 27))  or ((first_player = 27) and (second_player = 26))) and completed_test = 1';

        $run_good_biddingtest = mysqli_query($con, $get_good_test_query);

        while ($row_good_biddingtest = mysqli_fetch_array($run_good_biddingtest)) {
            $bidding_string = $row_good_biddingtest['bidding_string'];
            echo $bidding_string;
        }
    }
}


function get_player_bidding($test, $id_first, $id_second)
{
    global $con;

    $get_test_query = 'SELECT * from bidding_tests JOIN player_bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test
        WHERE (player_bidding_tests.id_player_test = ' . $test . ')';

    $run_biddingtest = mysqli_query($con, $get_test_query);

    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {

        $id_test = $row_biddingtest['id_test'];

        $get_good_test_query = 'SELECT * from bidding_tests JOIN player_bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test
			WHERE (bidding_tests.id_test = ' . $test . ') and (((first_player = ' . $id_first . ') and (second_player = ' . $id_second . '))  or ((first_player = ' . $id_second . ') and (second_player = ' . $id_first . '))) and completed_test = 1';

        $run_good_biddingtest = mysqli_query($con, $get_good_test_query);

        while ($row_good_biddingtest = mysqli_fetch_array($run_good_biddingtest)) {
            $bidding_string = $row_good_biddingtest['bidding_string'];
            echo $bidding_string;
        }
    }
}

function get_player($test)
{
    global $con;

    $get_test_query = 'SELECT * from bidding_tests JOIN player_bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test
        WHERE (player_bidding_tests.id_player_test = ' . $test . ')';

    $run_biddingtest = mysqli_query($con, $get_test_query);

    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $bidding_string = $row_biddingtest['bidding_person'];
        if ($bidding_string == 2) {
            echo "N";
        } else {
            echo "S";
        }
    }
}

function count_points($point_string, $contract, $first_player, $second_player)
{
    $punctation = explode(";", $point_string);
    $points_for_pair = 0;
    global $con;

    foreach ($punctation as $value) {
        $point_item = explode("=", $value);
        if ($contract == $point_item[0]) {
            $points_for_pair = $point_item[1];
        }
    }

    $insert = 'UPDATE bridgeplayers SET player_points = player_points + ' . $points_for_pair . ' WHERE id = ' . $first_player . ' or id = ' . $second_player . '';
    mysqli_query($con, $insert);

    return $points_for_pair;
}

function get_points_table($test)
{
    global $con;

    $get_test_query = 'SELECT * from bidding_tests JOIN player_bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test
        WHERE (player_bidding_tests.id_player_test = ' . $test . ')';

    $run_biddingtest = mysqli_query($con, $get_test_query);

    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $point_string = $row_biddingtest['point_string'];

        echo $point_string;
    }
}

function update_bidding($test)
{
    global $con;

    $get_test_query = 'SELECT * from bidding_tests JOIN player_bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test
        WHERE (player_bidding_tests.id_player_test = ' . $test . ')';

    $run_biddingtest = mysqli_query($con, $get_test_query);

    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $player_set = $row_biddingtest['id_player_set'];
        $last_person = $row_biddingtest['bidding_person'];
        $point_string = $row_biddingtest['point_string'];
        $first_player = $row_biddingtest['first_player'];
        $second_player = $row_biddingtest['second_player'];
        $test_number = $row_biddingtest['test_number'];

        echo "
        <form id='send_bidding' method='get'>
            <input type='hidden' name='send_button' id='send_button' class='biddingbox_bottom_button  biddingbox_bottom_button_send' action='menu.php' />
            <input type='hidden' name='set' value='$player_set' />
            <input type='hidden' name='type' value='0' />
            <input type='hidden' name='biddingtest' value='$test' />
            <input type='hidden' name='test_number' value='$test_number' />
            <input type='hidden' name='new_bidding_string' id='new_bidding_string' value='' />
        </form>
		";

        if (isset($_GET['send_button'])) {
            $bidding_string = $_GET['new_bidding_string'];
            $bids = explode(";", $bidding_string);
            $completed_flag = "false";
            $points = 0;

            if (($bids[count($bids) - 1] == "36") and (count($bids) > 2)) {
                $completed_flag = "true";
                $points = count_points($point_string, $bids[count($bids) - 2], $first_player, $second_player);
            }

            if ($last_person == 1) {
                $last_person = 2;
            } else {
                $last_person = 1;
            }

            $friend = 0;
            if ($first_player == $_SESSION['id']) {
                $friend = $second_player;
            } else {
                $friend = $first_player;
            }

            $insert = 'UPDATE player_bidding_tests SET bidding_string = "' . $bidding_string . '", completed_test = ' . $completed_flag . ', bidding_person = ' . $last_person . ', points = ' . $points . ' WHERE (id_player_test = ' . $test . ') ';
            mysqli_query($con, $insert);




            echo "<script>window.location.href = 'choose_bidding_test.php?set=" . $_GET['set'] . "&friend=" . $friend . "&type=0';</script>";
        }
    }
}
