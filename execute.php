<?php 
    define('SERVERNAME', 'db');
    define('USERNAME', 'laravel');
    define('DBPASSWORD', 'secret');
    define('DBNAME', 'manhpdo');

    $conn = new PDO("mysql:host=".SERVERNAME."; dbname=".DBNAME, USERNAME, DBPASSWORD);

    function execSql($sql,  $mail, $password)
    {
        $stmt = $GLOBALS['conn']->prepare($sql);
        $stmt->execute(array(
            ':name' => $_POST['name'],
            ':mail' => $mail,
            ':password' => $password,
            ':phone' => $_POST['phone'],
            ':address' => $_POST['address'],
            ));
    }

    function binValueMail($sql, $mail)
    {
        
        $stmt = $GLOBALS['conn']->prepare($sql);
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        return $stmt;
    }

    function url($url)
    {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $urlRedirect = "http://".$host.$uri."/".$url;
        ob_start();
        echo '<script language="javascript">window.location.href ="'.$urlRedirect.'"</script>';
        ob_end_flush();
    }
    function connectDb()
    {
        try {
            $GLOBALS['conn']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Lỗi connect db : ". $e->getMessage());
        }
    }

    function createSql($sql)
    {
        try {
            $GLOBALS['conn']->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $GLOBALS['conn']->exec($sql);
            echo "Insert successfully";
        } catch(PDOException $e) {
            echo "<br>" . $e->getMessage();
        }
    }
?>