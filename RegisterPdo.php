<?php
    session_start();
    require('execute.php');

    $error = [];
    if (isset($_POST['register']) && $_POST['register']){
        $connect = connectDb();
        if (empty($_POST['mail']))
            $error['mail'] = "<span style='color:red;'> Email không được để trống.</span>";
        else {
            if (!preg_match("/^[a-zA-Z0-9._]+@[a-zA-Z0-9-]+\.[a-zA-Z.].{0,255}$/",$mail)){
                $error['mail'] = "<span style='color:red;'> Email nhập chưa đúng định dạng.</span>";
            } else {
                $mail = trim($_POST['mail']);
                $sql = "SELECT COUNT(mail) AS num FROM users WHERE mail = :mail";
                $row = binValueMail($stmt, $sql, $mail)->fetch(PDO::FETCH_ASSOC);
                if ($row['num'] > 0){
                    $error['mail'] = "<span style='color:red;'> Email đã tồn tại.</span>";
                }
            } 
        }

        if (empty($_POST['name'])){
            $error['name'] = "<span style='color:red;'> Tên không được để trống.</span>";
        } else {
            $name = trim($_POST['name']);
            if (!preg_match("/^[a-zA-Z0-9._]{6,200}$/",$name)) 
                $error['name'] = "<span style='color:red;'> Tên nhập chưa đúng định dạng.</span>";
        }

        if (empty($_POST['phone'])){
            $error['phone'] = "<span style='color:red;'> Số điện thoại không được để trống.</span>";
        } else {
            $phone = trim($_POST['phone']);
            if (!preg_match("/^[0-9]{10,20}$/",$phone)) 
                $error['phone'] = "<span style='color:red;'> Số điện thoại nhập chưa đúng định dạng.</span>";
        }

        if (empty($_POST['address'])){
            $error['address'] = "<span style='color:red;'> Địa chỉ không được để trống.</span>";
        } else {
            $address = trim($_POST['address']);
        }

        if (empty($_POST['password'])){
            $error['password'] = "<span style='color:red;'> Mật khẩu không được để trống.</span>";
        }
        else {
            if (!preg_match("/^[a-zA-Z0-9._]{6,100}$/", $_POST['password'])) 
                $error['password'] = "<span style='color:red;'> Mật khẩu nhập chưa đúng định dạng.</span>";
            $password = trim(password_hash($_POST["password"], PASSWORD_BCRYPT));
        }

        if (empty($_POST['confirm_password'])){
            $error['confirm_password'] = "<span style='color:red;'> Xác nhận mật khẩu không được để trống.</span>";
        } else {
            if ($_POST['password'] === $_POST['confirm_password']) 
                $confirm_password = trim($_POST['confirm_password']);
            else    
                $error['confirm_password'] = "<span style='color:red;'> Mật khẩu và xác nhận mật khẩu không khớp.</span>";
        }

        if (empty($error)){
            try {
                $sql = "INSERT INTO users (name, mail, password, phone, address) VALUES (:name, :mail, :password, :phone, :address)";
				$user = executeSql($stmt, $sql, $name, $mail, $password, $phone, $address);
                $Redirect = url('LoginPdo.php');
                ob_start();
                echo '<script language="javascript">window.location.href ="'.$Redirect.'"</script>';
                ob_end_flush();
				exit;
			} catch (PDOException $e) {
				echo $e->getMessage();
			}
        }
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <title>Register</title>
</head>

<body>
    <div class="container">
        <?php 
            if (isset($success)){
                echo '<div class="alert alert-success">'.$success.'</div>';
            }
	    ?>
        <div class="panel-heading">
            <h3 class="panel-title">Register</h3>
        </div>

        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Email address</label>
                <input type="email" id="form2Example1" class="form-control" name="mail" />
                <?php echo $error['mail'] ?>
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Name</label>
                <input type="text" id="form2Example1" class="form-control" name="name" />
                <?php echo $error['name'] ?>
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Phone</label>
                <input type="text" id="form2Example1" class="form-control" name="phone" />
                <?php echo $error['phone'] ?>
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Address</label>
                <input type="text" id="form2Example1" class="form-control" name="address" />
                <?php echo $error['address'] ?>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example2">Password</label>
                <input type="password" id="form2Example2" class="form-control" name="password" />
                <?php echo $error['password'] ?>
            </div>

            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example2">Password Confirm</label>
                <input type="password" id="form2Example2" class="form-control" name="confirm_password" />
                <?php echo $error['confirm_password'] ?>
            </div>

            <!-- Submit button -->
            <input type="submit" class="btn btn-primary btn-block mb-4" name="register" value="Register" />
        </form>
    </div>
</body>

</html>