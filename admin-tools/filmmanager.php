<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Fanon - Films Manager</title>
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
        <h3 class='form_title'>Films Manager</h3>


        <?php 
            $getMovie = "SELECT * FROM movie";
            $run = mysqli_query($conn,$getMovie);
            if ($run) {
                while ($row = mysqli_fetch_assoc($run)) {
                ?>
        <div class="films-pnl">
            <div class="container">
                <div class="movie-card">
                    <p><?php echo($row['id']);?></p>
                    <div class="movie-poster">
                        <a href="../movies/viewmovie.php?id=<?php echo($row['id'])?>"><?php echo("<img style='border-radius: 10px; cursor: pointer;' width='175px' height='275px' src='../posters/".$row["img"]."'>");?></a>
                    </div>
                        <a href="../movies/viewmovie.php?id=<?php echo($row['id'])?>" style="text-shadow: #1c90d7 1px 0 10px; cursor: pointer; text-decoration: none;"><h4><?php echo($row['mv_name']);?></h4></a>
                    <nav>
                        <button class="btn-tool" onclick="location.href='addmovie.php'">New Movie</button>
                        <button class="btn-tool" onclick="location.href='deletemovie.php?movieid=<?php echo($row['id']);?>'" id='delete'>Delete</button>
                    </nav>
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