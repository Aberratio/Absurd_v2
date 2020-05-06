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

if (!isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    exit();
}
?>

<?php include 'templates/header.php'; ?>
<?php include 'templates/navbar.php'; ?>

<!-- MENU -->

<body>
    <div class="site-container">
        <div class="row mb-5 mt-5">
            <!-- PLAYER PANEL-->
            <div class="col-sm-10 col-lg-6 mx-auto">
                <div class="container mt-5">
                    <div class="card">
                        <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                            Problem <?php echo $test_number; ?>
                        </h4>
                        <div class="option_container mx-3 mt-2">
                            <div class="option">
                                <!-- Hand view -->
                                <div class="container m-auto">
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-5">
                                            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">N Hand</h5>
                                                    <p><b style="color:blue">&spades;</b></p>AKQJ1098765432
                                                    <p><b style="color:red">&hearts;</b></p>-
                                                    <p><b style="color:orange">&diams;</b></p>-
                                                    <p><b style="color:green">&clubs;</b></p>-
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">W Hand</h5>
                                                    <p><b style="color:blue">&spades;</b></p>-
                                                    <p><b style="color:red">&hearts;</b></p>AKQJ1098765432
                                                    <p><b style="color:orange">&diams;</b></p>-
                                                    <p><b style="color:green">&clubs;</b></p>-
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1"></div>
                                        <div class="col-md-5">
                                            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">E Hand</h5>
                                                    <b style="color:blue">&spades;</b>-
                                                    <b style="color:red">&hearts;</b>-
                                                    <b style="color:orange">&diams;</b>AKQJ1098765432
                                                    <b style="color:green">&clubs;</b>-
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3"></div>
                                        <div class="col-md-5">
                                            <div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
                                                <div class="card-body">
                                                    <h5 class="card-title text-center">S Hand</h5>
                                                    <p><b style="color:blue">&spades;</b></p>-
                                                    <p><b style="color:red">&hearts;</b></p>-
                                                    <p><b style="color:orange">&diams;</b></p>-
                                                    <p><b style="color:green">&clubs;</b></p>AKQJ1098765432
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3"></div>
                                    </div>
                                </div>
                                <!-- Hand view END -->
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
                            <?php if ($_SESSION['role'] == 2) {
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
            <div class="col-sm-10 col-md-6 col-lg-5 mx-auto">
                <div class="container mt-5">
                    <div class="card mt-2">
                        <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                            Comments
                        </h4>
                        <div class='card mb-4 ml-3 mr-3'>
                            <div class='row no-gutters mt-2'>
                                <div class="option">
                                    <div class='col-auto'>
                                        <img class="profile_picture mb-2" src="<?php echo $_SESSION['profile_picture'] ?>">
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


                                                // header('Location: points_table.php?biddingtest=' . $test_id . '&
                                                // biddingset=' . $set_id . '&test_main_id=' . $test_main_id . '&test_number=' . $test_number . '&friend=' . $friend . '');
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
                    <a href="https://www.facebook.com/joanna.kokot.37" target="_blank">Aberratio</a>. All Rights Reserved
                </p>
            </div>
        </div>
    </div>

    <script src="http://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js" integrity="sha384-smHYKdLADwkXOn1EmN1qk/HfnUcbVRZyYmZ4qpPea6sjB/pTJ0euyQp0Mk8ck+5T" crossorigin="anonymous"></script>
</body>

</html>