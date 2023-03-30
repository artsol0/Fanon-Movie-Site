<?php 
session_start();
include '../db.php';
if (isset($_SESSION['succesfulllog'])) {
    if ($_SESSION['adminStatus'] == 0) {
        echo ("<script>alert('Ви не адмін!');window.location.href='../index.php';</script>");
    } else {
        $id = $_GET['messageid'];
        $delete = $conn->query("DELETE FROM messages WHERE id = '$id'");
        if($delete) {
            echo("<script>alert('Повідомлення успішно видалено.');window.location.href='viewmessages.php';</script>");
        } else {
            echo("<script>alert('Щось пішло не так.');window.location.href='viewmessages.php';</script>");
        }
    }
}
else {
    echo ("<script>alert('Ви не авторизовані!');window.location.href='../login.php';</script>");
}
?>