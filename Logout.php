<?php 
    session_start();
    require('execute.php');

    unset($_SESSION['mail']);
    urlRedirect('LoginPdo.php');
    exit;
?>