<?php
session_start();

if (!isset($_SESSION['is_logged'])) {
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatile" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>Absurd - platforma licytacyjna</title>
    <meta name="description" content="Strona do nauki gry w brydża">
    <meta name="keywords" content="brydż, licytacja, rozgrywka, bridge, absurd">
    <meta name="author" content="Joanna Kokot">

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <header>
        <nav class="navbar navbar-dark bg-absurd-col-light navbar-expand-md">
            <a class="navbar-brand" href="menu.php">
                <img src="img/logo.png" widht="30" height="30" class="d-inline-block mr-1 align-bottom" alt="">
                Absurd
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainmenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="info.php">O stronie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Kontakt</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">
                            &nbsp;&nbsp;<img class='profile_picture' style='width:30px; 
                        height: 30px; border: 1px solid black; border-radius: 75%;' src='<?php echo $_SESSION['profile_picture']; ?>'>&nbsp;&nbsp;&nbsp;(
                            <i><?php echo $_SESSION['user']; ?></i>) <b>Wyloguj<b></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <main>

        <section class="menu_view_container">

            <div class="container">
                <div class="row" style="margin-top: 50px;">
                    <div class='col-sm-4'>
                        <figure>
                            <a href='choose_partner_bidding.php?type=0'><img src='img/licytacja.png' class='img-fluid menu_view_container-box' alt='licytacja'></a>
                            <figcaption>Quizy licytacyjne</figcaption>
                        </figure>
                    </div>


                    <?php if ($_SESSION['role'] == 1) {
                        echo "
                <div class='col-sm-4'>
                    <figure>
                        <a href='choose_partner_bidding.php?type=1'><img src='img/testy.png' class='img-fluid menu_view_container-box' alt='licytacja'></a>
                        <figcaption>Testy na zgodność w parze</figcaption>
                    </figure>
                </div>";
                    }
                    ?>

                    <?php if ($_SESSION['role'] == 0) {
                        echo "
                <div class='col-sm-4'>
                    <figure>
                        <a href='admin_panel.php'><img src='img/archiwum.png' class='img-fluid menu_view_container-box' alt='licytacja'></a>
                        <figcaption>Archiwum</figcaption>
                    </figure>
                </div>";
                    }
                    ?>

                    <?php if ($_SESSION['role'] == 1) {
                        echo "
                <div class='col-sm-4'>
                    <figure>
                        <a href='administration.php'><img src='img/archiwum.png' class='img-fluid menu_view_container-box' alt='licytacja'></a>
                        <figcaption>Panel Administratora</figcaption>
                    </figure>
                </div>";
                    }
                    ?>

                    <?php if ($_SESSION['role'] == 1 or $_SESSION['role'] == 2) {
                        echo "
                <div class='col-sm-4'>
                    <figure>
                        <a href='admin_panel.php'><img src='img/archiwum.png' class='img-fluid menu_view_container-box' alt='licytacja'></a>
                        <figcaption>Dodaj testy</figcaption>
                    </figure>
                </div>";
                    }
                    ?>
                    <div class="col-sm-4">
                        <figure>
                            <a href="ranking.php"><img src="img/archiwum.png" class="img-fluid menu_view_container-box" alt="licytacja"></a>
                            <figcaption>Ranking</figcaption>
                        </figure>
                    </div>

                    <?php if ($_SESSION['role'] == 2) {
                        echo "
                <div class='col-sm-4'>
                    <figure>
                        <a href='training_groups.php'><img src='img/archiwum.png' class='img-fluid menu_view_container-box' alt='licytacja'></a>
                        <figcaption>Grupy treningowe</figcaption>
                    </figure>
                </div>";
                    }
                    ?>

                    <!-- <?php
                            if ($_SESSION['role'] == 1) {
                                echo "
                    <div class='col-sm-4'>
                        <figure>
                            <a href='#'><img src='img/punkty_absurdu.png' class='img-fluid menu_view_container-box' alt='licytacja'></a>                   
                            <figcaption>Punkty absurdu</figcaption>
                        </figure>
                    </div>
                    ";
                            }
                            ?> -->

                    <div class="col-sm-4">
                        <figure>
                            <a href="account_settings.php"><img src="img/ustawienia.png" class="img-fluid menu_view_container-box" alt="licytacja"></a>
                            <figcaption>Ustawienia</figcaption>
                        </figure>
                    </div>

                    <!-- 
            <?php
            if ($_SESSION['role'] == 1) {
                echo "
                    <div class='col-sm-4'>
                        <figure>
                            <a href='#'><img src='img/kreator.png' class='img-fluid menu_view_container-box' alt='licytacja'></a>                   
                            <figcaption>Kreator KK</figcaption>
                        </figure>
                    </div>
                    ";
            }
            ?> -->

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