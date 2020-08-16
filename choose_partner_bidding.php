<?php
session_start();
include("find_partner_function.php");
include("get_training_groups.php");

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

<!-- MENU -->

<body>
    <div class="site-container">
        <div class="row mb-5 mt-5">
            <!-- PLAYER PANEL-->
            <div class="col-sm-10 col-lg-6 mx-auto">
                <div class="container mt-5">
                    <div class="card">
                        <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                            <?php echo $infos->find_player; ?>
                        </h4>
                        <a href='menu.php' class='text-decoration-none ml-2 mb-2'>
                            <i class="fas fa-long-arrow-alt-left mr-2"></i> <?php echo $infos->back; ?>
                        </a>
                        <div class="option_container mx-3 mt-2">
                            <div class="option">
                                <?php search_user($_SESSION['user'], $_GET['type'], $infos); ?>
                            </div>

                            <script>
                                jQuery(document).ready(function($) {
                                    $(".clickable-row").click(function() {
                                        window.location = $(this).data("href");
                                    });
                                });
                            </script>
                        </div>

                        <button class="btn btn-secondary my-2 mx-5" data-toggle="modal" data-target="#helperModal"><?php echo $infos->need_help ?> </button>

                        <div class="m-3">
                            <div class="input-group form-sm my-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-text1"><i class="fas fa-search" aria-hidden="false"></i></span>
                                </div>
                                <input class="form-control m-0 py-1" type="text" id="search_text" placeholder="<?php echo $infos->search_player ?>" aria-label="Search">
                            </div>
                        </div>

                        <div class="m-2" id="result"></div>

                        <hr class="hr-dark" />

                        <div class="mx-2">
                            <h4 class="d-block text-center py-2 my-2 mx-3 text-capitalize">
                                <?php echo $infos->received_invitations ?>
                            </h4>
                            <div class="m-2" id="result2"></div>
                        </div>

                        <hr class="hr-dark" />

                        <div class="mx-2 mb-2">
                            <h4 class="d-block text-center py-2 my-2 mx-3 text-capitalize">
                                <?php echo $infos->sent_invitations ?>
                            </h4>
                            <div class="m-2" id="result3"></div>
                        </div>

                        <script>
                            $(document).ready(function() {
                                load_data();
                                load_sended();
                                load_received();

                                function load_data(query) {
                                    $.ajax({
                                        url: "search.php",
                                        method: "post",
                                        data: {
                                            query: query
                                        },
                                        success: function(data) {
                                            $('#result').html(data);
                                        }
                                    });
                                }

                                function load_received() {
                                    $.ajax({
                                        url: "search_received_invitations.php",
                                        method: "post",
                                        success: function(data) {
                                            $('#result2').html(data);
                                        }
                                    });
                                }

                                function load_sended() {
                                    $.ajax({
                                        url: "search_sended_invitations.php",
                                        method: "post",
                                        success: function(data) {
                                            $('#result3').html(data);
                                        }
                                    });
                                }

                                $('#search_text').keyup(function() {
                                    var search = $(this).val();
                                    if (search != '') {
                                        load_data(search);
                                    } else {
                                        load_data();
                                    }
                                });
                            });
                        </script>

                        <?php
                        global $con;

                        if (isset($_GET["invite"])) {
                            $get_invite_count = "SELECT COUNT(*) FROM invitations WHERE (id_first_user=" . $_SESSION['id'] . " OR id_second_user=" . $_SESSION['id'] . ") 
                            AND (id_first_user=" . $_GET["partner_id"] . " OR id_second_user=" . $_GET["partner_id"] . ") ;";
                            $invite_counter = mysqli_query($con, $get_invite_count);
                            $invite_amount =  mysqli_fetch_array($invite_counter);

                            if ($invite_amount[0] > 0) {
                            } else {
                                mysqli_query($con, "INSERT INTO `invitations`(`id_invitation`, `id_first_user`, `id_second_user`, `date_of_invitation`, `is_deleted`, `is_canceled`) 
                            VALUES (0," . $_SESSION['id'] . "," . $_GET["partner_id"] . ",'" . date('Y-m-d H:i:s') . "','false','false')");
                            }
                        }
                        if (isset($_GET["cancel"])) {
                            $update = "UPDATE invitations SET is_canceled=true
                            WHERE id_second_user=" . $_SESSION['id'] . " AND id_first_user=" . $_GET["partner_id"] . "";

                            $run = mysqli_query($con, $update);
                        }
                        if (isset($_GET["delete"])) {
                            $update = "UPDATE invitations SET is_deleted=true
                                                 WHERE id_first_user=" . $_SESSION['id'] . " AND id_second_user=" . $_GET["partner_id"] . "";

                            $run = mysqli_query($con, $update);
                        }

                        if (isset($_GET["accept"])) {
                            $update = "UPDATE invitations SET is_accepted=true
                            WHERE id_second_user=" . $_SESSION['id'] . " AND id_first_user=" . $_GET["partner_id"] . "";

                            $run = mysqli_query($con, $update);


                            $counter =  mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM training_groups WHERE id_trainer = 12 AND (id_first_player = " . $_SESSION['id'] . " OR id_second_player = " . $_SESSION['id'] . ") AND (id_first_player = " . $_GET["partner_id"] . " OR id_second_player = " . $_GET["partner_id"] . ") "));

                            if ($counter[0] == 0) {
                                mysqli_query($con, "INSERT INTO `training_groups`(`id_group`, `id_trainer`, `id_first_player`, `id_second_player`, `group_name`) 
                                VALUES (0,12," . $_SESSION['id'] . "," . $_GET["partner_id"] . ",'tmp')");

                                $get_sets_amount_in_folder = "SELECT COUNT(*) FROM `folders` JOIN player_folders ON folders.id_folder = player_folders.id_folder LEFT JOIN bidding_sets ON bidding_sets.id_folder = player_folders.id_folder WHERE folders.id_folder = 1 AND 
                                ((id_first_player = " . $_SESSION['id'] . " OR id_first_player = " . $_GET["partner_id"] . ") AND (id_second_player = " . $_SESSION['id'] . " OR id_second_player = " . $_GET["partner_id"] . "))";

                                $player_folder_counter = mysqli_query($con, $get_sets_amount_in_folder);
                                $counter = mysqli_fetch_array($player_folder_counter);

                                if ($counter[0] == 0) {

                                    $get_sets_in_folder = "SELECT * FROM `folders` LEFT JOIN bidding_sets ON bidding_sets.id_folder = folders.id_folder WHERE folders.id_folder = 1";

                                    $run_sets = mysqli_query($con, $get_sets_in_folder);

                                    while ($row_biddingset = mysqli_fetch_array($run_sets)) {
                                        $id_set = $row_biddingset['id_set'];

                                        add_set($_SESSION['id'], $_GET["partner_id"], $id_set);
                                    }

                                    add_folder($_SESSION['id'], $_GET["partner_id"], 1, $infos);
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="helperModal" tabindex="-1" role="dialog" aria-labelledby="helperModalTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="helperModalLongTitle"><?php echo $infos->what_you_have_to_do; ?></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="mx-5 d-block">
                                <img src="img/system/avatar2.png" class="rounded mx-auto d-block float-center" style="width: 200px" alt="Responsive image">
                            </div>
                            <div class="mx-3">
                                <ol class="ml-2">
                                    <li><i><?php echo $infos->help_with_partner_step_1 ?></i></li>
                                    <li><i><?php echo $infos->help_with_partner_step_2 ?></i></li>
                                    <li><i><?php echo $infos->help_with_partner_step_3 ?></i></li>
                                </ol>
                                <p class="text-center"><b><?php echo $infos->ask_trainer_for_more_folders ?></b></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?php echo $infos->close ?></button>
                        </div>
                    </div>
                </div>
            </div>


            <!-- HELP -->
            <div class="col-sm-10 col-lg-5 mx-auto">
                <div class="container mt-5">
                    <div class="card p-2">
                        <ul class="timeline">
                            <li>
                                <div class="timeline-panel">
                                    <div class="timeline-body">
                                        <p><?php echo $infos->need_help_cloud; ?></p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-panel">
                                    <div class="timeline-body">
                                        <p><?php echo $infos->intresting_tests_cloud; ?></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-panel">
                                    <div class="timeline-body">
                                        <p><?php echo $infos->join_trainers_cloud; ?></p>
                                    </div>
                                </div>
                            </li>
                            <li class="timeline-inverted">
                                <div class="timeline-panel">
                                    <div class="timeline-body">
                                        <p><?php echo $infos->found_bug_cloud; ?></p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="timeline-panel">
                                    <div class="timeline-body">
                                        <p><?php echo $infos->development_cloud; ?></p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <a class="btn btn-secondary mt-3 btn-block mb-3 mt-1" href="https://www.facebook.com/joanna.gertrud.kokot/" target="_blank"><?php echo $infos->write_me_button; ?></a>
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