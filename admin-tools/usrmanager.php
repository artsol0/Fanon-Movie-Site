<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Fanon - Users Manager</title>
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
    <div class="usr-pnl">
        <h1 class='form_title'>Панель адміністратора</h1>
        <h3 class='form_title'>Users Manager</h3>
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>

            <?php 
            $grepUsers = "SELECT * FROM user";
            $run = mysqli_query($conn,$grepUsers);
            if($run) {
                while($row = mysqli_fetch_assoc($run)) {
            
            ?>

            <tbody>
                <tr>
                    <th><?php echo($row['id']);?></th>
                    <th><?php echo($row['uname']);?></th>
                    <th><?php echo($row['email']);?></th>
                    <th><button class="btn-tool" id='delete' onclick="location.href='deleteusr.php?unameid=<?php echo($row['id']);?>'">Delete</button> / <button class="btn-tool" onclick="location.href='../register.php'">New User</button></th>
                </tr>
                <?php 
                }
            }
                ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>