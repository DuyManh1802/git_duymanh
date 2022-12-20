<?php 
    session_start();
    unset($_SESSION['mail']);
    $host  = $_SERVER['HTTP_HOST'];
    $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
    $extra = 'LoginPdo.php';
    $urlRedirect = "http://".$host.$uri."/".$extra;
    ob_start();
    echo '<script language="javascript">window.location.href ="'.$urlRedirect.'"</script>';
    ob_end_flush();
    exit;
?>