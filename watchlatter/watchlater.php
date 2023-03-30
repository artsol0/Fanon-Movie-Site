<?php 
session_start();
include '../db.php';

if (isset($_SESSION['succesfulllog'])) {
    if (isset($_REQUEST['submit'])) { 
        $id_movie = $_SESSION['movie_id'];
        $id_user = $_SESSION['uid'];
        $mv_name = $_SESSION['mv_name'];
        $img = $_SESSION['img'];

        $check = "SELECT * FROM watchlater WHERE id_movie = '$id_movie' AND id_user = '$id_user'";
        if (mysqli_num_rows($conn->query($check))>0) {
            echo("<script>alert('Фільм уже у вашому списку «Переглянути пізніше».');window.location.href='watchlist.php';</script>");
        } else {
            $addtolist = $conn->query("INSERT INTO watchlater(id_movie,id_user,mv_name,img) VALUES('$id_movie','$id_user','$mv_name','$img')");
            if ($addtolist) {
                echo("<script>alert('Фільм додано до списку «Переглянути пізніше».');window.location.href='../index.php';</script>");
            } else {
                echo("<script>alert('Щось пішло не так.');window.location.href='../index.php';</script>");
            }   
        }
    }
}
else {
    echo ("<script>alert('Ви не авторизовані!');window.location.href='../login.php';</script>");
}
?>