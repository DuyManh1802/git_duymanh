<?php
    
    $servername = "db";
    $username = "laravel";
    $dbpassword = "secret";
    $dbname = "manhpdo";
    
    try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpassword);
      // set the PDO error mode to exception
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      // sql to create table
      $sql = "CREATE TABLE IF NOT EXISTS users (
        ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        mail VARCHAR(255),
        name VARCHAR(255),
        password VARCHAR(255),
        phone VARCHAR(255),
        address VARCHAR(255),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updateed_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
        )";  
    
      // use exec() because no results are returned
      $conn->exec($sql);
      echo "Table created successfully";
    } catch(PDOException $e) {
      echo "<br>" . $e->getMessage();
    }
    
    $conn = null;
  
?>