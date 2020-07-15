<?php

include("connect.php");

function search_user($user_name, $type, $infos)
{
	global $con;
	$get_partners_count = 'SELECT * FROM bridgeplayers RIGHT JOIN training_groups ON id = id_second_player WHERE id_first_player = ' . $_SESSION["id"] . ' or id_second_player = ' . $_SESSION["id"] . '';
	$run_parners = mysqli_query($con, $get_partners_count);
	$partners = 0;

	while ($row_user = mysqli_fetch_array($run_parners)) {
		$partners++;
	}

	if ($partners > 0) {

		$get_user = 'SELECT * FROM bridgeplayers RIGHT JOIN training_groups ON id = id_second_player WHERE id_first_player = ' . $_SESSION["id"] . ' or id_second_player = ' . $_SESSION["id"] . '';

		$run_user = mysqli_query($con, $get_user);
		echo "
	<div class='table-responsive'>
        <table class='table table bordered'>
            <tr>
                <th></th>
                <th>" . $infos->user . "</th>
                <th>" . $infos->score . "</th>
                <th>" . $infos->visits . "</th>
                <th>" . $infos->last_login . "</th>
            </tr>
";
		while ($row_user = mysqli_fetch_array($run_user)) {
			$user = $row_user['user'];
			$user_id = $row_user['id'];
			$profile_picture = $row_user['profile_picture'];
			$points = $row_user['player_points'];
			$last_login = $row_user['last_login'];
			$visits = $row_user['visits'];

			if ($user != $user_name) {
				echo "
			<tr style='cursor: pointer;' class='clickable-row' data-href='choose_bidding_set.php?friend=$user_id&type=$type'>
			<td>
				<img class='profile_picture' style='width:40px; height: 40px; 
				border: 1px solid black; border-radius: 75%;' src='$profile_picture'>
			</td>
			<td> $user </td>
			<td> $points </td>
			<td> $visits </td>
			<td> $last_login </td>
		</tr>
		";
			}
		}


		$get_user = 'SELECT * FROM bridgeplayers RIGHT JOIN training_groups ON id = id_first_player WHERE id_first_player = ' . $_SESSION["id"] . ' or id_second_player = ' . $_SESSION["id"] . '';

		$run_user = mysqli_query($con, $get_user);

		while ($row_user = mysqli_fetch_array($run_user)) {
			$user = $row_user['user'];
			$user_id = $row_user['id'];
			$profile_picture = $row_user['profile_picture'];
			$points = $row_user['player_points'];
			$last_login = $row_user['last_login'];
			$visits = $row_user['visits'];

			if ($user != $user_name) {
				echo "
			<tr style='cursor: pointer;' class='clickable-row' data-href='choose_bidding_set.php?friend=$user_id&type=$type'>
			<td>
				<img class='profile_picture' style='width:40px; height: 40px; 
				border: 1px solid black; border-radius: 75%;' src='$profile_picture'>
			</td>
			<td> $user </td>
			<td> $points </td>
			<td> $visits </td>
			<td> $last_login </td>
		</tr>
		";
			}
		}

		echo "
	</table>
	</div>";
	} else {
		echo "<p> Nie masz partnerów. Zaproś kogoś do treningów!";
	}
}
