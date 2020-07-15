<?php
session_start();
include("find_set.php");


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
<script type="text/javascript" src="js/accordion.js"></script>

<!-- MENU -->

<body>
    <div class="site-container">
        <div class="row mb-5 mt-5">
            <!-- PLAYER PANEL-->
            <div class="col-sm-10 col-lg-6 mx-auto">
                <div class="container mt-5">
                    <div class="card">
                        <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                            <?php echo $infos->find_set; ?>
                        </h4>

                        <a href='training_groups.php' class='text-decoration-none ml-2 mb-2'>
                            <i class="fas fa-long-arrow-alt-left mr-2"></i> <?php echo $infos->back; ?>
                        </a>

                        <div class="option_container mx-3 mt-2">
                            <div class="page">

                                <div class="accordion-option">
                                    <a href="javascript:void(0)" class="toggle-accordion active" accordion-id="#accordion"></a>
                                </div>
                                <div class="clearfix"></div>
                                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                    <?php search_for_folders($_GET['first_user'], $_GET['type'], $_GET['second_user'], $infos); ?>
                                </div>
                            </div>

                            <script>
                                jQuery(document).ready(function($) {
                                    $(".clickable-row").click(function() {
                                        window.location = $(this).data("href");
                                    });
                                });
                            </script>

                        </div>
                    </div>


                </div>
            </div>
            <!-- END PLAYER PANEL-->

            <!-- LEVEL DESCRIPTION -->
            <div class="col-sm-10 col-lg-5 mx-auto">
                <div class="container mt-5">
                    <div class="card p-2">
                        <h4 class="d-block text-center py-2 mt-2 mx-3 text-capitalize">
                            <?php echo $infos->level_description_header; ?>
                        </h4>
                        <hr class="hr-dark py-3" />

                        <div class="card mx-auto mb-3 border-success mb-3" style="max-width: 18rem;">
                            <div class="card-body text-success">
                                <h4 class="card-title"><?php echo $infos->level; ?> I</h4>
                                <hr />
                                <p class="card-text">
                                    <?php echo $infos->beginner_level_description; ?>
                                </p>
                            </div>
                        </div>

                        <div class="card mx-auto mb-3 border-warning mb-3" style="max-width: 18rem;">
                            <div class="card-body text-warning">
                                <h4 class="card-title"><?php echo $infos->level; ?> II</h4>
                                <hr />
                                <p class="card-text">
                                    <?php echo $infos->intermediate_level_description; ?>
                                </p>
                            </div>
                        </div>
                        <div class="card mx-auto mb-3 border-danger mb-3" style="max-width: 18rem;">
                            <div class="card-body text-danger">
                                <h4 class="card-title">
                                    <?php echo $infos->level; ?> III</h4>
                                <hr />
                                <p class="card-text">
                                    <?php echo $infos->experts_level_description; ?>
                                </p>
                            </div>
                        </div>
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