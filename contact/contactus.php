<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Fanon - Зворотній зв'язок</title>
</head>
<body>

<?php
    session_start();
    if (isset($_SESSION['succesfulllog'])) {
        $log = "<a href='../logout.php'>Вийти</a>";
        if ($_SESSION['adminStatus']) {
            $log = $log . " / <a href='../admin-tools/admpanel.php'>Панель адміністратора</a>";
        }
    }
    else {
        $log = "<a href='../login.php'>Увійти</a> / <a href='../register.php'>Реєстрація</a>";
    }
    include '../db.php';
?>

<header style="margin-bottom: 15px;">
        <div class="logo">
            <a class="logo-style" href='../index.php'>Fanon</a> 
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
    <h1 class="form_title">Зв'яжіться з нами</h1>
        <form method="POST" action="contactus.php">
            <input type="text" name="title" placeholder="Заголовок повідомлення" required><br>
            </p>
            <textarea name="message_text" id="" cols="40" rows="10" placeholder="Ваше повідомлення" required></textarea>
            </p>
            <input type="submit" name="submit" value="Надіслати">
            <input type="reset" name="clear" value="Скинути">
        </form>
    </div>
</div>

<?php 
if (isset($_REQUEST['submit'])) {
    $uid = $_SESSION['uid'];
    $user = $_SESSION['uname'];
    $email = $_SESSION['email'];
    $title = addslashes($_POST['title']);
    $message_text = addslashes($_POST['message_text']);

    $add_message = "INSERT INTO messages(id_user,uname,email,title,message_text) VALUES('$uid','$user','$email','$title','$message_text')";

    if (isset($_SESSION['succesfulllog'])) {
        $result = $conn->query($add_message);
        if ($result) {
            echo("<div style='margin-left: 25%; width:50%; background-color: #008000; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#abf1a1;'>Повідомлення надіслано</b></div>");
        } else {
            echo("<div style='margin-left: 25%; width:50%; background-color: #ffff00; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#ff0000;'>Щось пішло не так. Спробуйте ще раз пізніше</b></div>");
        }
    } else {
        echo("<div style='margin-left: 25%; width:50%; background-color: #ffff00; text-align:center; padding:1px; border-radius: 0px 0px 10px 7px;'><b style='color:#ff0000;'>Тільки зареєстровані користувачі можуть залишати повідомлення</b></div>");
    }
}
?>
</body>
</html>