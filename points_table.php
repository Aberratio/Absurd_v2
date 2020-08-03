<?php
session_start();
include("get_test_details.php");
include("get_next_bidding_page.php");
include("get_comments.php");
include("connect.php");
include("try.php");

$test_id = $_GET['biddingtest'];
$set_id = $_GET['biddingset'];
$test_main_id = $_GET['test_main_id'];
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

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

                                <!-- POINTS PAGE <div class='col-auto'> -->
                                <div class="card mb-4">
                                    <div class="row no-gutters mt-2">
                                        <a href='choose_bidding_test.php?type=0&set=<?php echo $set_id; ?>&friend=<?php echo $friend ?>' class='text-decoration-none ml-2 mr-3 mb-2'>
                                            <i class="fas fa-long-arrow-alt-left mr-2"></i> <?php echo $infos->back; ?>
                                        </a>
                                        <h3 class="ml-5">
                                            <a href="ranking_test.php?test_id=<?php echo $test_main_id ?>" class="text-capitalize text-decoration-none"><i class="fas fa-medal mr-2 text-warning"></i><?php echo $infos->ranking_header; ?> </a>
                                        </h3>
                                        <div style='width: 100%;' class="mt-2">
                                            <div class='col ml-1 p-auto ml-md-5 ml-sm-2 ml-1'>
                                                <div class='card-block px-2' style="display: table;">
                                                    <p class='card-text'>
                                                        <?php get_both_hands($test_id); ?>
                                                    </p>

                                                </div>

                                            </div>

                                        </div>
                                        <div style="clear: both;"> </div>

                                        <!-- OUR BIDDING -->
                                        <div class="my-3 w-100">
                                            <p class="text-center mt-2"><?php echo $infos->our_bidding; ?></p>
                                            <table id="bidding_desk" class="ml-4">
                                                <td id="N" class="bidding_desk_column" style="padding: 3px; width: 150px;">N</td>
                                                <td id="E" class="bidding_desk_column" style="padding: 3px; width: 150px;">E</td>
                                                <td id="S" class="bidding_desk_column" style="padding: 3px; width: 150px;">S</td>
                                                <td id="W" class="bidding_desk_column" style="padding: 3px; width: 150px;">W</td>

                                            </table>
                                            <div id="bidding_string"><?php get_bidding($test_id); ?></div>
                                        </div>
                                        <!-- END OUR BIDDING -->

                                        <a class="btn btn-secondary btn-block mb-4 mt-2 mx-5" target="bidding" href="right_bidding_pop.php?biddingtest=$test_id&test_main_id=$test_main_id&test_number=$test_number" onclick="window.open('right_bidding_pop.php?biddingtest=<?php echo $test_id; ?>&test_main_id=<?php echo $test_main_id; ?>&test_number=<?php echo $test_number; ?>', 'Right bidding').focus(); return false">
                                            <?php echo $infos->check_proposed_bidding; ?></a>

                                        <!-- POINTS TABLE -->
                                        <div id="points_table" style="float: left;">
                                            <?php get_points_table($test_id); ?>
                                        </div>
                                        <!-- END POINTS TABLE -->
                                    </div>
                                </div>
                                <!-- POINTS PAGE END-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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
				border: 1px solid black; border-radius: 75%;' src='<?php echo $_SESSION['profile_picture'] ?>'>
                                    </div>
                                </div>
                                <div class='col ml-1'>
                                    <div class='card-block card-desc px-2'>
                                        <form method="post" name="add_comment">
                                            <div class="form-group">
                                                <textarea class="comments_text_area form-control" rows="3" name="comment"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <button class='btn btn-secondary text-decoration-none text-white btn-block' type="submit" value="Submit" name="add_comment"><?php echo $infos->send_comment; ?></button>
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

                        <div id="previous_comments"></div>
                        <!-- Previous comments -->
                        <script>
                            $(document).ready(function() {
                                var test_id = <?php echo $test_id ?>;
                                $("#previous_comments").load("try.php", {
                                    player_test_id: test_id
                                });
                            });
                        </script>

                    </div>
                </div>
            </div>
        </div>

        <!-- Bidding box -->
        <div id="bidding">

            <div id="biddingbox" style="display: none;">

                <div id="biddingbox_top">
                </div>
                <div id="biddingbox_bottom">
                    <button type="submit" class="biddingbox_bottom_button">&#10060;</button>
                    <button type="submit" class="biddingbox_bottom_button" onclick="declare(36)">PASS</button>
                    <button type="submit" class="biddingbox_bottom_button">&#10060;&#10060;</button> <!-- blue XX-->
                    <button type="submit" class="biddingbox_bottom_button biddingbox_bottom_button_back" onclick="declare(38)">&#128584;</button>
                </div>
                <?php update_player_bidding($test_id, $friend); ?>
            </div>
            <div style="clear: both;"> </div>
        </div>

        <!-- End of bidding box -->

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

    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>

</html>