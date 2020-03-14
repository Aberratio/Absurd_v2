<?php
session_start();

if (isset($_POST['user'])) {
    $is_good = true;

    //checking user
    $user = $_POST['user'];
    if ((strlen($user) < 3) || (strlen($user) > 20)) {
        $is_good = false;
        $_SESSION['error_user'] = "Nazwa użytkownika musi zawierać od 3 do 20 znaków.";
    }

    if (ctype_alnum($user) == false) {
        $is_good = false;
        $_SESSION['error_user'] = "Nazwa użytkownika może zawierać jedynie litery (bez polskich znaków) i cyfry.";
    }

    //checking email
    $email = $_POST['email'];
    $save_email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if ((filter_var($save_email, FILTER_VALIDATE_EMAIL) == false) || ($save_email != $email)) {
        $is_good = false;
        $_SESSION['error_email'] = "Niepoprawny adres email";
    }

    //checking password
    $password_one = $_POST['password1'];
    $password_two = $_POST['password2'];

    if ((strlen($password_one) < 8) || (strlen($password_one) > 20)) {
        $is_good = false;
        $_SESSION['error_password'] = "Hasło musi zawierać od 8 do 20 znaków.";
    }

    if ($password_one != $password_two) {
        $is_good = false;
        $_SESSION['error_password'] = "Hasła muszą być identyczne.";
    }

    $hashed_password = password_hash($password_one, PASSWORD_DEFAULT);

    //checking rules box
    if (!isset($_POST['rules'])) {
        $is_good = false;
        $_SESSION['error_rules'] = "Zaakceptuj regulamin.";
    }

    //checking humanity
    $secret_key = "6LcHc7wUAAAAADazqGqrLGVScTewI9ltumGnLLO6";
    $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $_POST['g-recaptcha-response']);
    $response = json_decode($check);

    if ($response->success == false) {
        $is_good = false;
        $_SESSION['error_humanity'] = "Wykryto boota";
    }

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $db_connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($db_connection->connect_errno != 0) {
            throw new Exception(mysql_connect_errno());
        } else {
            //checking email in data base
            $result = $db_connection->query("SELECT id FROM bridgeplayers WHERE email='$email'");

            if (!$result) {
                throw new Exception(($db_connection->error));
            }
            $same_email_counter = $result->num_rows;
            if ($same_email_counter > 0) {
                $is_good = false;
                $_SESSION['error_email'] = "Email zajęty!";
            }

            //checking username in data base
            $result = $db_connection->query("SELECT id FROM bridgeplayers WHERE user='$user'");

            if (!$result) {
                throw new Exception(($db_connection->error));
            }
            $same_user_counter = $result->num_rows;
            if ($same_user_counter > 0) {
                $is_good = false;
                $_SESSION['error_user'] = "Login zajęty!";
            }

            //everything ok
            if ($is_good == true) {
                if ($db_connection->query("INSERT INTO bridgeplayers (`user`, `email`, `pass`, `cezar`, `profile_picture`, `player_points`, `role`) 
                    VALUES ('$user', '$email', '$hashed_password', 0, 'img/profil.png', 0, 3)")) {
                    $_SESSION['is_registred'] = true;
                    header('Location: starting_page.php');
                }
            }

            $db_connection->close();
        }
    } catch (Exception $e) {
        echo '<span style=color:red;">Błąd serwera!</span>';
    }
}
?>

<!DOCTYPE HTML>
<html lang="pl">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatile" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


    <title>AAbsurd - tworzenie nowego użytkownika</title>
    <meta name="description" content="Strona do nauki gry w brydża">
    <meta name="keywords" content="brydż, licytacja, rozgrywka, bridge, absurd">
    <meta name="author" content="Joanna Kokot">


    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .error {
            color: red;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <header>
        <nav class="navbar navbar-dark bg-absurd-col-light navbar-expand-md">
            <a class="navbar-brand" href="index.php">
                <img src="img/logo.png" widht="30" height="30" class="d-inline-block mr-1 align-bottom" alt="">
                Absurd
            </a>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="mainmenu">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Zaloguj</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link" href="registration.php">Zarejestruj</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="info.php">O stronie</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Kontakt</a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>

    <main>

        <!--  Okno rejestracji -->
        <div class="login-container d-flex align-items-center justify-content-center">
            <form class="login-form text-center" method="post" id="registration-form">
                <h1 class="mb-5 font-weight-light text-uppercase">Rejestracja</h1>
                <div class="form-group">
                    <input type="text" class="form-control rounded-pill form-control-lg" placeholder="Login" name="user">
                    <?php
                    if (isset($_SESSION['error_user'])) {
                        echo '<div class="error">' . $_SESSION['error_user'] . '</div>';
                        unset($_SESSION['error_user']);
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control rounded-pill form-control-lg" placeholder="Email" name="email">
                    <?php
                    if (isset($_SESSION['error_email'])) {
                        echo '<div class="error">' . $_SESSION['error_email'] . '</div>';
                        unset($_SESSION['error_email']);
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control rounded-pill form-control-lg" placeholder="Hasło" name="password1">
                    <?php
                    if (isset($_SESSION['error_password'])) {
                        echo '<div class="error">' . $_SESSION['error_password'] . '</div>';
                        unset($_SESSION['error_password']);
                    }
                    ?>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control rounded-pill form-control-lg" placeholder="Powtórz hasło" name="password2">
                </div>
                <div class="form-group">
                    <label>
                        <input type="checkbox" name="rules" /> Akceptuję regulamin
                    </label>

                    <?php
                    if (isset($_SESSION['error_rules'])) {
                        echo '<div class="error">' . $_SESSION['error_rules'] . '</div>';
                        unset($_SESSION['error_rules']);
                    }
                    ?>
                </div>
                <div class="form-group">
                    <div class="g-recaptcha" data-sitekey="6LcHc7wUAAAAAF2gHVVyoLBzI1x1iLfJA66g5bRf"></div>

                    <?php
                    if (isset($_SESSION['error_humanity'])) {
                        echo '<div class="error">' . $_SESSION['error_humanity'] . '</div>';
                        unset($_SESSION['error_humanity']);
                    }
                    ?>
                </div>
                <button type="submit" class="btn mt-5 btn-custom btn-block rounded-pill btn-lg bg-absurd-col-dark" value="Submit">Zarejestruj</button>
            </form>
        </div>


        <!--  .......................Okno rejestracji -->
    </main>

    <footer>

    </footer>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>