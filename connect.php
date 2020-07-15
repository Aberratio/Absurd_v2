<?php
$host = "localhost";
$db_user = "bridgeab_absurd";
$db_password = "Absurd-49";
$db_name = "bridgeab_absurd";

$con = mysqli_connect($host, $db_user, $db_password, $db_name) or die("Connection was not established");
$con->query("SET NAMES 'utf8' COLLATE 'utf8_general_ci'");
$con->query("SET CHARSET utf8");
