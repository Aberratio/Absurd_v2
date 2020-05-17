<?php
use \Firebase\JWT\JWT;
require "getENV.php";

function createJWT ($payload)
{
    try {
        $secret = getenv('SECRET');
        return JWT::encode($payload, base64_decode(strtr($secret, '-_', '+/')), 'HS256');
    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        return null;
    }
}
function validateJWTAndReturnPayload ($token)
{
    try {
        $secret = getenv('SECRET');
        return  JWT::decode($token, base64_decode(strtr($secret, '-_', '+/')), ['HS256']);

    } catch (Exception $e) {
        echo 'Caught exception: ',  $e->getMessage(), "\n";
        header('Location: logout.php');
        exit();
    }
}