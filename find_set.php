<?php
$con = mysqli_connect("sql8.netmark.pl", "filipmar_asia", "asia123", "filipmar_asia") or die("Connection was not established");

function search_set($friend_id, $type)
{
	$user_id = $_SESSION['id'];
	global $con;
	$get_biddingset = 'SELECT player_bidding_sets.*, bidding_sets.*
		FROM player_bidding_sets JOIN bidding_sets ON player_bidding_sets.id_set = bidding_sets.id_set 
		WHERE set_type = ' . $type . ' AND (player_bidding_sets.first_user = ' . $friend_id . ' OR player_bidding_sets.second_user = ' . $friend_id . ') AND 
			(player_bidding_sets.first_user = ' . $user_id . ' OR player_bidding_sets.second_user = ' . $user_id . ');';


	$run_biddingset = mysqli_query($con, $get_biddingset);

	while ($row_biddingset = mysqli_fetch_array($run_biddingset)) {
		$biddingset = $row_biddingset['id_player_sets'];
		$set_id = $row_biddingset['id_set'];
		$completed = $row_biddingset['completed_set'];
		$turn = $row_biddingset['turn'];
		$setname = $row_biddingset['set_name'];

		echo "
			<div class='card mb-4'>
			<div class='row no-gutters mt-2'>
				<div class='col-auto'>
				<form class='d-inline' method='get' action=' 
				";
		if ($type == 0) {
			echo "choose_bidding_test.php";
		} else if ($type == 1) {
			echo "comp_test_page.php";
		}
		echo "
				'>
					<input type=hidden name='set' value='$biddingset'/>
					<input type=hidden name='type' value='$type'/>
					<input type=hidden name='friend' value='$friend_id'/>
					<input type='image' class='profile_picture' name='add' src='img/lvl1.png'>
				</form>
			</div>
			
				
				<div class='col ml-1'>
					<div class='card-block px-2'>
						<h4
							class='card-title font-weight-bold text-capitalize' name='add2'
						>
						$setname
						</h4>
						<p class='card-text'>
							Completed tests 23/40 <br />
							Your turn? YES <br />
							4 new comments  
						</p>
					</div>
				</div>
			</div></div><br><br>
			";

		if (isset($_GET['add2'])) {
			if ($type == 0) {
				echo "<script>window.location.href = 'choose_bidding_test.php';</script>";
			} else if ($type == 1) {
				echo "<script>window.location.href = 'comp_test_page.php';</script>";
			}
		}
	}
}

function search_pairs_set($first_player_id, $second_player_id, $type)
{
	global $con;
	$get_biddingset = 'SELECT player_bidding_sets.*, bidding_sets.*
		FROM player_bidding_sets JOIN bidding_sets ON player_bidding_sets.id_set = bidding_sets.id_set 
		WHERE set_type = ' . $type . ' AND (player_bidding_sets.first_user = ' . $second_player_id . ' OR player_bidding_sets.second_user = ' . $second_player_id . ') AND 
			(player_bidding_sets.first_user = ' . $first_player_id . ' OR player_bidding_sets.second_user = ' . $first_player_id . ');';


	$run_biddingset = mysqli_query($con, $get_biddingset);

	while ($row_biddingset = mysqli_fetch_array($run_biddingset)) {
		$biddingset = $row_biddingset['id_player_sets'];
		$set_id = $row_biddingset['id_set'];
		$completed = $row_biddingset['completed_set'];
		$turn = $row_biddingset['turn'];
		$setname = $row_biddingset['set_name'];

		echo "
			<div class='col-sm-4'>
                <img class='profile_picture' src='img/lvl1.png''>
				<form method='get' action=' 
				";
		if ($type == 0) {
			echo "choose_bidding_test.php";
		} else if ($type == 1) {
			echo "comp_test_page.php";
		}
		echo "
				'>
					<input type=hidden name='set' value='$biddingset'/>
					<input type=hidden name='type' value='$type'/>
					<input type=hidden name='friend' value='$second_player_id'/>
					<p><button class='profile_view_button' name='add2'>Rozwiąż <i>$setname</i></button></p>
					<p><a href='ranking_set.php?id_set=" . $set_id . "'>Ranking</a></p>
				</form>
			</div><br><br>
			";

		if (isset($_GET['add2'])) {
			if ($type == 0) {
				echo "<script>window.location.href = 'choose_bidding_test.php';</script>";
			} else if ($type == 1) {
				echo "<script>window.location.href = 'comp_test_page.php';</script>";
			}
		}
	}
}
