<?php 
    function executeSql($stmt, $sql, $name, $mail, $password, $phone, $address)
    {
        $stmt->prepare($sql);
        $stmt->execute(array(
            ':name' => $name,
            ':mail' => $mail,
            ':password' => $password,
            ':phone' => $phone,
            ':address' => $address,
            ));
        return $stmt;
    }

    function binValueMail($stmt, $sql, $mail)
    {
        $stmt->prepare($sql);
        $stmt->bindValue(':mail', $mail);
        $stmt->execute();
        return $stmt;
    }

    function url($url)
    {
        $host  = $_SERVER['HTTP_HOST'];
        $uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $urlRedirect = "http://".$host.$uri."/".$url;
        return $urlRedirect;
    }
    function connectDb()
    {
        $servername = "db";
        $username = "laravel";
        $dbpassword = "secret";
        $dbname = "manhpdo";

        try {
            $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $dbpassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Lỗi connect db : ". $e->getMessage());
        }
    }

    function createSql($sql)
    {
        $servername = "db";
        $username = "laravel";
        $dbpassword = "secret";
        $dbname = "manhpdo";
        
        try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $dbpassword);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->exec($sql);
        echo "Insert successfully";
        } catch(PDOException $e) {
        echo "<br>" . $e->getMessage();
        }
    }
?>