<?php

    session_start();

    if((!isset($_POST['login'])) || (!isset($_POST['password']))) {
        header('Location: index.php');
        exit();
    }

    require_once "connect.php";
    require_once "JWT/handleJWT.php";

    $db_connection = @new mysqli($host, $db_user, $db_password, $db_name);
    if($db_connection->connect_errno!=0) {
        echo "Error".$db_connection->connect_errno;
    } else {
        $login = $_POST['login'];
        $password = $_POST['password'];

        $login = htmlentities($login, ENT_QUOTES, "UTF-8");
    
        if($sql_query_result = @$db_connection->query(
        sprintf("SELECT * FROM bridgeplayers WHERE user='%s'", 
        mysqli_real_escape_string($db_connection, $login)))) {
            
            $result_counter = $sql_query_result->num_rows;
            if($result_counter > 0) {
                $db_row = $sql_query_result->fetch_assoc();

                if(password_verify($password, $db_row['pass'])) {

                    unset($_SESSION['error_login']);
                    $sql_query_result->free_result();
                    $payload = array(
                        "exp" => time() + 3600,
                        "id" => $db_row['id'],
                        "user" => $db_row['user'],
                        "email" => $db_row['email'],
                        "cezar" => $db_row['cezar'],
                        "profile_picture" => $db_row['profile_picture'],
                        "role" => $db_row['role'],
                        "player_points" => $db_row['player_points'],
                    );

                    $JWT = createJWT($payload);
                    setcookie("token", $JWT, [
                        'expires' => time() + 3600,
                        'samesite' => 'Strict',
                        'path' => '/',
                        'httponly' => true
                    ]);
                    header('Location: menu.php');
                } else {
                    $_SESSION['error_login'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                    header('Location: index.php');
                }
            } else {
                $_SESSION['error_login'] = '<span style="color:red">Nieprawidłowy login lub hasło!</span>';
                header('Location: index.php');
            }
        }

        $db_connection->close();
    }
