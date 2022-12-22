<?php
    require('execute.php');
    
    $sql = "INSERT INTO users (mail, name, password, phone, address)
              VALUES ('manh123@gmail.com', 'Manh', '123456', '012345678', 'Ha Noi')";
    createSql($sql);
?>