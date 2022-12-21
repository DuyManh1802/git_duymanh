<?php 
    session_start();
    require('execute.php');

    unset($_SESSION['mail']);
    url('LoginPdo.php');
    exit;
?>