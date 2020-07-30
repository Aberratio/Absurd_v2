<?php

session_start();
include("lang/lang_eng.php");

$infos = new Infos();

if ((!isset($_POST['login'])) || (!isset($_POST['password']))) {
    header('Location: index.php');
    exit();
}

require_once "connect.php";
global $con;

$db_connection = @new mysqli($host, $db_user, $db_password, $db_name);

if ($db_connection->connect_errno != 0) {
    echo "Error" . $db_connection->connect_errno;
} else {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $login = htmlentities($login, ENT_QUOTES, "UTF-8");

    if ($sql_query_result = @$db_connection->query(
        sprintf(
            "SELECT * FROM bridgeplayers WHERE user='%s'",
            mysqli_real_escape_string($db_connection, $login)
        )
    )) {

        $result_counter = $sql_query_result->num_rows;
        if ($result_counter > 0) {
            $db_row = $sql_query_result->fetch_assoc();

            if (password_verify($password, $db_row['pass'])) {
                $_SESSION['is_logged'] = true;

                $_SESSION['id'] = $db_row['id'];
                $_SESSION['user'] = $db_row['user'];
                $_SESSION['email'] = $db_row['email'];
                $_SESSION['cezar'] = $db_row['cezar'];
                $_SESSION['profile_picture'] = $db_row['profile_picture'];
                $_SESSION['role'] = $db_row['role'];
                $_SESSION['player_points'] = $db_row['player_points'];
                $_SESSION['language'] = $db_row['language'];

                unset($_SESSION['error_login']);
                $sql_query_result->free_result();

                //Update inofs about login
                $update = "update bridgeplayers set last_login='" . date('Y-m-d H:i:s') . "', visits = visits + 1 where email='" . $_SESSION['email'] . "'";
                echo $update;
                $run = mysqli_query($con, $update);

                header('Location: menu.php');
            } else {
                $_SESSION['error_login'] = '<span style="color:red"> ' . $infos->invalid_login_or_password . ' </span>';
                header('Location: index.php');
            }
        } else {
            $_SESSION['error_login'] = '<span style="color:red"> ' . $infos->invalid_login_or_password . ' </span>';
            header('Location: index.php');
        }
    }

    $db_connection->close();
}
