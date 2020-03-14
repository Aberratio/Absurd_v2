<?php
$con = mysqli_connect("sql8.netmark.pl", "filipmar_asia", "asia123", "filipmar_asia") or die("Connection was not established");

function search_user($user_name, $type)
{

	global $con;

	$get_user = 'SELECT * FROM bridgeplayers RIGHT JOIN training_groups ON id = id_second_player WHERE id_first_player = ' . $_SESSION["id"] . ' or id_second_player = ' . $_SESSION["id"] . '';

	$run_user = mysqli_query($con, $get_user);

	while ($row_user = mysqli_fetch_array($run_user)) {
		$user = $row_user['user'];
		$user_id = $row_user['id'];
		$profile_picture = $row_user['profile_picture'];

		if ($user != $user_name) {
			echo "
			<div class='card mb-4'>
			<div class='row no-gutters mt-2'>
				<div class='col-auto'>
					<form method='get' action='choose_bidding_set.php'>
						<input type='image' class='profile_picture' name='add' src='$profile_picture'>
						<input type='hidden' name='friend' value='$user_id'/>
						<input type='hidden' name='type' value='$type'/>
					</form>
				</div>
				<div class='col ml-1'>
					<div class='card-block px-2'>
						<h4 class='card-title font-weight-bold text-capitalize'>
							$user
						</h4>
						<p class='card-text'>
							Completed sets 7/11 <br />
							Points 123/200 <br />
							Your turn? YES 
						</p>
					</div>
				</div>
			</div>
		</div>
		";

			if (isset($_GET['add'])) {
				$update_query = 'SELECT DISTINCT bidding_sets.id_set from bidding_sets left join player_bidding_sets on bidding_sets.id_set = player_bidding_sets.id_set 
					where (first_user != 1 and second_user = 2) or (first_user != 2 and second_user = 1) or ((first_user != 2 and second_user != 1)
					and (first_user != 1 and second_user != 2)) or (first_user = 1 and second_user != 2) or (first_user = 2 and second_user != 1)
					or (first_user = null and second_user = null)';

				echo "<script>window.location.href = 'choose_bidding_set.php;</script>";
			}
		}
	}

	$get_user = 'SELECT * FROM bridgeplayers RIGHT JOIN training_groups ON id = id_first_player WHERE id_first_player = ' . $_SESSION["id"] . ' or id_second_player = ' . $_SESSION["id"] . '';

	$run_user = mysqli_query($con, $get_user);

	while ($row_user = mysqli_fetch_array($run_user)) {
		$user = $row_user['user'];
		$user_id = $row_user['id'];
		$profile_picture = $row_user['profile_picture'];

		if ($user != $user_name) {
			echo "
			<div class='card mb-4'>
			<div class='row no-gutters mt-2'>
				<div class='col-auto'>
				<form method='get' action='choose_bidding_set.php'>
					<input type='image' class='profile_picture' name='add' src='$profile_picture'>
					<input type='hidden' name='friend' value='$user_id'/>
					<input type='hidden' name='type' value='$type'/>
				</form>
				</div>
				<div class='col ml-1'>
					<div class='card-block px-2'>
						<h4 class='card-title font-weight-bold text-capitalize'>
							$user
						</h4>
						<p class='card-text'>
							Completed sets 7/11 <br />
							Points 123/200 <br />
							Your turn? YES 
						</p>
					</div>
				</div>
			</div>
		</div>
		";

			if (isset($_GET['add'])) {
				$update_query = 'SELECT DISTINCT bidding_sets.id_set from bidding_sets left join player_bidding_sets on bidding_sets.id_set = player_bidding_sets.id_set 
					where (first_user != 1 and second_user = 2) or (first_user != 2 and second_user = 1) or ((first_user != 2 and second_user != 1)
					and (first_user != 1 and second_user != 2)) or (first_user = 1 and second_user != 2) or (first_user = 2 and second_user != 1)
					or (first_user = null and second_user = null)';

				echo "<script>window.location.href = 'choose_bidding_set.php;</script>";
			}
		}
	}
}
