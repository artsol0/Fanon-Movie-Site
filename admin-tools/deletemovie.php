<?php 
session_start();
include '../db.php';
if (isset($_SESSION['succesfulllog'])) {
    if ($_SESSION['adminStatus'] == 0) {
        echo ("<script>alert('YВи не адмін!');window.location.href='../index.php';</script>");
    } else {
        $id = $_GET['movieid'];
        $delete = $conn->query("DELETE FROM movie WHERE id = '$id'");
        if($delete) {
            echo("<script>alert('Фільм успішно видалено.');window.location.href='filmmanager.php';</script>");
        } else {
            echo("<script>alert('Щось пішло не так.');window.location.href='filmmanager.php';</script>");
        }
    }
}
else {
    echo ("<script>alert('Ви не авторизовані!');window.location.href='../login.php';</script>");
}
?>