<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Fanon - Додати фільм</title>
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
    <div class="addmovie_form">
    <h1 class="form_title">Додати фільм</h1>
        <form method="POST" action="postmovie.php" enctype="multipart/form-data">
            <input type="text" name="mv_name" placeholder="Введіть назву фільму" required><br>
            </p>
            <select name="mv_category" id="" required>
                <option value="">Виберіть категорію фільму</option>
                <option value="фільми">Фільми</option>
                <option value="мультфільми">Мультфільми</option>
                <option value="серіали">Серіали</option>
                <option value="аніме">Аніме</option>
            </select><br>
            </p>
            <select name="mv_genre" id="" required>
                <option value="">Виберіть жанр фільму</option>
                <option value="бойовик">Бойовик</option>
                <option value="пригоди">Пригоди</option>
                <option value="комедія">Комедія</option>
                <option value="драма">Драма</option>
                <option value="фентезі">Фентезі</option>
                <option value="жахи">Жахи</option>
                <option value="трилер">Трилер</option>
                <option value="вестерн">Вестерн</option>
            </select><br>
            </p>
            <input type="date" name="mv_date" required><br>
            </p>
            <input type="text" name="mv_director" placeholder="Введіть режисера фільму" required><br>
            </p>
            <input type="number" name="mv_rate" placeholder="Введіть рейтинг фільму" min="0" max="10" step="0.02" required><br>
            </p>
            <input type="number" name="mv_duraction" placeholder="Тривалість фільму в хв." min="1" required><br>
            </p>
            <textarea name="mv_description" id="" cols="30" rows="7" placeholder="Введіть окреслення фільму" required></textarea><br>
            </p>
            <label for="file">Виберіть зображення для завантаження</label>
            <input type="file" name="img" required>
            </p>
            <label for="file">Виберіть відео для завантаження</label>
            <input type="file" name="video" required>
            </p>
            <input type="submit" name="submit" value="Додати">
            <input type="reset" name="clear" value="Очистити">
        </form>
    </div>
</div>
</body>
</html>