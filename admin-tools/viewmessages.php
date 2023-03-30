<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <title>Fanon - Messages</title>
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
        <h3 class='form_title'>View Messages</h3>


        <?php 
            $getMessages = "SELECT * FROM messages";
            $run = mysqli_query($conn,$getMessages);
            if ($run) {
                while ($row = mysqli_fetch_assoc($run)) {
                ?>

        <div class="messages-pnl">
            <div class="user-info">
                <div class="info">
                    User id: <?php echo($row['id_user'])?> </br>
                    Username: <?php echo($row['uname'])?> </br>
                    Email: <?php echo($row['email'])?> </br>
                </div>
            </div>
            <div class="messages">
                <div class="message-title"><?php echo($row['title'])?></div>
                <div class="message-text"><?php echo($row['message_text'])?></div>
            </div>
        </div>
        <nav class="nav-mes">
            <button class="btn-tool" onclick="location.href='deletemessage.php?messageid=<?php echo($row['id']);?>'" id='delete'>Delete</button>
        </nav>

        <?php 
                }
            }
        ?>
    </div>
</div>

</body>
</html>