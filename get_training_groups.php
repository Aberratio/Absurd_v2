<?php
$con = mysqli_connect("sql8.netmark.pl", "filipmar_asia", "asia123", "filipmar_asia") or die("Connection was not established");

function get_group_table()
{
    global $con;

    $get_training_groups_query = 'SELECT * FROM training_groups RIGHT JOIN bridgeplayers ON id_trainer = id WHERE id_trainer = ' . $_SESSION["id"] . ';';

    $run_groups = mysqli_query($con, $get_training_groups_query);

    while ($row_biddingtest = mysqli_fetch_array($run_groups)) {
        $group_name = $row_biddingtest['group_name'];
        $first_player = $row_biddingtest['id_first_player'];
        $second_player = $row_biddingtest['id_second_player'];
        echo '
            <div>
                <p style="color: #5dbaf89c"> ' . $group_name . ' </p>
                <p> Gracz I -  <b style="color: rgb(179, 255, 144);">' . mysqli_fetch_array(mysqli_query($con, "SELECT * FROM bridgeplayers WHERE id=" . $first_player . ""))["user"] . '</b></p>
                <p> Gracz II -  <b style="color: rgb(179, 255, 144);">' . mysqli_fetch_array(mysqli_query($con, "SELECT * FROM bridgeplayers WHERE id=" . $second_player . ""))["user"] . ' </b></p>
               ';
        //    <form method="get"> 
        //         <input type="text" class="form-control" placeholder="Nazwa zestawu" name="set-name" /> 
        //         <button class="profile_view_button" style="margin-top: 30px;" name="add_btn' . $first_player . '' . $second_player . '");">Dodaj zestaw dla pary</button>
        //     </form>  
        echo '
                <a class="btn profile_view_button" style="margin-top: 30px; color: yellow;" href="choose_player_set.php?first_user=' . $first_player . '&second_user=' . $second_player . '&type=0");">Postępy</a>
                    ';
        if (isset($_GET['add_btn' . $first_player . '' . $second_player . ''])) {
            $id_set = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM bidding_sets WHERE set_name = '" . htmlentities($_GET['set-name']) . "'"))["id_set"];
            add_set($first_player, $second_player, $id_set);
        }

        echo '
        <hr style="height: 5px; background: rgb(247, 109, 109); border: 0px;">
            </div>     
        ';
    }

    echo '</table></div>';
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

    echo "Dodano zestaw dla podanej pary!";
}
