<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Fanon - Увійти</title>
</head>
<body>
    
<?php
    session_start();
    include 'db.php';
?>


<header style="margin-bottom: 15px;">
        <div class="logo">
            <a href='index.php' class='logo-style'>Fanon</a> 
        </div>
        <div class="menu">
            <div class="menu-nav">
                <a href='login.php'>Увійти</a> / <a href='register.php'>Реєстрація</a>
            </div>
        </div>
</header>

<div class="sector">
    <div class="login_form">
        <h1 class="form_title">Ласкаво просимо до Fanon</h1>
        <form method="POST" action="login.php">
            Ім'я користувача<br>
            <input type="text" name="name" required><br>
            </p>
            Пароль<br>
            <input type="password" name="pwd" required><br>
            </p>
            <input type="submit" name="submit" value="Увійти">
            <input type="reset" name="clear" value="Очистити">
        </form>
    </div>
</div>

<?php
if (isset($_REQUEST['submit'])) {

    $user = addslashes($_POST['name']);
    $password = addslashes($_POST['pwd']);

    $sql = "SELECT * FROM user WHERE uname = '$user'";

    $row = $conn->query($sql); 
    if(mysqli_num_rows($row) != 0) {
        $r = $row->fetch_assoc();
        if (password_verify($password,$r['upassword'])) {
            $_SESSION['succesfulllog']=1;
            $_SESSION['uid'] = $r["id"];
            $_SESSION['uname'] = $r["uname"];
            $_SESSION['email'] = $r["email"];
            $_SESSION['adminStatus'] = $r["adminStatus"];
            echo("<script>window.location.href='index.php';</script>");
        } else {
            echo("<div style='margin-left: 25%; width:50%; background-color: #ffff00; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#ff0000;'>Неправильне Ім'я користувача або Пароль</b></div>");
        }
    } else {
        echo("<div style='margin-left: 25%; width:50%; background-color: #ffff00; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#ff0000;'>Неправильне Ім'я користувача або Пароль</b></div>");
    }

}
?>

</body>
</html>