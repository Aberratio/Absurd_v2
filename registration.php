<?php
session_start();

if (isset($_POST['user'])) {
    $is_good = true;

    //checking user
    $user = $_POST['user'];
    if ((strlen($user) < 3) || (strlen($user) > 20)) {
        $is_good = false;
        $_SESSION['error_user'] = "The username must contain between 3 and 20 characters.";
    }

    if (ctype_alnum($user) == false) {
        $is_good = false;
        $_SESSION['error_user'] = "The username can only contain letters (without non-english characters) and numbers.";
    }

    //checking email
    $email = $_POST['email'];
    $save_email = filter_var($email, FILTER_SANITIZE_EMAIL);

    if ((filter_var($save_email, FILTER_VALIDATE_EMAIL) == false) || ($save_email != $email)) {
        $is_good = false;
        $_SESSION['error_email'] = "Incorrect email address";
    }

    //checking password
    $password_one = $_POST['password1'];
    $password_two = $_POST['password2'];

    if ((strlen($password_one) < 8) || (strlen($password_one) > 60)) {
        $is_good = false;
        $_SESSION['error_password'] = "The password must contain between 8 and 60 characters.";
    }

    if ($password_one != $password_two) {
        $is_good = false;
        $_SESSION['error_password'] = "Passwords must be identical.";
    }

    $hashed_password = password_hash($password_one, PASSWORD_DEFAULT);

    //checking rules box
    if (!isset($_POST['rules'])) {
        $is_good = false;
        $_SESSION['error_rules'] = "Accept the terms.";
    }


    //saving language
    $language = $_POST['language'];

    //checking humanity
    // $secret_key = "6LdKvrAZAAAAAA7CRG5UbPc6JFqcCMhUVaf2wFZc";
    // $check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret_key . '&response=' . $_POST['g-recaptcha-response']);
    // $response = json_decode($check);

    // if ($response->success == false) {
    //     $is_good = false;
    //     $_SESSION['error_humanity'] = "Boot detected";
    // }

    require_once "connect.php";
    mysqli_report(MYSQLI_REPORT_STRICT);

    try {
        $db_connection = new mysqli($host, $db_user, $db_password, $db_name);
        if ($db_connection->connect_errno != 0) {
            throw new Exception(mysqli_connect_errno());
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
                if ($db_connection->query("INSERT INTO bridgeplayers (`user`, `email`, `pass`, `cezar`, `profile_picture`, `player_points`, `role`, `language`) 
                    VALUES ('$user', '$email', '$hashed_password', 0, 'img/profil.png', 0, 3, $language)")) {
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

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <script src="https://kit.fontawesome.com/fe0a0fefeb.js" crossorigin="anonymous"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="css/bootstrap.css" />
    <link rel="stylesheet" href="css/style3.css" />
    <title>Absurd - Bridge Platform</title>
    <style>
        .error {
            color: red;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="site-container">
        <div class="container mt-5 mb-5">
            <div class="card main-form p-5 m-auto">
                <!-- LOGO -->
                <div class="row align-items-center justify-content-center mb-3">
                    <img class="col-5 col-sm-3 col-md-3 logo mr-sm-3" src="img/logo_Asia.png" alt="Absurd - logo" class="logo" />
                    <h1 class="col-12 col-sm-5 text-center">Absurd</h1>
                    <img class="col-5 col-sm-3 col-md-3 logo mr-sm-3" src="img/logo_Domi.png" alt="Absurd - logo" class="logo" />
                </div>
                <!-- REGISTER FORM -->

                <form class="login-form text-center" method="post" id="registration-form">
                    <!-- TEXT FIELD GROUPS -->
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text "><i class="fas fa-user"></i></span>
                        </div>
                        <input class="form-control" type="text" id="nickname" name="user" placeholder="Nickname" />
                    </div>
                    <?php
                    if (isset($_SESSION['error_user'])) {
                        echo '<div class="error text-secondary">' . $_SESSION['error_user'] . '</div>';
                        unset($_SESSION['error_user']);
                    }
                    ?>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text "><i class="fas fa-envelope"></i></span>
                        </div>
                        <input class="form-control" type="email" id="email" name="email" placeholder="Email" />
                    </div>
                    <?php
                    if (isset($_SESSION['error_email'])) {
                        echo '<div class="error text-secondary">' . $_SESSION['error_email'] . '</div>';
                        unset($_SESSION['error_email']);
                    }
                    ?>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text "><i class="fas fa-unlock-alt"></i></span>
                        </div>
                        <input class="form-control" type="password" id="password" name="password1" placeholder="Password" />
                    </div>
                    <?php
                    if (isset($_SESSION['error_password'])) {
                        echo '<div class="error text-secondary">' . $_SESSION['error_password'] . '</div>';
                        unset($_SESSION['error_password']);
                    }
                    ?>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text "><i class="fas fa-unlock-alt"></i></span>
                        </div>
                        <input class="form-control" type="password" id="repeat_password" name="password2" placeholder="Repeat Password" />
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text "><i class="fas fa-globe-americas"></i></span>
                        </div>
                        <select class="form-control" name="language">
                            <option value='1'>English</option>
                            <option value='0'>Polski</option>
                        </select>
                    </div>

                    <div class="input-group mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="rules" id="gridCheck" />
                            <label class="form-check-label" for="gridCheck">I accept the
                                <b style="cursor: pointer" data-toggle="tooltip" data-placement="top" title="Have fun!">
                                    terms
                                </b>
                            </label>
                        </div>
                    </div>
                    <?php
                    if (isset($_SESSION['error_rules'])) {
                        echo '<div class="error text-secondary">' . $_SESSION['error_rules'] . '</div>';
                        unset($_SESSION['error_rules']);
                    }
                    ?>
                    <script>
                        $(function() {
                            $('[data-toggle="tooltip"]').tooltip()
                        })
                    </script>

                    <!-- <div class="input-group mb-3">
                        <div class="g-recaptcha" data-sitekey="6LcHc7wUAAAAAF2gHVVyoLBzI1x1iLfJA66g5bRf"></div>
                    </div>
                    <?php
                    // if (isset($_SESSION['error_humanity'])) {
                    //     echo '<div class="error text-secondary">' . $_SESSION['error_humanity'] . '</div>';
                    //     unset($_SESSION['error_humanity']);
                    // }
                    ?> -->

                    <button class="btn btn-secondary btn-block" type="submit" value="Submit">Start the adventure</button>

                    <div class="mb-4 mt-4">
                        <p class="text-center">OR</p>
                    </div>
                    <a class="btn btn-primary btn-block" href="index.php">I already have an account</a>
                </form>
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