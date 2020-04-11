<?php

include("connect.php");

function get_user_table()
{
    global $con;
    $get_ranking_query = 'SELECT * from bridgeplayers where role = 3 or role = 2 order by user';

    $run_biddingtest = mysqli_query($con, $get_ranking_query);


    echo '
    <form method="post" action="administration.php">
    <table style="border-spacing:30px 0px;">
            <tr style="color: rgb(253, 197, 124);">
                <td style="padding-left: 7.5px; padding-right: 7.5px;"> Nazwa użytkownika </td>
                <td style="padding-left: 7.5px; padding-right: 7.5px;"> Rola </td>
                <td style="padding-left: 7.5px; padding-right: 0px;"> Zmień </td>
            <tr>    
    ';
    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $user_name = $row_biddingtest['user'];
        $user_role = $row_biddingtest['role'];
        $user_picture = $row_biddingtest['profile_picture'];
        echo '<tr>
            <td>
                <img class="profile_picture" style="width:40px; height: 40px; 
                border: 1px solid black; border-radius: 75%;" src="' . $user_picture . '">
            ' . $user_name . ' </td> 
            <td>';

        if ($user_role == 3) {
            echo 'Gracz </td>
                        <td>
                           <input type="checkbox" style="margin-left:40px;" name="player[]" value="' . $user_name . '"">
                        </td></tr>';
        }
        if ($user_role == 2) {
            echo 'Trener </td>
                        <td>
                            <input type="checkbox" style="margin-left:40px;" name="trainer[]" value="' . $user_name . '"">
                        </td></tr>';
        }
    }
    echo '</table>
        <button class="profile_view_button save_button" style="margin-top: 30px;" name="save">Wprowadź zmiany </button>
    </form>';
    update_user_table();
}

function update_user_table()
{
    global $con;
    if (isset($_POST['save'])) {
        foreach ($_POST['trainer'] as $val) {
            $update = "update bridgeplayers set role=3 where user='" . $val . "' and role=2";
            $run = mysqli_query($con, $update);
        }

        foreach ($_POST['player'] as $val) {
            $update = "update bridgeplayers set role=2 where user='" . $val . "' and role=3";
            $run = mysqli_query($con, $update);
        }

        echo "Zmieniono uprawnienia wybranym użytkownikom!";

        unset($_POST['save']);
    }
}
