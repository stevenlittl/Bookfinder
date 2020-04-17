<?php
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "853ojBlv1r3fZ9a9";
    $dbname = "bookfinder";
    // create connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
    if (mysqli_connect_error()) {
        die('Connect Error('. mysqli_connect_errno().')'. mysqli_connect_error());
    }
?>