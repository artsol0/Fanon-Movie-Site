<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="
    пошук фільмів за жанром,
    знайти фільми за жанром,
    пошук відео за жанром">
    <meta name="description" content="
    Шукайте за жанрами та дивіться фільми онлайн безкоштовно в хорошій якості">
    <link rel="stylesheet" href="../../style.css">
    <title>Fanon - Шукайте та дивіться фільми за жанром онлайн безкоштовно в хорошій якості</title>
</head>
<body>

    <?php 
    include '../../db.php';
    session_start();
    if (isset($_SESSION['succesfulllog'])) {
        $log = "<a href='../../logout.php'>Вийти</a> / <a href='../../watchlatter/watchlist.php'>Переглянути пізніше</a>";
        if ($_SESSION['adminStatus']) {
            $log = "<a href='../../logout.php'>Вийти</a> / <a href='../../admin-tools/admpanel.php'>Панель адміністратора</a>";
        }
    }
    else {
        $log = "<a href='../../login.php'>Увійти</a> / <a href='../../register.php'>Реєстрація</a>";
    }
    ?>

    <header style="margin-bottom: 15px;">
            <div class="logo">
                <a class="logo-style" href='../../index.php'>Fanon</a> 
            </div>
            <div class="menu">
                <div class="menu-nav">
                    <?php 
                        echo($log);
                    ?>
                </div>
            </div>
    </header>

    <div class="search-field">
        <form method="POST" action="../byname/searchmovie.php">
            <input type="text" name="search" placeholder="Пошук фільму">
            <button type="submit" name="submit" class="btn-search">Пошук</button>
        </form>
    </div>

    <div class="sector">
        <form style="text-align: center; margin-bottom: 10px;" method="POST" action="../../index.php">
            <button type="submit" name="submit" class="btn">Назад</button>
        </form>
        <div class="btn-genre">
            <form method="POST" action="searchgenre.php" class="set-genre">
            <b style="color: #ffffff; text-shadow: #d500ff 1px 0 10px;">Категорія:</b>
            <select class="category-select" name="mv_category" required>
                <option value="all">Всі</option>
                <option value="фільми">Фільми</option>
                <option value="мультфільми">Мультфільми</option>
                <option value="серіали">Серіали</option>
                <option value="аніме">Аніме</option>
            </select>
            <b style="color: #ffffff; text-shadow: #d500ff 1px 0 10px;">Жанр:</b>
                <button type="submit" name="submit" value="all" class="btn">Всі</button>
                <button type="submit" name="submit" value="бойовик" class="btn">Бойовик</button>
                <button type="submit" name="submit" value="пригоди" class="btn">Пригоди</button>
                <button type="submit" name="submit" value="комедія" class="btn">Комедія</button>
                <button type="submit" name="submit" value="драма" class="btn">Драма</button>
                <button type="submit" name="submit" value="фентезі" class="btn">Фентезі</button>
                <button type="submit" name="submit" value="жахи" class="btn">Жахи</button>
                <button type="submit" name="submit" value="трилер" class="btn">Трилер</button>
                <button type="submit" name="submit" value="вестерн" class="btn">Вестерн</button>
            </form>
        </div>

        <div class="adm-pnl">

        <?php 
        if (isset($_POST['submit'])) {
            $genre = $_POST['submit'];
            $category = $_POST['mv_category'];
            $quaery = "";

            if ($category == "all") {
                if ($genre == "all") {
                    $quaery = "SELECT * FROM movie";
                } else {
                    $quaery = "SELECT * FROM movie WHERE mv_genre = '$genre'";
                }
            } else {
                if ($genre == "all") {
                    $quaery = "SELECT * FROM movie WHERE mv_category = '$category'";
                } else {
                    $quaery = "SELECT * FROM movie WHERE mv_genre = '$genre' AND mv_category = '$category'";
                }
            }

            $run = mysqli_query($conn,$quaery);
            $count = mysqli_num_rows($run);
            if ($count == 0) {
                echo("<div style='padding: 3px; background-color: #ffff00'><b style='color:#ff0000;'>Не можемо знайти $category в жанрі $genre</b></div>");
            } else {
                while ($row = mysqli_fetch_assoc($run)) {
        ?>

        <div class="films-pnl">
            <div class="container">
                <div class="movie-card-index">
                    <div class="movie-poster">
                        <a href="../../movies/viewmovie.php?id=<?php echo($row['id'])?>"><?php echo("<img alt='$row[mv_name]' style='border-radius: 10px; cursor: pointer;' width='175px' height='275px' src='../../posters/".$row["img"]."'>");?></a>
                    </div>
                        <a href="../../movies/viewmovie.php?id=<?php echo($row['id'])?>" style="text-shadow: #1c90d7 1px 0 10px; cursor: pointer; text-decoration: none;"><h4><?php echo($row['mv_name']);?></h4></a>
                </div>
            </div>
        </div>

        <?php 
                }
            }
        }
        ?>
        </div>
    </div>
</body>
</html>