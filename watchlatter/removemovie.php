<?php 
session_start();
include '../db.php';
if (isset($_SESSION['succesfulllog'])) {
    $id_movie = $_GET['movieid'];
    $id_user = $_SESSION['uid'];
    $remove = $conn->query("DELETE FROM watchlater WHERE id_movie = '$id_movie' AND id_user = '$id_user'");
    if($remove) {
        echo("<script>window.location.href='watchlist.php';</script>");
    } else {
        echo("<script>alert('Щось пішло не так.');window.location.href='watchlist.php';</script>");
    }
} else {
    echo ("<script>alert('Ви не авторизовані!');window.location.href='login.php';</script>");
}
?>