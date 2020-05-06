<?php
session_start();
include("find_tests.php");
include("get_comp_test.php");
include("connect.php");
include("get_ranking.php");

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

<!-- MENU -->
<?php
$con = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Connection was not established");
$x = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bidding_sets join player_bidding_sets on bidding_sets.id_set = player_bidding_sets.id_set WHERE id_player_sets = ' . $_GET["set"] . ''));
echo $x['set_name']; ?></div>

<body>
    <div class="site-container">
        <div class="row mb-5 mt-5">
            <!-- PLAYER PANEL-->
            <div class="col-sm-10 col-lg-6 mx-auto">
                <div class="container mt-5">
                    <div class="card">
                        <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                            <?php echo $infos->find_problem; ?>
                        </h4>
                        <div class="option_container mx-3 mt-2">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"><?php echo $infos->problem_turn; ?></th>
                                        <th scope="col"><?php echo $infos->comments; ?></th>
                                        <th scope="col"><?php echo $infos->score; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if ($_GET['type'] == 0) {
                                        search_test($_GET['set'], $_GET['friend']);
                                    } else if ($_GET['type'] == 1) {
                                        get_test($_GET['set'], $_GET['friend']);
                                    }
                                    ?>

                                    <script>
                                        jQuery(document).ready(function($) {
                                            $(".clickable-row").click(function() {
                                                window.location = $(this).data("href");
                                            });
                                        });
                                    </script>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END PLAYER PANEL-->

            <!-- NEWS -->
            <div class="col-sm-10 col-md-6 col-lg-4 mx-auto">
                <div class="container mt-5">
                    <div class="card">
                        <h4 class="d-block text-center py-2 mt-2 mx-3 text-capitalize">
                            <?php echo $infos->set_ranking; ?>
                        </h4>

                        <?php get_ranking_set_table($x['id_set'], $x['max_points'], $infos); ?>

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