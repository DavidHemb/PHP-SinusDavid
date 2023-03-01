<?php
require_once('../config.php');
require_once('../classes/user.php');
session_start();
$duplicateusername = user::selectuser($_POST["username"]);

if(!empty($duplicateusername))
{
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $zipcode = $_POST["zipcode"];
    $city = $_POST["city"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $userarray = array("username"=>$username, "userpassword"=>$password, "name"=>$name, "address"=>$address, "zipcode"=>$zipcode, "city"=>$city, "phone"=>$phone, "email"=>$email);
    user::updateuserorder($userarray);
}
else
{
    header("Location: ./viewuser.php");
    exit();
}