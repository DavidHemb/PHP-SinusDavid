<?php
require_once('./checkout.php');
session_start();
$inputusername = strtolower($_POST['username']);
$inputpassword = strtolower($_POST['password']);
$FoundUser = User::selectuser($inputusername);
var_dump($FoundUser);

if($FoundUser['username'] != $_SESSION['username'] && $FoundUser['userpassword'] != $_SESSION['password']) {
        // OM INLOGGAD
        if ($FoundUser['username'] != $inputusername || $FoundUser[$key]['userpassword'] != $inputpassword) {
            // om ej funnen användare hittad skicka till
            header("Location: loginpage.php?error=Wrong username or password");
            exit();
        } else {
            // användare hittad, sätt användare i sessionen och skicka till checkout
            $_SESSION["user"] = $FoundUser[$key]['username'];
            header("Location: ./checkout.php");
            exit();
        }
    }


