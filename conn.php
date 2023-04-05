<?php
$server = "localhost";
$user = "root";
$password = "";
$database = "metopen-app";

$mysqli = new mysqli($server, $user, $password, $database);

if ($mysqli->connect_error) {
    error_log('Connection error: ' . $mysqli->connect_error);
}
