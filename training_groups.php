<?php
session_start();
include("get_training_groups.php");
require_once "JWT/handleJWT.php";

if (!isset($_COOKIE["token"])) {
    header('Location: index.php');
    exit();
}
$token = $_COOKIE["token"];
$payload = validateJWTAndReturnPayload($token);
$array = json_decode(json_encode($payload), true);
if ($array['role'] != 2) {
    header('Location: menu.php');
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <script src="https://kit.fontawesome.com/fe0a0fefeb.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style.css" />
    <title>Absurd - Bridge Platform</title>

    <script type="text/javascript" src="js/add_test.js">

    </script>
</head>

<!-- NAVBAR -->

<nav class="navbar navbar-expand-md navbar-dark bg-primary fixed-top py-1">
    <div class="container">
        <a class="navbar-brand" href="menu.php">
            <img src="img/logo_Asia_rev.png" alt="" width="50" height="50" />
            <h3 class="d-inline align-middle">Absurd</h3>
            <img src="img/logo_Domi_rev.png" alt="" width="50" height="50" />
        </a>
        <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <p class="text-light"> Points: <?php echo $array['player_points']; ?> </p>
                </li>
                <li class="nav-item">
                    <img class='profile_picture_nav' src='<?php echo $array['profile_picture']; ?>'>
                    <i style="color:white;"><?php echo $array['user']; ?></i>
                </li>
                <li class="nav-item">
                    <a class="text-decoration-none text-light" href="logout.php">Log Out</a>
                </li>
        </div>
    </div>
</nav>

<body>
    <div class="site-container">
        <div class="row mb-5 mt-5">
            <!-- PLAYER PANEL-->
            <div class="col-sm-10 col-lg-6 mx-auto">
                <div class="container mt-5">
                    <div class="card">
                        <h4 class="bg-primary d-block text-center py-2 my-2 mx-3 rounded text-white text-capitalize">
                            My groups
                        </h4>
                        <div class="option_container mx-3 mt-2">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Group</th>
                                        <th scope="col">Add sets</th>
                                        <th scope="col">Progress</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php get_group_table(); ?>
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
                            Add new group
                        </h4>
                        <hr class="hr-dark py-3" />
                        <form method="get" class="mx-3">
                            <input type="text" class="form-control mb-2" placeholder="Group name" name="group_name" />
                            <input type="text" class="form-control mb-2" placeholder="First player" name="first_player" />
                            <input type="text" class="form-control mb-2" placeholder="Second player" name="second_player" />
                            <p><button class="btn btn-secondary mt-3 btn-block" name='add_group'>Add</button></p>
                            <?php
                            if (isset($_GET['add_group'])) {
                                $first = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bridgeplayers WHERE user = "' . $_GET['first_player'] . '"'));
                                $second = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bridgeplayers WHERE user = "' . $_GET['second_player'] . '"'));

                                mysqli_query($con, "INSERT INTO `training_groups`(`id_group`, `id_trainer`, `id_first_player`, `id_second_player`, `group_name`) 
                                                    VALUES (0," . $array['id'] . "," . $first['id'] . "," . $second['id'] . ",'" . $_GET['group_name'] . "')");
                                echo "Group Added!";
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