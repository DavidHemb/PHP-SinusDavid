<?php
require_once('../Classes/user.php');
$inputusername = strtolower($_POST['username']);
$inputpassword = strtolower($_POST['password']);
if ($inputusername != null)
{
    $FoundUser = User::selectuser($inputusername);
    if ($FoundUser['username'] == $inputusername)
    {
        header("Location: registerpage.php?error=Username already taken!");
        exit();
    }
    else
    {
        User::registeruser($inputusername, $inputpassword);
    }
}