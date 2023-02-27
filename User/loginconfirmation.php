<?php
require_once('../Classes/user.php');
$inputusername = strtolower($_POST['username']);
$inputpassword = strtolower($_POST['password']);
$FoundAdmin = User::selectadmins($inputusername);
$FoundUser = User::selectuser($inputusername);
//Check for admin loggin
if ($FoundAdmin['username'] == $inputusername && $FoundAdmin['userpassword'] == $inputpassword)
{
        header("Location: ../Admin/indexADMIN.php");
        exit();
}
//Check for user loggin
else if ($FoundUser['username'] != $inputusername)
{
    /*
    header("Location: loginpage.php?error=Username already taken!");
    exit();
    */
}
