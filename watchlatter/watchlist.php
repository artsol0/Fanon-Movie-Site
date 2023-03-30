<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Fanon - Watch Latter</title>
</head>
<body>
    <?php 
        session_start();
        if (isset($_SESSION['succesfulllog'])) {
            $log = "<a href='../logout.php'>Вийти</a> / <a href='watchlist.php'>Переглянути пізніше</a>";
        }
        else {
            echo ("<script>alert('Ви не авторизовані!');window.location.href='../index.php';</script>");
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
            <div class="list-name" style="background-color: black; padding-top: 5px; padding-bottom: 5px">
                <i style="text-align:right;">Список фільмів зроблений <?php echo($_SESSION['uname'])?></i>
            </div>
            <?php 
                $id_user = $_SESSION['uid'];
                $getMovie = "SELECT * FROM watchlater WHERE id_user = '$id_user'";
                $run = mysqli_query($conn,$getMovie);
                if ($run) {
                    while ($row = mysqli_fetch_assoc($run)) {
                    ?>
            <div class="films-pnl">
                <div class="container">
                    <div class="movie-card-index" style="padding-bottom: 10px;">
                        <div class="movie-poster">
                            <a href="../movies/viewmovie.php?id=<?php echo($row['id_movie'])?>"><?php echo("<img style='border-radius: 10px; cursor: pointer;' width='175px' height='275px' src='../posters/".$row["img"]."'>");?></a>
                        </div>
                            <a href="../movies/viewmovie.php?id=<?php echo($row['id_movie'])?>" style="text-shadow: #1c90d7 1px 0 10px; cursor: pointer; text-decoration: none;"><h4><?php echo($row['mv_name']);?></h4></a>
                            <button class="btn-tool" onclick="location.href='removemovie.php?movieid=<?php echo($row['id_movie']);?>'">Прибрати</button>
                    </div>
                </div>
            </div>

            <?php 
                    }
                }
            ?>
        </div>
    </div>
</body>
</html>