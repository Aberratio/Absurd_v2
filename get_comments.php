<?php

include("connect.php");

function get_comments($id_player_test)
{
    global $con;

    $get_test_query = 'SELECT * from comments JOIN bridgeplayers ON comments.id_player = bridgeplayers.id
        WHERE (comments.id_player_test = ' . $id_player_test . ') ORDER BY comment_date desc';

    $run_biddingtest = mysqli_query($con, $get_test_query);

    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $player_name = $row_biddingtest['user'];
        $profile_picture = $row_biddingtest['profile_picture'];
        $comment_date = $row_biddingtest['comment_date'];
        $comment = $row_biddingtest['comment'];

        echo "
            <div class='card mb-4 ml-3 mr-3'>
                <div class='row no-gutters mt-2'>
                    <div class='option'>
                        <div class='col-auto'>
                            <img class='profile_picture' src='" . $profile_picture . "'>
                        </div>
                    </div
                    <div class='col ml-1'>
                        <div class='card-block card-desc px-2'>
                            <h4 class='card-title font-weight-bold text-capitalize'>
                            " . $player_name . " <small style='color: gray;'>" . $comment_date . " </small>
                            </h4>
                            <p class='card-text'>
                            " . $comment . "
                            </p>
                        </div>
                    </div> 
                </div>
         ";
    }
}
