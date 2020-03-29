<?php
$con = mysqli_connect("sql8.netmark.pl", "filipmar_asia", "asia123", "filipmar_asia") or die("Connection was not established");

function get_previous_bidding_page($test_number, $test, $friend)
{
    global $con;

    $get_test_query = 'SELECT * from bidding_tests JOIN player_bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test
        WHERE (player_bidding_tests.id_player_test = ' . $test . ')';

    $run_biddingtest = mysqli_query($con, $get_test_query);

    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $set_player_id = $row_biddingtest['id_player_set'];
        $set_id = $row_biddingtest['id_set'];
    }

    $get_tests = "SELECT COUNT(*) FROM `bidding_tests` JOIN bidding_sets ON bidding_tests.id_set = bidding_sets.id_set WHERE bidding_sets.id_set = $set_id";
    $test_counter = mysqli_query($con, $get_tests);
    $tests_in_set = mysqli_fetch_array($test_counter);

    if ($test_number == 1) {
        $test_number = $tests_in_set[0];
    } else {
        $test_number = $test_number - 1;
    }

    $get_previous_test = "SELECT * FROM `player_bidding_tests` JOIN bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test WHERE bidding_tests.test_number = " . $test_number . " AND player_bidding_tests.id_player_set = " . $set_player_id . "";
    $run_previous = mysqli_query($con, $get_previous_test);

    while ($row_biddingtest = mysqli_fetch_array($run_previous)) {
        $completed = $row_biddingtest['completed_test'];
        $test_main_id = $row_biddingtest['id_test'];
        $previous_test = $row_biddingtest['id_player_test'];
    }

    if ($completed == 1) {
        echo "<li class='page-item ml-2'><a href='points_table.php?test_main_id=" . $test_main_id . "&biddingtest=" . $previous_test . "&friend=" . $friend . "&type=0&test_number=" . $test_number . "&biddingset=" . $set_player_id . "' class=' btn btn-secondary text-decoration-none text-white'>Previous</a></li>";
    } else {
        echo "<li class='page-item ml-2'><a href='bidding_page.php?biddingtest=" . $previous_test . "&test_number=" . $test_number . "&friend=" . $friend . "&type=0&biddingset=" . $set_player_id . "' class='text-decoration-none text-white btn btn-secondary'>Previous</a></li>";
    }
}

function get_next_bidding_page($test_number, $test, $friend)
{
    global $con;

    $get_test_query = 'SELECT * from bidding_tests JOIN player_bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test
        WHERE (player_bidding_tests.id_player_test = ' . $test . ')';

    $run_biddingtest = mysqli_query($con, $get_test_query);

    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $set_player_id = $row_biddingtest['id_player_set'];
        $set_id = $row_biddingtest['id_set'];
    }

    $get_tests = "SELECT COUNT(*) FROM `bidding_tests` JOIN bidding_sets ON bidding_tests.id_set = bidding_sets.id_set WHERE bidding_sets.id_set = $set_id";
    $test_counter = mysqli_query($con, $get_tests);
    $tests_in_set = mysqli_fetch_array($test_counter);

    if ($test_number == $tests_in_set[0]) {
        $test_number = 1;
    } else {
        $test_number = $test_number + 1;
    }

    $get_previous_test = "SELECT * FROM `player_bidding_tests` JOIN bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test WHERE bidding_tests.test_number = " . $test_number . " AND player_bidding_tests.id_player_set = " . $set_player_id . "";
    $run_previous = mysqli_query($con, $get_previous_test);

    while ($row_biddingtest = mysqli_fetch_array($run_previous)) {
        $completed = $row_biddingtest['completed_test'];
        $test_main_id = $row_biddingtest['id_test'];
        $previous_test = $row_biddingtest['id_player_test'];
    }

    if ($completed == 1) {
        echo "<li class='page-item mr-2'><a href='points_table.php?test_main_id=" . $test_main_id . "&biddingtest=" . $previous_test . "&biddingset=" . $set_player_id . "&friend=" . $friend . "&type=0&test_number=" . $test_number . "' class='text-decoration-none text-white btn btn-secondary'>Next</a></li>";
    } else {
        echo "<li class='page-item mr-2'><a href='bidding_page.php?biddingtest=" . $previous_test . "&test_number=" . $test_number . "&biddingset=" . $set_player_id . "&friend=" . $friend . "&type=0' class='text-decoration-none text-white btn btn-secondary'>Next</a></li>";
    }
}
