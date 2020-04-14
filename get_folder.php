<?php

include("connect.php");

function get_folder_table()
{
    global $con;

    $get_training_groups_query = 'SELECT * FROM training_groups RIGHT JOIN bridgeplayers ON id_trainer = id WHERE id_trainer = ' . $_SESSION["id"] . ';';

    $run_groups = mysqli_query($con, $get_training_groups_query);

    while ($row_biddingtest = mysqli_fetch_array($run_groups)) {
        $group_name = $row_biddingtest['group_name'];
        $first_player = $row_biddingtest['id_first_player'];
        $second_player = $row_biddingtest['id_second_player'];
        echo '
        <tr>
            <th>
                <a href="tournament_creator.php">
                    <h4 class="card-title font-weight-bold text-capitalize mr-2"> Turniej na rozpoczęcie sezonu  <small style="color: gray;">24 boards / Level 1</small></h4> 
                        <p class="font-weight-normal">
                            jakis opis jakis opis jakis opis jakis opis jakis opis jakis opis jakis opis jakis opis jakis opis jakis opis jakis opis
                        </p>
                </a>
            </th>
            <th>
                <i class="fas fa-trash-alt ml-2 btn-block"></i>
                <i class="fas fa-edit ml-2 btn-block"></i>
                <i class="fas fa-download ml-2 btn-block">LIN</i>
                <i class="fas fa-download ml-2 btn-block">PBN</i>
            </th>
        </tr>';
    }
}

function get_quiz_folder_table($id_folder)
{
    global $con;

    $get_training_groups_query = 'SELECT * FROM folders JOIN bidding_sets ON folders.id_folder = bidding_sets.id_folder WHERE folders.id_folder = ' . $id_folder . ';';

    $run_groups = mysqli_query($con, $get_training_groups_query);

    while ($row_biddingtest = mysqli_fetch_array($run_groups)) {
        $group_name = $row_biddingtest['group_name'];
        $first_player = $row_biddingtest['id_first_player'];
        $second_player = $row_biddingtest['id_second_player'];
        echo '
        <tr>
            <th>
                <a href="tournament_creator.php">
                    <h4 class="card-title font-weight-bold text-capitalize mr-2"> Turniej na rozpoczęcie sezonu  <small style="color: gray;">24 boards / Level 1</small></h4> 
                        <p class="font-weight-normal">
                            jakis opis jakis opis jakis opis jakis opis jakis opis jakis opis jakis opis jakis opis jakis opis jakis opis jakis opis
                        </p>
                </a>
            </th>
            <th>
                <i class="fas fa-trash-alt ml-2 btn-block"></i>
                <i class="fas fa-edit ml-2 btn-block"></i>
                <i class="fas fa-download ml-2 btn-block">LIN</i>
                <i class="fas fa-download ml-2 btn-block">PBN</i>
            </th>
        </tr>';
    }
}


function add_set($first_player, $second_player, $set_id)
{
    global $con;
    $add_player_set = "INSERT INTO `player_bidding_sets`(`id_player_sets`, `first_user`, `second_user`, `completed_set`, `id_set`, `turn`) VALUES (0," . $first_player . "," . $second_player . ",0," . $set_id . ",1)";
    mysqli_query($con, $add_player_set);

    $id_player_set = 0;
    $get_player_sets = "SELECT * FROM `player_bidding_sets` WHERE `first_user` = " . $first_player . " and `second_user` = " . $second_player . " and `id_set` = " . $set_id . "";
    $run_sets = mysqli_query($con, $get_player_sets);
    while ($row_biddingset = mysqli_fetch_array($run_sets)) {
        $id_player_set = $row_biddingset['id_player_sets'];
    }

    $get_tests_from_set = "SELECT * FROM `bidding_tests` WHERE `id_set` = " . $set_id . "";
    $run_tests = mysqli_query($con, $get_tests_from_set);
    $helper = true;
    while ($row_biddingtest = mysqli_fetch_array($run_tests)) {
        $test_id = $row_biddingtest['id_test'];
        if ($helper) {
            $add_player_test = "INSERT INTO `player_bidding_tests`(`id_player_test`, `first_player`, `second_player`, `completed_test`, `points`, `id_test`, `bidding_string`, `bidding_person`, `id_player_set`) VALUES (0," . $first_player . "," . $second_player . ",0,0," . $test_id . ",'-1',1," . $id_player_set . ")";
        } else {
            $add_player_test = "INSERT INTO `player_bidding_tests`(`id_player_test`, `first_player`, `second_player`, `completed_test`, `points`, `id_test`, `bidding_string`, `bidding_person`, `id_player_set`) VALUES (0," . $second_player . "," . $first_player . ",0,0," . $test_id . ",'-1',1," . $id_player_set . ")";
        }
        mysqli_query($con, $add_player_test);
        $helper = !$helper;
    }

    echo "Set added!";
}
