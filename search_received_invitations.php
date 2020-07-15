<?php
session_start();
include("connect.php");
global $con;


if ($_SESSION['language'] == 1) {
    include("lang/lang_eng.php");
} else {
    include("lang/lang_pl.php");
}

$infos = new Infos();
$output = "";

$query = "SELECT * FROM invitations LEFT JOIN bridgeplayers ON bridgeplayers.id=invitations.id_first_user WHERE id_second_user=" . $_SESSION['id'] . " AND is_deleted='false' AND is_canceled='false' AND is_accepted='false'  ORDER BY date_of_invitation";
$result = mysqli_query($con, $query);
if (mysqli_num_rows($result) > 0) {
    $output .= '<div class="table-responsive">
                <table class="table table bordered">
                <tr>
                    <th></th>
                    <th>' . $infos->user . '</th>
                    <th>' . $infos->score . '</th>
                    <th>' . $infos->role . '</th>
                    <th></th>
                    <th></th>
                </tr>';
    while ($row = mysqli_fetch_array($result)) {

        $role = $infos->user;
        if ($row["role"] == 1) {
            $role = $infos->admin;
        } elseif ($row["role"]  == 2) {
            $role = $infos->trainer;
        }

        $output .= '
                        <tr>
                            <td>
                                <img class="profile_picture" style="width:40px; height: 40px; 
                                border: 1px solid black; border-radius: 75%;" src="' . $row["profile_picture"] . '">
                            </td>
                            <td>' . $row["user"] . '</td>
                            <td>' . $row["player_points"] . '</td>
                            <td>' . $role . '</td>
                            <td><a class="btn btn-primary" href="choose_partner_bidding.php?type=0&partner_id=' . $row["id"] . '&accept=true">' . $infos->accept . '</a></td>
                            <td><a class="btn btn-secondary" href="choose_partner_bidding.php?type=0&partner_id=' . $row["id"] . '&cancel=true">' . $infos->cancel . '</a></td>
                        </tr>';
    }
    $output .= "</table></div>";
    echo $output;
}
