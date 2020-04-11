<?php
include("get_test_details.php");

include("connect.php");

function get_ranking_table()
{
    global $con;

    $get_ranking_query = 'SELECT * from bridgeplayers WHERE player_points > 0 order by player_points desc LIMIT 50';

    $run_biddingtest = mysqli_query($con, $get_ranking_query);

    $place = 1;
    $last_points = -1;
    echo '
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Points</th>
            </tr>
            </thead>  
            <tbody>
    ';
    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $user_name = $row_biddingtest['user'];
        $user_points = $row_biddingtest['player_points'];
        $user_picture = $row_biddingtest['profile_picture'];
        if ($last_points == $user_points) {
            echo '<tr>
            <th scope="row"></th>';
        } else {
            echo '<tr>
            <th scope="row">' . $place . '</th>';
        }
        echo '<td>
                <img class="profile_picture" style="width:40px; height: 40px; 
                border: 1px solid black; border-radius: 75%;" src="' . $user_picture . '">
            ' . $user_name . ' </td> 
            <td>' . $user_points . '</td>
        </tr>';
        $place = $place + 1;
        $last_points = $user_points;
    }

    echo '</tbody>
    </table>';
}

function get_ranking_test_table($test_id)
{
    global $con;

    $get_ranking_query = 'SELECT * FROM `player_bidding_tests` WHERE `id_test` = ' . $test_id . ' AND `completed_test` = 1 ORDER BY `points` DESC LIMIT 50';

    $run_biddingtest = mysqli_query($con, $get_ranking_query);

    $place = 1;

    echo '
    <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">User</th>
                <th scope="col">Points</th>
            </tr>
            </thead>  
            <tbody>
    ';
    $last_points = -1;

    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $first_user_id = $row_biddingtest['first_player'];
        $second_user_id = $row_biddingtest['second_player'];
        $points = $row_biddingtest['points'];
        $first = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bridgeplayers WHERE id = "' . $first_user_id . '"'));
        $second = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bridgeplayers WHERE id = "' . $second_user_id . '"'));

        if ($last_points == $points) {
            echo '<tr>
            <th scope="row"></th>';
        } else {
            echo '<tr>
            <th scope="row">' . $place . '</th>';
        }
        echo '<td>
                <img class="profile_picture" style="width:40px; height: 40px; 
                border: 1px solid black; border-radius: 75%;" src="' . $first['profile_picture'] . '">
            ' . $first['user'] . ' </td> 
                <td><a target="bidding" href="player_bidding_pop.php?biddingtest=' . $test_id . '&id_first=' . $first_user_id . '&id_second=' . $second_user_id . '">
                ' . $points . '</a></td>
        </tr>
        <tr>
            <td style="color: rgb(179, 255, 144);"></td>
            <td>
                <img class="profile_picture" style="width:40px; height: 40px; 
                border: 1px solid black; border-radius: 75%;" src="' . $second['profile_picture'] . '">
            ' . $second['user'] . ' </td> 
            <td></td>
        </tr>
        ';

        $place = $place + 1;
        $last_points = $points;
    }

    echo '</tbody>
    </table>';
}


function get_ranking_set_table($set_id)
{
    global $con;

    $get_ranking_query = 'SELECT * FROM `player_bidding_sets` WHERE `id_set` = ' . $set_id . ' ORDER BY `points` DESC LIMIT 50';

    $run_biddingtest = mysqli_query($con, $get_ranking_query);

    $place = 1;

    echo '
    <div class="">
    <table style="border-spacing:30px 0px;">
            <tr style="color: rgb(253, 197, 124);">
                <td style="padding-left: 0px; padding-right: 7.5px;"> Miejsce </td>
                <td style="padding-left: 7.5px; padding-right: 7.5px;"> Nazwa użytkownika </td>
                <td style="padding-left: 7.5px; padding-right: 0px;"> Punkty </td>
            <tr>    
    ';
    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $first_user_id = $row_biddingtest['first_player'];
        $second_user_id = $row_biddingtest['second_player'];
        $points = $row_biddingtest['points'];
        $first = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bridgeplayers WHERE id = "' . $first_user_id . '"'));
        $second = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bridgeplayers WHERE id = "' . $second_user_id . '"'));

        echo '<tr>
            <td style="color: rgb(179, 255, 144);">' . $place . '</td>
            <td>
                <img class="profile_picture" style="width:40px; height: 40px; 
                border: 1px solid black; border-radius: 75%;" src="' . $first['profile_picture'] . '">
            ' . $first['user'] . ' </td> 
            <td>' . $points . '</td>
        </tr>
        <tr>
            <td style="color: rgb(179, 255, 144);"></td>
            <td>
                <img class="profile_picture" style="width:40px; height: 40px; 
                border: 1px solid black; border-radius: 75%;" src="' . $second['profile_picture'] . '">
            ' . $second['user'] . ' </td> 
            <td></td>
        </tr>

        ';

        $place = $place + 1;
    }

    echo '</table></div>';
}
