<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/profilepages.CSS">
        <title>SINUS PROFILE</title>
    </head>
    <body>
    <audio autoplay>
        <source src="../Assets/songs/GIGACHAD.mp3" type="audio/mpeg">
    </audio>
    <div class="header">
        <h1 class="headertitle">Welcome GIGACHAD: <?=$_SESSION['user'];?>!</h1>
    </div>
    <div class="menu">
        <a href="./logoutpage.php" class="buttontext">Logout</a>
    </div>
    <div class="logout">
        <a href="../index.php" class="buttontext">To website</a>
    </div>
    <div class="orderhistory">
        <a href="" class="buttontext">Orderhistory</a>
    </div>
    <div class="user">
        <a href="./viewuser.php" class="buttontext">User</a>
    </div>
    <div class="footer">
        <h2 class="footerleft">For all gigachads</h2>
        <h2 class="footertitle">Made by real Gs for real Gs</h2>
        <h2 class="footerright">"Insperational quote"</h2>
    </div>
    </body>
</html>