<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fanon - Реєстрація</title>
</head>
<body>

<?php
    session_start();
    if (isset($_SESSION['succesfulllog'])) {
        $log = "<a href='logout.php'>Вийти</a>";
        if ($_SESSION['adminStatus']) {
            $log = $log . " / <a href='admin-tools/admpanel.php'>Панель адміністратора</a>";
        }
    }
    else {
        $log = "<a href='login.php'>Увійти</a> / <a href='register.php'>Реєстрація</a>";
    }
    include 'db.php';
?>

<header style="margin-bottom: 15px;">
    <div class="logo">
        <a class="logo-style" href='index.php'>Fanon</a> 
    </div>
    <div class="menu">
        <div class="menu-nav">
            <?php 
                echo($log);
            ?>
        </div>
    </div>
</header>

<div class="sector">
    <div class="login_form">
    <h1 class="form_title">Реєстрація на Fanon</h1>
        <form method="POST" action="register.php">
            Введіть ім'я користувача<br>
            <input type="text" name="name" required><br>
            </p>
            Введіть адресу електронної пошти<br>
            <input type="text" name="uemail" required><br>
            </p>
            Введіть пароль<br>
            <input type="password" name="pwd" required><br>
            </p>
            Підтвердити пароль<br>
            <input type="password" name="confirm-pwd" required><br>
            </p>
            <input type="submit" name="submit" value="Надіслати">
            <input type="reset" name="clear" value="Очистити">
        </form>
    </div>
</div>

<?php 
if (isset($_REQUEST['submit'])) {
    $user = $_POST['name'];
    $email = $_POST['uemail'];
    $password = $_POST['pwd'];
    $confirm_password = $_POST['confirm-pwd'];

    $check_email = "SELECT * FROM user WHERE email = '$email'";
    if (mysqli_num_rows($conn->query($check_email))>0) {
        echo("<div style='margin-left: 25%; width:50%; background-color: #ffff00; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#ff0000;'>Електронна пошта вже існує</b></div>");
    } else {
        if (!preg_match("/^[a-zA-Z-' ]*$/",$user)) {
            echo("<div style='margin-left: 25%; width:50%; background-color: #ffff00; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#ff0000;'>Дозволені лише літери та пробіли</b></div>");
        } else {
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo("<div style='margin-left: 25%; width:50%; background-color: #ffff00; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#ff0000;'>Недійсний формат електронної пошти</b></div>");
            } else {
                if (!preg_match('@[A-Z]@',$password)) {
                    echo("<div style='margin-left: 25%; width:50%; background-color: #ffff00; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#ff0000;'>Пароль має містити принаймні одну велику літеру</b></div>");
                } else {
                    if (!preg_match('@[a-z]@',$password)) {
                        echo("<div style='margin-left: 25%; width:50%; background-color: #ffff00; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#ff0000;'>Пароль має містити принаймні одну малу літеру</b></div>");
                    } else {
                        if (!preg_match('@[0-9]@',$password)) {
                            echo("<div style='margin-left: 25%; width:50%; background-color: #ffff00; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#ff0000;'>Пароль має містити принаймні одну цифру</b></div>");
                        } else {
                            if (strlen($password) < 8) {
                                echo("<div style='margin-left: 25%; width:50%; background-color: #ffff00; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#ff0000;'>Пароль має бути не менше 8 символів</b></div>");
                            } else {
                                if ($password == $confirm_password) {
                                    $hash = password_hash("$password",PASSWORD_BCRYPT);
                        
                                    $registartion = "INSERT INTO user(uname,upassword,email) VALUES('$user','$hash','$email')";
                                    $result = $conn->query($registartion);
                        
                                    if ($result) {
                                        echo("<div style='margin-left: 25%; width:50%; background-color: #008000; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#abf1a1;'>Реєстрація завершена успішно</b></div>");
                                    } else {
                                        echo("<div style='margin-left: 25%; width:50%; background-color: #ffff00; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#ff0000;'>Щось пішло не так. Спробуйте ще раз пізніше</b></div>");
                                    }
                                } else {
                                    echo("<div style='margin-left: 25%; width:50%; background-color: #ffff00; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#ff0000;'>Пароль і його підтвердження не збігається</b></div>");
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}
?>
</body>
</html>