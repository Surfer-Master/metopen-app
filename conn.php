<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "project_mikroprosesor";

    $conn = mysqli_connect($server, $user, $password, $database);

    if ($conn->connect_error) {
        die("Database Connection Failed: " . $conn->connect_error);
    }

?>