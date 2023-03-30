<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="
        дивитися фільми онлайн безкоштовно,
        фільми які варто подивитися,
        дивитися фільми безкоштовно,
        дивитися фільми,
        сайти для безкоштовного перегляду фільмів,
        дивитися фільми онлайн,
        де дивитися фільми безкоштовно,
        фільм безкоштовно,
        дивитися фільми онлайн безкоштовно в хорошій якості,
        дивитися фільми в хорошій якості,
        в хорошій якості у HD якості">
    <meta name="description" content="
    Fanon - це онлайн-сервіс для перегляду фільмів у HD якості. Дивіться фільми та серіали у всіх жанрах безкоштовно лише тут. Дивіться нові фільми та серіали онлайн безкоштовно в хорошій якості на Fanon.">
    <link rel="stylesheet" href="style.css">
    <title>Fanon - дивитися фільми онлайн безкоштовно в хорошій якості</title>
    <link rel="icon" href="images/logo.png">
</head>
<body>

    <?php 
    include 'db.php';
    session_start();
    if (isset($_SESSION['succesfulllog'])) {
        $log = "<a href='logout.php'>Вийти</a> / <a href='watchlatter/watchlist.php'>Переглянути пізніше</a>";
        if ($_SESSION['adminStatus']) {
            $log = "<a href='logout.php'>Вийти</a> / <a href='admin-tools/admpanel.php'>Панель адміністратора</a>";
        }
    }
    else {
        $log = "<a href='login.php'>Увійти</a> / <a href='register.php'>Реєстрація</a>";
    }

    if(isset($_SERVER['HTTPS'])&&$_SERVER['HTTPS']==='on') {
        $url = "https://";
    } else {
        $url = "http://";
    }

    $url.= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    $_SESSION['href'] = $url;
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

    <?php include 'slider.php'?>

    <div class="search-field" style="margin-bottom: 10px;">
        <form method="POST" action="search/byname/searchmovie.php">
            <input type="text" name="search" placeholder="Пошук фільму">
            <button type="submit" name="submit" class="btn-search">Пошук</button>
        </form>
    </div>

    <div class="sector">
        <div class="btn-genre">
            <form method="POST" action="search/bygenre/searchgenre.php" class="set-genre">
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

                $per_page_record = 8;

                if (isset($_GET["page"])) {
                    $page = $_GET["page"];
                } else {
                    $page=1;
                }

                $start_from = ($page-1) * $per_page_record;

                $query = "SELECT * FROM movie LIMIT $start_from, $per_page_record";

                $rs_result = mysqli_query($conn,$query);

                $getMovie = "SELECT * FROM movie";
                $run = mysqli_query($conn,$getMovie);
                if ($rs_result) {
                    while ($row = mysqli_fetch_array($rs_result)) {
                    ?>
            <div class="films-pnl">
                <div class="container">
                    <div class="movie-card-index">
                        <div class="movie-poster">
                            <a href="movies/viewmovie.php?id=<?php echo($row['id'])?>"><?php echo("<img alt='$row[mv_name]' style='border-radius: 10px; cursor: pointer;' width='175px' height='275px' src='./posters/".$row["img"]."'>");?></a>
                        </div>
                            <a href="movies/viewmovie.php?id=<?php echo($row['id'])?>" style="text-shadow: #1c90d7 1px 0 10px; cursor: pointer; text-decoration: none;"><h4><?php echo($row['mv_name']);?></h4></a>
                    </div>
                </div>
            </div>

            <?php 
                    }
                }
            ?>
        </div>

        <div class="pagination">
            <?php 
                $query = "SELECT COUNT(*) FROM movie";
                $rs_result = mysqli_query($conn, $query);
                $row = mysqli_fetch_row($rs_result);
                $total_records = $row[0];

                echo('</br>');

                $total_pages = ceil($total_records/$per_page_record);
                $pagLink = "";

                if($page>=2){
                    echo("<a href='index.php?page=".($page-1)."'>‹</a>");
                }

                for ($i=1;$i<=$total_pages;$i++){
                    if ($i == $page){
                        $pagLink .= "<a class = 'active' href='index.php?page=".$i."'>".$i."</a>";
                    } else {
                        $pagLink .= "<a href='index.php?page=".$i."'> ".$i." </a>";
                    }
                }; 

                echo($pagLink);

                if($page<$total_pages){
                    echo ("<a href='index.php?page=".($page+1)."'>›</a>");
                }
            ?>
        </div>

    </div>
    
    <div class="sector">
        <footer class="adm-pnl">
            <div class="in-footer">
                <div class="footer-text">
                    <h6>Контакти: </br>
                    fanon@gmail.com </br>
                    <a href="contact/contactus.php">або зв'яжіться з нами тут</a></h6>
                </div>
                <div class="footer-text">
                    <h6>Fanon - це онлайн-сервіс для перегляду фільмів у HD якості. Дивіться безкоштовно фільми онлайн.</br>
                    The project is educational in nature and was created not for making money, but for the acquired skills by the student during the academic semecter.</br>
                    Background image by ThankYouFantasyPictures from Pixabay.</h6>
                </div>
                <div class="footer-text">
                    <h6>© 2023 Fanon</h6>
                </div>
            </div>
        </footer>
    </div>

</body>
</html>