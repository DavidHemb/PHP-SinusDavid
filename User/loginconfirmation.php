<?php
require_once('../Classes/user.php');
require_once('../config.php');
session_start();
$inputusername1 = strtolower($_POST['username']);
$inputpassword1= strtolower($_POST['password']);
$inputusername = Cleaner::test_input($inputusername1);
$inputpassword = Cleaner::test_input($inputpassword1);
$FoundAdmin = User::selectadmins($inputusername);
$FoundUser = User::selectuser($inputusername);
//Check for admin loggin
if ($FoundAdmin['username'] == $inputusername && $FoundAdmin['userpassword'] == $inputpassword)
{       
    $_SESSION["admin"] = $FoundAdmin['username'];
    header("Location: ../Admin/indexADMIN.php");
    exit();
}
//Check for user loggin
else if ($FoundUser['username'] != $inputusername || $FoundUser['userpassword'] != $inputpassword)
{
    header("Location: loginpage.php?error= Wrong username or password");
    exit();
}
else  
{
    $_SESSION["user"] = $FoundUser['username'];
    header("Location: ../index.php");
    exit();
}
