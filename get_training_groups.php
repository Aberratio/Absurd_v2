<?php

include("connect.php");


function get_group_table($infos)
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
                <h4 class="text-capitalize"> ' . $group_name . ' </h4>
                <p> ' . $infos->user . ' I -  <i>' . mysqli_fetch_array(mysqli_query($con, "SELECT * FROM bridgeplayers WHERE id=" . $first_player . ""))["user"] . '</i></p>
                <p> ' . $infos->user . ' II -  <i>' . mysqli_fetch_array(mysqli_query($con, "SELECT * FROM bridgeplayers WHERE id=" . $second_player . ""))["user"] . ' </i></p>
            </th>
            <th>
                <form method="get">
                <div class="form-group">
                    <select class="form-control" id="sel1" name="folder_id">
                        ' . get_folders_list() . '
                    </select>
                </div>

                <button class="btn btn-secondary mt-3 btn-block mt-2" name="add_btn' . $first_player . '' . $second_player . '");">' . $infos->add_folder . '</button>
                </form>  
            </th>
            <th>
                <a class="btn btn-primary mt-3 btn-block"
                href="choose_player_set.php?first_user=' . $first_player . '&second_user=' . $second_player . '&type=0");">' . $infos->show . '</a>
            </th>  
        </tr>';

        if (isset($_GET['add_btn' . $first_player . '' . $second_player . ''])) {

            $get_sets_amount_in_folder = "SELECT COUNT(*) FROM `folders` JOIN player_folders ON folders.id_folder = player_folders.id_folder LEFT JOIN bidding_sets ON bidding_sets.id_folder = player_folders.id_folder WHERE folders.id_folder = " . $_GET['folder_id'] . " AND 
            ((id_first_player = $first_player OR id_first_player = $second_player) AND (id_second_player = $first_player OR id_second_player = $second_player))";

            $player_folder_counter = mysqli_query($con, $get_sets_amount_in_folder);
            $counter = mysqli_fetch_array($player_folder_counter);

            if ($counter[0] == 0) {

                $get_sets_in_folder = "SELECT * FROM `folders` LEFT JOIN bidding_sets ON bidding_sets.id_folder = folders.id_folder WHERE folders.id_folder = " . $_GET['folder_id'] . "";

                $run_sets = mysqli_query($con, $get_sets_in_folder);

                while ($row_biddingset = mysqli_fetch_array($run_sets)) {
                    $id_set = $row_biddingset['id_set'];

                    add_set($first_player, $second_player, $id_set);
                }

                add_folder($first_player, $second_player, $_GET['folder_id'], $infos);
            } else {
                echo $infos->already_have_folder;
            }
        }
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
}


function add_folder($first_player, $second_player, $folder_id, $infos)
{
    global $con;

    $add_player_set = "INSERT INTO `player_folders`(`id_player_folder`, `id_folder`, `id_first_player`, `id_second_player`) VALUES (0," . $folder_id . "," . $first_player . "," . $second_player . ")";
    mysqli_query($con, $add_player_set);

    echo $infos->folder_added;
}

function get_folders_list()
{
    $option_string = "";

    global $con;
    $get_folders = "SELECT * FROM folders WHERE id_folder < 3";
    $run_folders = mysqli_query($con, $get_folders);
    while ($row_folders = mysqli_fetch_array($run_folders)) {
        $id_folder = $row_folders['id_folder'];
        $name = $row_folders['name'];

        $option_string = $option_string . "<option value='" . $id_folder . "'>" . $name . "</option>";
    }

    return $option_string;
}
