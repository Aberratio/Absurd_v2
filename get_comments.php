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
        $comment = get_bridge_string($row_biddingtest['comment']);

        echo "
            <div class='card mb-4 ml-3 mr-3'>
                <div class='row no-gutters mt-2'>
                    <div class='d-block  w-100 '>
                        <div class='col-auto d-block'>
                            <img class='profile_picture float-left d-inline' style='width:60px; height: 60px; 
                            border: 1px solid black; border-radius: 75%;' src='" . $profile_picture . "'>
                           
                            <h4 class='ml-5 pl-4 pt-3 card-title font-weight-bold text-capitalize'>
                            " . $player_name . " <small style='color: gray;'>" . $comment_date . " </small>
                            </h4>
                        </div>
                        <div class='col mt-4'>
                            <div class='card-block card-desc px-2'>
                                <p class='card-text'>
                                " . $comment . "
                                </p>
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
         ";
    }
}

function get_explanation($id_test)
{
    global $con;

    $get_test_query = 'SELECT * from comments JOIN player_bidding_tests ON comments.id_player_test = player_bidding_tests.id_player_test
    JOIN bridgeplayers ON comments.id_player = bridgeplayers.id
        WHERE player_bidding_tests.id_test = ' . $id_test . ' AND ((first_player = 26 AND second_player = 27) OR (first_player = 27 AND second_player = 26))  ORDER BY comment_date desc';

    $run_biddingtest = mysqli_query($con, $get_test_query);

    while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
        $comment = get_bridge_string($row_biddingtest['comment']);

        echo "
            <div class='card mb-4 ml-3 mr-3'>
                <div class='row no-gutters mt-2'>
                    <div class='col ml-1'>
                        <div class='card-block card-desc px-2'>
                            <p class='card-text'>
                            " . $comment . "
                            </p>
                        </div>
                    </div> 
                </div>
            </div>
         ";
    }
}

function get_bridge_string($bridge_string)
{

    $bridge_string = str_replace("!s", "<b style='color:blue'>&spades;</b>", $bridge_string);
    $bridge_string = str_replace("!h", "<b style='color:red'>&hearts;</b>", $bridge_string);
    $bridge_string = str_replace("!d", "<b style='color:orange'>&diams;</b>", $bridge_string);
    $bridge_string = str_replace("!c", "<b style='color:green'>&clubs;</b>", $bridge_string);

    $bridge_string = str_replace("==", "<br />", $bridge_string);
    $bridge_string = str_replace("enter", "<br />", $bridge_string);

    return $bridge_string;
}
