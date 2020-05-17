<?php
    setcookie("token","", [
    'expires' => time() - 86400,
    'path' => '/',
    'samesite' => 'Strict',
    'httponly' => true
    ]);
    session_start();
    session_unset();
    header('Location: index.php');
?>