<?php
    $servername = "db";
    $username = "laravel";
    $dbpassword = "secret";
    $dbname = "manhpdo";

    try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    ////// $sql = "CREATE DATABASE IF NOT EXISTS manhpdo";
    // $conn->exec($sql);
    // echo "Database created successfully<br>";
    } catch(PDOException $e) {
        die("Lỗi connect db : ". $e->getMessage());
    }

    // $conn = null;

?>


