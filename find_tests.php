<?php

include("connect.php");

function search_test($set, $friend)
{
	if ($set != 0) {
		global $con;

		$get_tests = 'SELECT * from bidding_tests JOIN player_bidding_tests ON bidding_tests.id_test = player_bidding_tests.id_test
			RIGHT JOIN bridgeplayers ON player_bidding_tests.first_player =  bridgeplayers.id
			WHERE (player_bidding_tests.id_player_set = ' . $set . ') AND (bridgeplayers.id = ' . $friend . ' or player_bidding_tests.second_player = ' . $friend . ') order by completed_test, test_number';

		$run_biddingtest = mysqli_query($con, $get_tests);

		while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
			$biddingtest = $row_biddingtest['id_player_test'];
			$test_main_id = $row_biddingtest['id_test'];
			$completed = $row_biddingtest['completed_test'];
			$turn = $row_biddingtest['bidding_person'];
			$points = $row_biddingtest['points'];
			$point_string = $row_biddingtest['point_string'];
			$bidding_string = $row_biddingtest['bidding_string'];
			$test_number = $row_biddingtest['test_number'];

			if ($turn == 2) {
				$bidding_person = $row_biddingtest['first_player'];
			} else {
				$bidding_person = $row_biddingtest['second_player'];
			}

			$src = 'img/done.png';


			$get_comments = "SELECT COUNT(*) FROM player_bidding_tests JOIN comments ON comments.id_player_test = player_bidding_tests.id_player_test WHERE comments.id_player_test = $biddingtest;";
			$comments_counter = mysqli_query($con, $get_comments);
			$bbb =  mysqli_fetch_array($comments_counter);

			$get_new_comments = "SELECT COUNT(*) FROM player_bidding_tests JOIN comments ON comments.id_player_test = player_bidding_tests.id_player_test WHERE comments.id_player_test = $biddingtest AND comment_date  >= DATE(NOW()) - INTERVAL 7 DAY;";
			$new_comments_counter = mysqli_query($con, $get_new_comments);
			$ccc =  mysqli_fetch_array($new_comments_counter);

			if (!$completed) {
				$get_pic = 'SELECT * from bridgeplayers where id = ' . $bidding_person . '';
				$run_pic = mysqli_query($con, $get_pic);

				while ($row_pic = mysqli_fetch_array($run_pic)) {
					$src = $row_pic['profile_picture'];
				}
			}
			$c = explode("=", $point_string);
			$d = explode(";", $c[1]);

			if ($completed) {
				echo '
					<tr style="cursor: pointer;" class="clickable-row" data-href="points_table.php?biddingtest=' . $biddingtest . '&biddingset=' . $set . '&test_main_id=' . $test_main_id . '&test_number=' . $test_number . '&friend=' . $friend . '">';
			} else {
				echo '
					<tr style="cursor: pointer;" class="clickable-row" data-href="bidding_page.php?biddingtest=' . $biddingtest . '&biddingset=' . $set . '&test_number=' . $test_number . '&friend=' . $friend . '">';
			}
			echo '
				<th>
				' . $test_number . '
				</th>
				<th>
					<img class="profile_picture" style="width:40px; height: 40px; 
					border: 1px solid black; border-radius: 75%;" src="' . $src . '">
				</th>
				<th>
					<p class="font-weight-normal">
						' . $bbb[0] . ' <small class="text-danger"> ' . $ccc[0] . ' new </small>
					</p>
				</th>  
				<th>
				' . round(($points * 100) / $d[0]) . '% 
				</th>
			</tr>';
		}
	}
}
