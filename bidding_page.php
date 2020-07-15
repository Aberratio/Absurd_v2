<?php
session_start();
include("get_test_details.php");
include("get_comments.php");
include("get_next_bidding_page.php");
include("connect.php");

$test_id = $_GET['biddingtest'];
$set_id = $_GET['biddingset'];
$test_number = $_GET['test_number'];
$friend = $_GET['friend'];



if ($_SESSION['language'] == 1) {
    include("lang/lang_eng.php");
} else {
    include("lang/lang_pl.php");
}

$infos = new Infos();


if (!isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    exit();
}
?>

<?php include 'templates/header.php'; ?>
<?php include 'templates/navbar.php'; ?>

<script type="text/javascript" src="js/biddingbox.js">

</script>

<!-- MENU -->

<body>
    <div class="site-container">
        <div class="row mb-5 mt-5">
            <!-- PLAYER PANEL-->
            <div class="col-sm-10 col-lg-6 mx-auto">
                <div class="container mt-5">
                    <div class="card">
                        <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                            <ul class="pagination pagination-sm justify-content-between mb-0">
                                <?php get_previous_bidding_page($test_number, $test_id, $friend); ?>
                                <li><?php echo $infos->problem . " " . $test_number; ?></li>
                                <?php get_next_bidding_page($test_number, $test_id, $friend); ?>
                            </ul>
                        </h4>
                        <div class="option_container mx-3 mt-2">
                            <div class="option">
                                <!-- TEST 1 -->
                                <div class="card mb-4">
                                    <div class="row no-gutters mt-2">
                                        <a href='choose_bidding_test.php?type=0&set=<?php echo $set_id; ?>&friend=<?php echo $friend ?>' class='text-decoration-none ml-2 mb-2'>
                                            <i class="fas fa-long-arrow-alt-left mr-2"></i> <?php echo $infos->back; ?>
                                        </a>
                                        <div class='player_turn' style='width: 100%;'> <?php echo $infos->problem_turn; ?>:
                                            <b>
                                                <div id="turn"><?php get_player($test_id); ?></div>
                                            </b>
                                        </div>
                                        <div class="pleyer_hand align-items-center" style='width: 100%;'><?php get_hand($test_id); ?>
                                        </div>
                                        <div class="py-3 d-block" style='width: 100%; height: 4px;'>
                                            <hr class="hr-dark" style='width: 100%; height: 4px;' />
                                        </div>
                                        <div id="bidding" class="mt-2">
                                            <table id="bidding_desk">
                                                <td id="N" class="bidding_desk_column" style="padding: 3px; width: 150px;">S</td>
                                                <td id="E" class="bidding_desk_column" style="padding: 3px; width: 150px;">W</td>
                                                <td id="S" class="bidding_desk_column" style="padding: 3px; width: 150px;">N</td>
                                                <td id="W" class="bidding_desk_column" style="padding: 3px; width: 150px;">E</td>

                                            </table>
                                            <div id="bidding_string"><?php get_bidding($test_id); ?></div>
                                        </div>

                                    </div>
                                </div>
                                <!-- TEST 1 END-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- BIDDING BOX -->
            <div class="col-sm-10 col-md-6 col-lg-4 mx-auto">
                <div class="container mt-5">
                    <!-- <div class="card"> -->
                    <div id="biddingbox">
                        <div id="biddingbox_top">
                        </div>
                        <div id="biddingbox_bottom">
                            <button type="submit" class="biddingbox_bottom_button">&#10060;</button>
                            <button type="submit" class="biddingbox_bottom_button" onclick="declare(36)">PASS</button>
                            <button type="submit" class="biddingbox_bottom_button">&#10060;&#10060;</button> <!-- blue XX-->
                            <?php if ($_SESSION['id'] == 26 or $_SESSION['id'] == 27) {
                                echo "
                                    <button type='submit' id='undo_button' class='biddingbox_bottom_button biddingbox_bottom_button_back' onclick='declare(38)'>&#128584;</button>";
                            } else {
                                echo "
                                    <button type='submit' id='undo_button' class='biddingbox_bottom_button biddingbox_bottom_button_back'>&#128584;</button>";
                            }
                            ?>
                        </div>
                        <?php update_player_bidding($test_id, $friend); ?>
                    </div>
                    <div style="clear: both;"> </div>

                    <!-- </div> -->
                </div>
            </div>
            <!-- BIDDING BOX END -->


            <!-- Comments -->
            <div class="col-sm-10 col-lg-5 mx-auto">
                <div class="container mt-5">
                    <div class="card mt-2">
                        <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                            <?php echo $infos->comments; ?>
                        </h4>
                        <div class='card mb-4 ml-3 mr-3'>
                            <div class='row no-gutters mt-2'>
                                <div class="option">
                                    <div class='col-auto'>
                                        <img class='profile_picture' style='width:60px; height: 60px; 
				border: 1px solid black; border-radius: 75%;' src="<?php echo $_SESSION['profile_picture'] ?>">
                                    </div>
                                </div>
                                <div class='col ml-1'>
                                    <div class='card-block card-desc px-2'>
                                        <form method="post" name="add_comment">
                                            <div class="form-group">
                                                <textarea class="comments_text_area form-control" rows="3" name="comment"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button class='btn btn-secondary text-decoration-none text-white btn-block' type="submit" value="Submit" name="add_comment">Send comment</button>
                                            </div>
                                            <?php

                                            if (isset($_POST['add_comment'])) {
                                                mysqli_query($con, 'INSERT INTO comments (`id_comment`, `id_player_test`, `id_player`, `comment_date`, `comment`) 
                                                VALUES (0, ' . $test_id . ', ' . $_SESSION['id'] . ', "' . date('Y-m-d H:i:s') . '", "' . $_POST['comment'] . '")');
                                            }
                                            ?>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <hr class="hr-dark py-3" />

                        <!-- Previous comments -->
                        <?php get_comments($test_id); ?>
                    </div>
                </div>
            </div>
        </div>


        <!-- FOOTER -->

        <div class="navbar fixed-bottom justify-content-center align-content-center" id="main-footer">
            <div class="footer-container">
                <p class="copyright">
                    Copyright &copy; 2020 by
                    <a href="https://www.facebook.com/joanna.gertrud.kokot/" target="_blank">Aberratio</a>. All Rights Reserved
                </p>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>

</html>