<?php
    session_start();
    require('execute.php');
    
    if (isset($_POST['submit']) && $_POST['submit']){
        $error = [];

        if (empty($_POST['mail'])){
            $error['mail'] = "<span style='color:red;'> Email không được để trống.</span>";
        } else {
            if (!preg_match("/^[a-zA-Z0-9._]+@[a-zA-Z0-9-]+\.[a-zA-Z.].{0,255}$/", trim($_POST['mail']))){
                $error['mail'] = "<span style='color:red;'> Email nhập chưa đúng định dạng.</span>";
            } 
        }

        if (empty($_POST['password'])){
            $error['password'] = "<span style='color:red;'> Mật khẩu không được để trống.</span>";
        } 

        if (empty($error)){
            $mail = trim($_POST['mail']);
            $pass = trim($_POST['password']);
            $sql = "SELECT *FROM users WHERE mail = '$mail'";
            $user = execSql($sql)->fetch(PDO::FETCH_ASSOC);
            $validPassword = password_verify($pass, $user['password']);

            if (trim($_POST['mail']) === $user['mail'] && $validPassword){
                $_SESSION['mail'] = $user['mail'];

                if (isset($_POST['remember']) && $_POST['remember']){
                    setcookie('cookie_mail', $mail, time() + (3600*24*7));
                    setcookie('cookie_password', $pass, time() + (3600*24*7));
                } else {
                    if (isset($_COOKIE['mail'])){
                        setcookie('cookie_mail', '');
                    }
                    if (isset($_COOKIE['password'])){
                        setcookie('cookie_password', '');
                    }
                }

                echo "<script type='text/javascript'>alert('Đăng nhập thành công.');</script>";
                urlRedirect('LoginSuccessPdo.php');
                exit;
            } else {
                echo "<script type='text/javascript'>alert('Đăng nhập thất bại. Email hoặc mật khẩu không chinh xác');</script>";
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
    <title>Log in</title>
</head>

<body>
    <div class="container">
        <?php     
            if (isset($success)){
                echo '<div class="alert alert-success">'.$success.'</div>';
            }
	    ?>

        <div class="panel-heading">
            <h3 class="panel-title">Sign In</h3>
        </div>

        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <!-- Email input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example1">Email address</label>
                <input type="email" id="form2Example1" class="form-control" name="mail" />
                <?php echo $error['mail'] ?>
            </div>

            <!-- Password input -->
            <div class="form-outline mb-4">
                <label class="form-label" for="form2Example2">Password</label>
                <input type="password" id="form2Example2" class="form-control" name="password" />
                <?php echo $error['password'] ?>
            </div>

            <!-- 2 column grid layout for inline styling -->
            <div class="row mb-4">
                <div class="col d-flex justify-content-center">
                    <!-- Checkbox -->
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="" checked name="remember" />
                        <label class="form-check-label" for="form2Example31"> Remember me </label>
                    </div>
                </div>

                <div class="col">
                    <!-- Simple link -->
                    <a href="#!">Forgot password?</a>
                </div>
            </div>

            <!-- Submit button -->
            <input type="submit" class="btn btn-primary btn-block mb-4" name="submit" value="Login" />

            <!-- Register buttons -->
            <div class="text-center">
                <p>Not a member? <a href="./RegisterPdo.php">Register</a></p>
            </div>
        </form>
    </div>
</body>

</html>