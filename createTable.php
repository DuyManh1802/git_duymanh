<?php
    require('execute.php');

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
    createSql($sql);
?>