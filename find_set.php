<?php

include("connect.php");


function search_for_folders($friend_id, $type, $user_id, $infos)
{
	global $con;

	$get_folders = 'SELECT * FROM player_folders JOIN folders ON folders.id_folder = player_folders.id_folder WHERE type = ' . $type . ' AND  (id_first_player = ' . $friend_id . ' OR id_first_player = ' . $user_id . ') AND (id_second_player = ' . $friend_id . ' OR id_second_player = ' . $user_id . ')';

	$run_folders = mysqli_query($con, $get_folders);

	while ($row_biddingset = mysqli_fetch_array($run_folders)) {
		$id_folder = $row_biddingset['id_folder'];
		$folder_name = $row_biddingset['name'];
		if ($infos->level == "Level") {
			$description = $row_biddingset['description'];
		} else {
			$description = $row_biddingset['description_pl'];
		}
		$folder_level = $row_biddingset['folder_level'];

		echo '
		<div class="panel panel-default">
			<div class="panel-heading" role="tab" id="heading' . $id_folder . '">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
				<h4 class="panel-title text-capitalize">
					<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse' . $id_folder . '" aria-expanded="false" aria-controls="collapse' . $id_folder . '">
						' . $folder_name . '
					</a>
					<small class="text-info">
					' . $infos->level . ' ' . $folder_level . '
					</small>
				</h4>
				<p>' . $description . '</p>
			</div>
		<div id="collapse' . $id_folder . '" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading' . $id_folder . '">
			<div class="panel-body table-responsive">
				<table class="table table-striped">
					<thead>
						<tr>
							<th scope="col">' . $infos->set_name . '</th>
							<th scope="col">' . $infos->set_completed . '</th>
							<th scope="col">' . $infos->score . '</th>
							<th scope="col">' . $infos->comments . '</th>
						</tr>
					</thead>
					<tbody>
						' . search_set_in_folder($friend_id, $type, $id_folder, $user_id) . '
					</tbody>
				</table>
	
			</div>
		</div>
	</div>';
	}
}

function search_set_in_folder($friend_id, $type, $id_folder, $user_id)
{
	$result_string = "";

	global $con;
	$get_biddingset = 'SELECT player_bidding_sets.*, bidding_sets.*
		FROM player_bidding_sets JOIN bidding_sets ON player_bidding_sets.id_set = bidding_sets.id_set 
		WHERE set_type = ' . $type . ' AND (player_bidding_sets.first_user = ' . $friend_id . ' OR player_bidding_sets.second_user = ' . $friend_id . ') AND 
			(player_bidding_sets.first_user = ' . $user_id . ' OR player_bidding_sets.second_user = ' . $user_id . ') AND id_folder = ' . $id_folder . ';';

	$run_biddingset = mysqli_query($con, $get_biddingset);

	while ($row_biddingset = mysqli_fetch_array($run_biddingset)) {
		$biddingset = $row_biddingset['id_player_sets'];
		$set_id = $row_biddingset['id_set'];
		$setname = $row_biddingset['set_name'];
		$max = $row_biddingset['max_points'];

		$get_tests = "SELECT COUNT(*) FROM `bidding_tests` JOIN bidding_sets ON bidding_tests.id_set = bidding_sets.id_set WHERE bidding_sets.id_set = $set_id";
		$test_counter = mysqli_query($con, $get_tests);
		$zzz = mysqli_fetch_array($test_counter);

		$get_completed_tests = "SELECT COUNT(*) FROM player_bidding_tests JOIN player_bidding_sets ON player_bidding_tests.id_player_set = player_bidding_sets.id_player_sets WHERE player_bidding_sets.id_player_sets = $biddingset AND player_bidding_tests.completed_test = 1;";
		$completed_test_counter = mysqli_query($con, $get_completed_tests);
		$yyy =  mysqli_fetch_array($completed_test_counter);

		$get_comments = "SELECT COUNT(*) FROM player_bidding_tests JOIN player_bidding_sets ON player_bidding_tests.id_player_set = player_bidding_sets.id_player_sets JOIN comments ON comments.id_player_test = player_bidding_tests.id_player_test WHERE player_bidding_sets.id_player_sets = $biddingset;";
		$comments_counter = mysqli_query($con, $get_comments);
		$bbb =  mysqli_fetch_array($comments_counter);

		$get_new_comments = "SELECT COUNT(*) FROM player_bidding_tests JOIN player_bidding_sets ON player_bidding_tests.id_player_set = player_bidding_sets.id_player_sets JOIN comments ON comments.id_player_test = player_bidding_tests.id_player_test WHERE player_bidding_sets.id_player_sets = $biddingset AND comment_date  >= DATE(NOW()) - INTERVAL 7 DAY;";
		$new_comments_counter = mysqli_query($con, $get_new_comments);
		$ccc =  mysqli_fetch_array($new_comments_counter);

		$get_goints_in_set = "SELECT SUM(player_bidding_tests.points) FROM player_bidding_tests JOIN player_bidding_sets ON player_bidding_tests.id_player_set = player_bidding_sets.id_player_sets WHERE player_bidding_sets.id_player_sets = $biddingset AND player_bidding_tests.completed_test = 1;";
		$points_counter = mysqli_query($con, $get_goints_in_set);
		$aaa =  mysqli_fetch_array($points_counter);

		$result_string = $result_string . '<tr>
			<th>
			<a href="';

		if ($type == 0) {
			$result_string = $result_string . "choose_bidding_test.php?set=" . $biddingset . "&type=" . $type . "&friend=" . $friend_id . "";
		} else if ($type == 1) {
			$result_string = $result_string . "comp_test_page.php";
		}

		$result_string = $result_string . '
                ">
                    <h4 class="card-title font-weight-bold text-capitalize mr-3"> ' . $setname . ' </h4> 
                </a>
			</th>
            <th>
				<p class="font-weight-normal">
					' . $yyy[0] . ' / ' . $zzz[0] . ' 
				</p>
			</th>
			<th>
				<p class="font-weight-normal">
					' . round(($aaa[0] * 100) / $max) . '% 
				</p>
            </th>
			<th>
				<p class="font-weight-normal">
					' . $bbb[0] . ' <small class="text-danger"> ' . $ccc[0] . ' new </small>
				</p>
            </th>
        </tr>';
	}

	return $result_string;
}
