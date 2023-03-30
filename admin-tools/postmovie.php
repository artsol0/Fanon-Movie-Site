<?php 
session_start();
include '../db.php';
if (isset($_SESSION['succesfulllog'])) {
    if ($_SESSION['adminStatus'] == 0) {
        echo ("<script>alert('Ви не адмін!');window.location.href='../index.php';</script>");
    }
}
else {
    echo ("<script>alert('Ви не ввійшли в систему!');window.location.href='../index.php';</script>");
}

if (isset($_POST['submit'])) {
    $mv_name = addslashes($_POST['mv_name']);
    $mv_category = $_POST['mv_category'];
    $mv_genre = $_POST['mv_genre'];
    $mv_date = date('Y-m-d',strtotime($_POST['mv_date']));
    $mv_director = addslashes($_POST['mv_director']);
    $mv_rate = strval($_POST['mv_rate']);
    $mv_duraction = strval($_POST['mv_duraction']);
    $mv_description = addslashes($_POST['mv_description']);

    $filename = addslashes($_FILES['img']['name']);
    $vfilename = addslashes($_FILES['video']['name']);

    $addingmovie = "INSERT INTO movie(mv_name,mv_category,mv_genre,mv_date,mv_director,mv_rate,mv_duraction,mv_description,img,video) VALUES('$mv_name','$mv_category','$mv_genre','$mv_date','$mv_director','$mv_rate','$mv_duraction','$mv_description','$filename','$vfilename')";

    $image_dir = "../posters/" . $filename;
    $video_dir = "../videos/" . $vfilename;

    $FileType = strtolower(pathinfo($image_dir,PATHINFO_EXTENSION));
    if ($FileType != "jpg" && $FileType != "png" && $FileType != "jpeg") {
        echo ("<script>alert('Для завантаження плакатів допускаються лише файли JPG, JPEG і PNG.');window.location.href='addmovie.php';</script>");
    } else {
        $FileType = strtolower(pathinfo($video_dir,PATHINFO_EXTENSION));
        if ($FileType != "mp4") {
            echo ("<script>alert('Для завантаження відео дозволено лише файли MP4.');window.location.href='addmovie.php';</script>");
        } else {
            if (!mysqli_query($conn,$addingmovie)) {
                echo ("<script>alert('Щось пішло не так.');window.location.href='addmovie.php';</script>");
            } else {
                if (!move_uploaded_file(addslashes($_FILES["img"]["tmp_name"]), $image_dir) || !move_uploaded_file(addslashes($_FILES["video"]["tmp_name"]), $video_dir)) {
                    echo ("<script>alert('Помилка завантаження файлів.');window.location.href='addmovie.php';</script>");
                } else {
                    echo ("<script>alert('Фільм успішно додано.');window.location.href='addmovie.php';</script>");
                }
            }
        }
    }
}
?>