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
      $sql = "INSERT INTO users (mail, name, password, phone, address)
              VALUES ('manh123@gmail.com', 'Manh', '123456', '012345678', 'Ha Noi')";
    
      // use exec() because no results are returned
      $conn->exec($sql);
      echo "Insert successfully";
    } catch(PDOException $e) {
      echo "<br>" . $e->getMessage();
    }
    
    $conn = null;
  
?>