<?php
session_start();
include("get_training_groups.php");

if (!isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    exit();
}

if ($_SESSION['role'] == 3) {
    header('Location: menu.php');
    exit();
}

if ($_SESSION['language'] == 1) {
    include("lang/lang_eng.php");
} else {
    include("lang/lang_pl.php");
}

$infos = new Infos();

?>

<!DOCTYPE HTML>
<html lang="pl">


<?php include 'templates/header.php'; ?>
<?php include 'templates/navbar.php'; ?>
<script type="text/javascript" src="js/add_test.js">

</script>

<body>
    <div class="site-container">
        <div class="row mb-5 mt-5">
            <!-- PLAYER PANEL-->
            <div class="col-sm-10 col-lg-6 mx-auto">
                <div class="container mt-5">
                    <div class="card">
                        <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                            <?php echo $infos->my_groups; ?>
                        </h4>
                        <a href='menu.php' class='text-decoration-none ml-2 mb-2'>
                            <i class="fas fa-long-arrow-alt-left mr-2"></i> <?php echo $infos->back; ?>
                        </a>
                        <div class="option_container mx-3 mt-2">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo $infos->group; ?></th>
                                        <th scope="col"><?php echo $infos->add_folder; ?></th>
                                        <th scope="col"><?php echo $infos->progress; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php get_group_table($infos); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>


                </div>
            </div>

            <!-- Trener panel -->
            <div class="col-sm-10 col-md-6 col-lg-4 mx-auto">
                <div class="container mt-5">
                    <div class="card">
                        <h4 class="d-block text-center py-2 mt-2 mx-3 text-capitalize">
                            <?php echo $infos->add_group; ?>
                        </h4>
                        <hr class="hr-dark py-3" />
                        <form method="get" class="mx-3">
                            <input type="text" class="form-control mb-2" placeholder="<?php echo $infos->group_name; ?>" name="group_name" />
                            <input type="text" class="form-control mb-2" placeholder="<?php echo $infos->user; ?> I" name="first_player" />
                            <input type="text" class="form-control mb-2" placeholder="<?php echo $infos->user; ?> II" name="second_player" />
                            <p><button class="btn btn-secondary mt-3 btn-block" name='add_group'><?php echo $infos->add; ?></button></p>
                            <?php
                            if (isset($_GET['add_group'])) {
                                $first = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bridgeplayers WHERE user = "' . $_GET['first_player'] . '"'));
                                $second = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bridgeplayers WHERE user = "' . $_GET['second_player'] . '"'));

                                $counter =  mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM training_groups WHERE (id_first_player = " . $first['id'] . " OR id_second_player = " . $first['id'] . ") AND (id_first_player = " . $second['id'] . " OR id_second_player = " . $second['id'] . ") "));

                                if ($counter[0] == 0) {
                                    mysqli_query($con, "INSERT INTO `training_groups`(`id_group`, `id_trainer`, `id_first_player`, `id_second_player`, `group_name`) 
                                    VALUES (0," . $_SESSION['id'] . "," . $first['id'] . "," . $second['id'] . ",'" . $_GET['group_name'] . "')");

                                    echo $infos->group_added;
                                }

                                $counter2 =  mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(*) FROM training_groups WHERE id_trainer = 12 AND (id_first_player = " . $first['id'] . " OR id_second_player = " . $first['id'] . ") AND (id_first_player = " . $second['id'] . " OR id_second_player = " . $second['id'] . ") "));

                                if ($counter2[0] == 1) {
                                    $update = "UPDATE training_groups SET id_trainer=" . $_SESSION['id'] . " WHERE id_trainer = 12 AND (id_first_player = " . $first['id'] . " OR id_second_player = " . $first['id'] . ") AND (id_first_player = " . $second['id'] . " OR id_second_player = " . $second['id'] . ") ";

                                    $run = mysqli_query($con, $update);
                                }
                            }
                            ?>
                        </form>
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