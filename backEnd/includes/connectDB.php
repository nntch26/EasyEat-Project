<?php

    $db_host = "161.246.127.24";
    $db_port = 9041;
    $db_user = "clswsxdz60005bsmnhc5pc95b";
    $db_password = "yFvP9V42vLTdP4vlOufQY1OA";
    $db_name = "Easyeat";

    // Create connection
    try {
        // เชื่อมต่อกับ MySQL
        $db = new PDO("mysql:host=$db_host;port=$db_port;dbname=$db_name", $db_user, $db_password);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "Success!";
    } catch (PDOException $e) {
        echo "Failed to connect" . $e->getMessage();
    }

?>