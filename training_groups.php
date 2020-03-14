<?php
session_start();
include("get_training_groups.php");

if (!isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    exit();
}

if ($_SESSION['role'] != 2) {
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
                    <p class="text-light"> Points: <?php echo $_SESSION['player_points']; ?> </p>
                </li>
                <li class="nav-item">
                    <img class='profile_picture_nav' src='<?php echo $_SESSION['profile_picture']; ?>'>
                    <i style="color:white;"><?php echo $_SESSION['user']; ?></i>
                </li>
                <li class="nav-item">
                    <a class="text-decoration-none text-light" href="logout.php">Log Out</a>
                </li>
        </div>
    </div>
</nav>

<body>
    <main>
        <section>

            <div style="margin-top: 50px; width: 500px; margin: auto; font-size:24px;">

                <div>
                    <p style="font-size: 32px; color: rgb(247, 109, 109);  margin-top: 20px; margin-bottom: 20px; text-align:center;">Dodaj grupę</p>
                    <form method="get">
                        <input type="text" class="form-control" placeholder="Nazwa grupy" name="group_name" style="margin-bottom: 20px;" />
                        <input type="text" class="form-control" placeholder="Pierwszy gracz" name="first_player" style="margin-bottom: 20px;" />
                        <input type="text" class="form-control" placeholder="Drugi gracz" name="second_player" style="margin-bottom: 20px;" />
                        <p><button class='profile_view_button' name='add_group'>Dodaj grupę</button></p>
                        <?php
                        if (isset($_GET['add_group'])) {
                            $first = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bridgeplayers WHERE user = "' . $_GET['first_player'] . '"'));
                            $second = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bridgeplayers WHERE user = "' . $_GET['second_player'] . '"'));

                            mysqli_query($con, "INSERT INTO `training_groups`(`id_group`, `id_trainer`, `id_first_player`, `id_second_player`, `group_name`) 
                                                    VALUES (0," . $_SESSION['id'] . "," . $first['id'] . "," . $second['id'] . ",'" . $_GET['group_name'] . "')");
                            echo "Dodano grupę!";
                        }
                        ?>
                    </form>
                </div>

                <div style="margin-top: 50px;">
                    <p style="font-size: 32px; color: rgb(253, 197, 124); margin-top: 20px; margin-bottom: 20px; text-align:center;">Moje grupy treningowe</p>

                    <div id="group_table" style="margin: auto;">
                        <?php get_group_table(); ?>
                    </div>
                </div>
            </div>
        </section>


    </main>

    <footer>

    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>