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

$output = '';
if (isset($_POST["query"])) {
    $search = mysqli_real_escape_string($con, $_POST["query"]);
    $query = "
        SELECT * FROM bridgeplayers 
        LEFT JOIN invitations
        ON bridgeplayers.id = invitations.id_second_user
        LEFT JOIN training_groups
        ON training_groups.id_first_player = bridgeplayers.id 
        WHERE user LIKE '%" . $search . "%' AND  id != " . $_SESSION['id'] . " AND (id_first_user IS NULL OR id_first_user != " . $_SESSION['id'] . ")
        GROUP BY id, id_second_user
        ORDER BY user LIMIT 5
    ";
} else {
    $query = "
        SELECT * FROM bridgeplayers 
        LEFT JOIN invitations 
        ON bridgeplayers.id = invitations.id_second_user
        LEFT JOIN training_groups
        ON training_groups.id_first_player = bridgeplayers.id
        WHERE id != " . $_SESSION['id'] . " AND (id_first_user IS NULL OR id_first_user != " . $_SESSION['id'] . ")
        GROUP BY id, id_second_user 
        ORDER BY user LIMIT 5";
}
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
            </tr>';
    while ($row = mysqli_fetch_array($result)) {

        $get_comments = "SELECT COUNT(*) FROM bridgeplayers 
            JOIN training_groups
            ON training_groups.id_second_player = bridgeplayers.id
            WHERE (id_first_player = " . $row['id'] . " and id_second_player = " . $_SESSION['id'] . ") or (id_first_player = " . $_SESSION['id'] . " and id_second_player = " . $row['id'] . ")";
        $comments_counter = mysqli_query($con, $get_comments);
        $bbb =  mysqli_fetch_array($comments_counter);

        if ($bbb[0] == 0) {
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
                <td><button data-toggle="modal" data-target="#exampleModalCenter' . $row["id"] . '" class="btn btn-primary btn-block">' . $infos->invite . '</button></td>
            </tr>

            <!-- Modal -->
            <div class="modal fade" id="exampleModalCenter' . $row["id"] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">' . $infos->send_invite_to_user . '</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <img src="' . $row["profile_picture"] . '" class="profile_picture rounded float-left" alt="Responsive image">
                            <div class="float-left"> 
                                <b class="ml-3">' . $infos->user . ': </b> <i>' . $row["user"] . '</i> <br />
                                <b class="ml-3">' . $infos->score . ': </b> <i>' . $row["player_points"] . '</i> <br />
                                <b class="ml-3">' . $infos->role . ': </b> <i>' . $role . '</i>
                            </div>
                        </div>
                        <div class="modal-footer">
                        <a class="btn btn-secondary" href="choose_partner_bidding.php?type=0&partner_id=' . $row["id"] . '&invite=true">' . $infos->invite . '</a>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">' . $infos->close . '</button>
                        </div>
                    </div>
                </div>
            </div>
            ';
        }
    }
    $output .= "</table></div>";
    echo $output;
} else {
    echo 'Data Not Found';
}
