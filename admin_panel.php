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

    <script type="text/javascript" src="js/add_test.js">

    </script>
    <script src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
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
                            &nbsp;&nbsp;<img class='profile_picture' style='width:30px; height: 30px; border: 1px solid black; border-radius: 75%;' src='<?php echo $_SESSION['profile_picture']; ?>'>&nbsp;&nbsp;&nbsp;(<i><?php echo $_SESSION['user']; ?></i>) <b>Wyloguj<b></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>


    <main>

        <div style="margin-top: 50px; margin-left: 50px; font-size:18px;">
            <div style="float: left; display:inline-block;">
                <form name='add_test' method='post'>
                    <div class="form-group">
                        <label for="x">Nazwa zestawu <input class="form-control" type='text' name="set_name" /> </label>
                        <label style="padding-left: 10px;"> Nowy zestaw? <input type='checkbox' name="new_set" /></label>
                    </div>
                    <div class="form-group">
                        <label for="x">Punkty <input class="form-control" type='text' id='points_input' name='points_input' /></label>
                    </div>
                    <div class="form-group">
                        <label for="x">Ręka N<input class="form-control" type='text' name="N_hand" /></label>
                    </div>
                    <div class="form-group">
                        <label for="x">Ręka S<input class="form-control" type='text' name="S_hand" /></label>
                    </div>
                    <div class="form-group">
                        <label for="x"><button class="profile_view_button" name="add_test">Dodaj!</button></label>
                    </div>

                    <?php
                    if (isset($_POST['add_test'])) {
                        if (isset($_POST['new_set'])) {
                            mysqli_query($con, 'INSERT INTO `bidding_sets`(`id_set`, `set_name`, `set_type`) VALUES (0,"' . $_POST['set_name'] . '",0)');
                        }

                        $set_id = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bidding_sets WHERE set_name = "' . $_POST['set_name'] . '"'));
                        $test_counter = mysqli_fetch_array(mysqli_query($con, 'SELECT * FROM bidding_tests WHERE set_name = "' . $_POST['set_name'] . '"'));

                        mysqli_query($con, 'INSERT INTO `bidding_tests`(`id_test`, `level`, `S_hand`, `N_hand`, `point_string`, `id_set`, `declarer`) 
                    VALUES (0,1,"' . $_POST['S_hand'] . '","' . $_POST['N_hand'] . '","' . $_POST['points_input'] . '",' . $set_id["id_set"] . ',2)');
                        echo "Dodano nowy test!";
                    }
                    ?>
                </form>
            </div>

            <div id="brigde_table" style="float: left; display:inline-block; margin-left: 100px;">
                <div id="biddingbox">
                    <div id="biddingbox_top">
                    </div>
                    <div id="biddingbox_bottom">
                        <button type="submit" class="biddingbox_bottom_button"">&#10060;</button>
                <button type=" submit" class="biddingbox_bottom_button">PASS</button>
                        <button type="submit" class="biddingbox_bottom_button"">&#10060;&#10060;</button> <!-- blue XX--> 
                <button type=" submit" class="biddingbox_bottom_button biddingbox_bottom_button_back">&#128584;</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="view-panel" style="float: left">
            <?php
            echo '
            <form name="add">
            <select id="sets" name="sets">
                ';
            $get_set_query = 'SELECT * from bidding_sets';

            $run_sets = mysqli_query($con, $get_set_query);

            while ($row_comparetest = mysqli_fetch_array($run_sets)) {
                $set_name = $row_comparetest['set_name'];
                $set_id = $row_comparetest['id_set'];

                echo '
                    <option value="' . $set_id . '" set_name="' . $set_id . '">' . $set_name . '</option>';
            }
            echo '    
            </select>
            <input type="hidden" id="name" name="name" value=""/>
            </form>
        ';
            ?>

            <div>
                <div id="aha"> </div>
                <script type="text/javascript" language="javascript">
                    $(function() {
                        $("#sets").change(function() {
                            var studentName = $('option:selected', this).attr('set_name');
                            $('#name').val(studentName);
                            var xd = $('#name').val();
                            document.getElementById("aha").innerHTML = xd;

                            <?php
                            $cos = '<script type="text/javascript">document.write(xd)</script>';
                            $get_set_query = "SELECT * from bidding_tests where id_set = " . $cos . ";";

                            $run_sets = mysqli_query($con, $get_set_query);

                            while ($row_comparetest = mysqli_fetch_array($run_sets)) {
                                $set_name = $row_comparetest['set_name'];
                                $set_id = $row_comparetest['id_set'];

                                echo '
                            <option value="' . $set_id . '" set_name="' . $set_id . '">' . $set_name . '</option>';
                            }
                            ?>

                        });
                    });
                </script>
            </div>

        </div>

    </main>

    <footer>

    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>