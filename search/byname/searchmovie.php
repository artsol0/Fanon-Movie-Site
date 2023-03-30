<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="
    search movies,
    watch movies free">
    <meta name="description" content="
    Search and watch movies online free in HD quality.">
    <link rel="stylesheet" href="../../style.css">
    <title>Fanon - Шукайте та дивіться фільми онлайн безкоштовно в хорошій якості</title>
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
        <form method="POST" action="searchmovie.php">
            <input type="text" name="search" placeholder="Пошук фільму">
            <button type="submit" name="submit" class="btn-search">Пошук</button>
        </form>
    </div>
    <div class="sector">
        <form style="text-align: center; margin-bottom: 10px" method="POST" action="../../index.php">
            <button type="submit" name="submit" class="btn">Назад</button>
        </form>

        <div class="adm-pnl">

        <?php 
        if (isset($_POST['submit'])) {
            $search = addslashes($_POST['search']);
            $searchpreg = preg_replace("#[^0-9a-z]#i","",$search);
            $quaery = "SELECT * FROM movie WHERE (mv_name LIKE '%$search%') OR (mv_director LIKE '%$search%')";

            $run = mysqli_query($conn,$quaery);
            $count = mysqli_num_rows($run);
            if ($count == 0) {
                echo("<div style='padding: 3px; background-color: #ffff00'><b style='color:#ff0000;'>Таких фільмів як \"$search\" не знайдено</b></div>");
            } else {
                while ($row = mysqli_fetch_assoc($run)) {
        ?>

        <div class="films-pnl">
            <div class="container">
                <div class="movie-card-index">
                    <div class="movie-poster">
                        <a href="../../movies/viewmovie.php?id=<?php echo($row['id'])?>"><?php echo("<img style='border-radius: 10px; cursor: pointer;' width='175px' height='275px' src='../../posters/".$row["img"]."'>");?></a>
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