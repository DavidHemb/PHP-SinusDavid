<?php
require_once('../Classes/user.php');
$inputusername = strtoupper($_POST['username']);
$inputpassword = strtoupper($_POST['password']);
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