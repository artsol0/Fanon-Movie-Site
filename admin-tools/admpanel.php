<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Fanon - Панель адміністратора</title>
</head>
<body>

<?php 
    session_start();
    if (isset($_SESSION['succesfulllog'])) {
        if ($_SESSION['adminStatus'] == 0) {
            echo ("<script>alert('Ви не адмін!');window.location.href='../index.php';</script>");
        } else {
            $log = "<a href='../logout.php'>Вийти</a> / <a href='admpanel.php'>Панель адміністратора</a>";
        }
    }
    else {
        echo ("<script>alert('Ви не ввійшли в систему!');window.location.href='../index.php';</script>");
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
    <div class="adm-pnl">
        <h1 class='form_title'>Панель адміністратора</h1>
        <h3 class='form_title'>Виберіть, який інструмент ви хочете використовувати.</h3>
        <nav class="adm-pnl-menu">
            <button class="btn-tool" onclick="location.href='usrmanager.php'">Users manager</button>
            <button class="btn-tool" onclick="location.href='filmmanager.php'">Films manager</button>
            <button class="btn-tool" onclick="location.href='viewmessages.php'">View messages</button>
        </nav>
    </div>
</div>

</body>
</html>