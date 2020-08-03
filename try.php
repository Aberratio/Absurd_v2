<?php
session_start();
include("connect.php");

global $con;
$output = " ";

$id_player_test = (int)$_POST['player_test_id'];

$get_test_query = 'SELECT * from comments JOIN bridgeplayers ON comments.id_player = bridgeplayers.id
        WHERE comments.id_player_test = ' . $id_player_test . ' ORDER BY comment_date desc';

$run_biddingtest = mysqli_query($con, $get_test_query);

while ($row_biddingtest = mysqli_fetch_array($run_biddingtest)) {
    $player_name = $row_biddingtest['user'];
    $profile_picture = $row_biddingtest['profile_picture'];
    $comment_date = $row_biddingtest['comment_date'];
    $comment_id = $row_biddingtest['id_comment'];
    $comment = $row_biddingtest['comment']; //get_bridge_string($row_biddingtest['comment']);

    $output = $output .  "
                <div class='card mb-4 ml-3 mr-3'>
                    <div class='row no-gutters mt-2'>
                        <div class='d-block  w-100 '>
                            <div class='col-auto d-block'>
                                <img class='profile_picture float-left d-inline' style='width:60px; height: 60px; 
                                border: 1px solid black; border-radius: 75%;' src='" . $profile_picture . "'>

                                <h4 class='ml-5 pl-4 pt-3 card-title font-weight-bold text-capitalize'>
                                " . $player_name . " <small style='color: gray;'>" . $comment_date . " </small>";

    if ($player_name == $_SESSION['user']) {
        $output = $output . "
                                    <small>
                                            <i data-toggle='modal' data-target='#delete$comment_id' class='fas fa-trash-alt ml-2 cursor-pointer'></i>
                                            <i data-toggle='modal' data-target='#edit$comment_id' class='fas fa-edit ml-2 cursor-pointer'></i>
                                    </small>


                <div class='modal fade' id='delete" . $comment_id . "' tabindex='-1' role='dialog' aria-labelledby='delete" . $comment_id . "Title' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                            <div class='modal-body'>
                                <div class='mx-5 d-block'>
                                    <img src='img/system/avatar_2d.png' class='rounded mx-auto d-block float-center' style='width: 200px' alt='Responsive image'>
                                </div>
                                <div class='mx-2'>
                                    <p class='text-center'>Czy na pewno chcesz usunąć ten komentarz?</p>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <form method='post' name='delete_comment" . $comment_id . "'>
                                    <div class='form-group'>
                                        <button type='submit' name='delete_comment" . $comment_id . "' class='btn btn-secondary'>Usuń</button>
                                        <button type='button' class='btn btn-primary' data-dismiss='modal'>Powrót</button>
                                    </div>";

        if (isset($_POST['delete_comment' . $comment_id])) {
            mysqli_query($con, 'DELETE FROM comments WHERE `id_comment` = ' . $comment_id . '');
        }

        $output = $output . "
                                </form>    
                            </div>
                        </div>
                    </div>
                </div>


                <div class='modal fade' id='edit" . $comment_id . "' tabindex='-1' role='dialog' aria-labelledby='edit" . $comment_id . "Title' aria-hidden='true'>
                    <div class='modal-dialog modal-dialog-centered' role='document'>
                        <div class='modal-content'>
                        <form method='post' name='edit_comment" . $comment_id . "'>
                            <div class='modal-body'>
                                <div class='mx-5 d-block'>
                                    <img src='img/system/avatar_2d.png' class='rounded mx-auto d-block float-center' style='width: 200px' alt='Responsive image'>
                                </div>
                                <div class='mx-2'>
                                    <div class='form-group'>
                                        <textarea class='comments_text_area form-control' rows='3' name='comment" . $comment_id . "'>
                                            $comment
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                            <div class='modal-footer'>
                                <div class='form-group'>
                                    <button type='submit' name='edit_comment" . $comment_id . "' class='btn btn-secondary'>Zapisz</button>
                                    <button type='button' class='btn btn-primary' data-dismiss='modal'>Powrót</button>
                                </div>
                            </div>";

        if (isset($_POST['edit_comment' . $comment_id])) {
            mysqli_query($con, 'UPDATE comments SET `comment`="' . $_POST['comment' . $comment_id . ''] . '" WHERE `id_comment` = ' . $comment_id . '');
        }

        $output = $output . "
                            </form>
                        </div>
                    </div>
                </div>

                ";
    }

    $output = $output .  "
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

echo $output;
