<?php
require_once('../Classes/user.php');
require_once('../config.php');
$inputusername = strtolower($_POST['username']);
$inputpassword = strtolower($_POST['password']);
$date = date('Y/m/d H:i');
if (!empty($inputusername))
{
    $FoundUser = User::selectuser($inputusername);
    if (empty($inputpassword))
    {
        header("Location: registerpage.php?error=Password cannot be empty!");
        exit();
    }
    else if ($FoundUser['username'] == $inputusername)
    {
        header("Location: registerpage.php?error=Username already taken!");
        exit();
    }
    else
    {
        User::registeruser($inputusername, $inputpassword, $date);
        session_start();
        $_SESSION["user"] = $inputusername;
        header("Location: ../index.php");
        exit();
    }
}
else
{
    header("Location: registerpage.php?error=Username cannot be empty!");
    exit();
}