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
        <link rel="stylesheet" href="../CSS/profilepage.css">
        <title>SINUS SKATEOARDS</title>
    </head>
    <body>
        <h1>Welcome <?=$_SESSION['user'];?>!</h1>
    </body>
</html>