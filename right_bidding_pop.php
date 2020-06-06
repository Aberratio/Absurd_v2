<?php
session_start();
include("get_test_details.php");
include("get_comments.php");
include("connect.php");

$test_id = $_GET['biddingtest'];

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
                            <?php echo $infos->problem; ?>
                        </h4>
                        <div class="option_container mx-3 mt-2">
                            <div class="option">

                                <!-- POINTS PAGE <div class='col-auto'> -->
                                <div class="card">
                                    <div class="row no-gutters mt-2">
                                        <div style='width: 100%;' class="mt-2">
                                            <div class='col ml-1 p-auto ml-md-5 ml-sm-2 ml-1'>
                                                <div class='card-block px-2' style="display: table;">
                                                    <p class='card-text'>
                                                        <?php get_both_hands_in_proposed_bidding($test_id); ?>
                                                    </p>

                                                </div>

                                            </div>

                                        </div>
                                        <div style="clear: both;"> </div>

                                        <!-- PROPOSED BIDDING -->
                                        <div id="bidding" style="float:left; margin-top: 50px;">
                                            <p><?php echo $infos->proposed_bidding; ?></p>
                                            <table id="bidding_desk">
                                                <td id="N" class="bidding_desk_column" style="padding: 3px; width: 150px;">N</td>
                                                <td id="E" class="bidding_desk_column" style="padding: 3px; width: 150px;">E</td>
                                                <td id="S" class="bidding_desk_column" style="padding: 3px; width: 150px;">S</td>
                                                <td id="W" class="bidding_desk_column" style="padding: 3px; width: 150px;">W</td>

                                            </table>
                                            <div id="bidding_string"><?php get_right_bidding($test_id); ?></div>
                                        </div>
                                        <!-- END PROPOSED BIDDING -->



                                    </div>
                                </div>
                                <!-- POINTS PAGE END-->


                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Comments -->
            <div class="col-sm-10 col-md-6 col-lg-5 mx-auto">
                <div class="container mt-5">
                    <div class="card mt-2">
                        <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                            <?php echo $infos->comments; ?>
                        </h4>

                        <hr class="hr-dark py-3" />

                        <!-- Previous comments -->
                        <?php get_comments($test_id); ?>
                    </div>
                </div>
            </div>
        </div>




        <!-- Bidding box  -->
        <div id="bidding">

            <div id="biddingbox" style="display: none;">

                <div id="biddingbox_top">
                </div>
                <div id="biddingbox_bottom">
                    <button type="submit" class="biddingbox_bottom_button">&#10060;</button>
                    <button type=" submit" class="biddingbox_bottom_button" onclick="declare(36)">PASS</button>
                    <button type="submit" class="biddingbox_bottom_button">&#10060;&#10060;</button> <!-- blue XX-->
                    <button type=" submit" class="biddingbox_bottom_button biddingbox_bottom_button_back" onclick="declare(38)">&#128584;</button>
                </div>
                <?php update_bidding($test_id); ?>
            </div>
            <div style="clear: both;"> </div>
        </div>

        <!-- End of bidding box  -->

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