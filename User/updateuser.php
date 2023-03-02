<?php
require_once('../config.php');
require_once('../classes/user.php');
session_start();
$duplicateusername = user::selectuser($_POST["username"]);
$username = $_POST["username"];

if($username == ($_SESSION["user"]))
{
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $zipcode = $_POST["zipcode"];
    $city = $_POST["city"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $id = $_POST["user_id"];
    
    $userarray = array("username"=>$username, "userpassword"=>$password, "name"=>$name, "address"=>$address, "zipcode"=>$zipcode, "city"=>$city, "phone"=>$phone, "email"=>$email, "user_id"=>$id);
    user::updateuserorder($userarray);
}
else if(!empty($duplicateusername))
{
    header("Location: ./profilepage.php");
    exit();
}
else if(empty($duplicateusername))
{
    $username = $_POST["username"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $address = $_POST["address"];
    $zipcode = $_POST["zipcode"];
    $city = $_POST["city"];
    $phone = $_POST["phone"];
    $email = $_POST["email"];
    $id = $_POST["user_id"];
    
    $userarray = array("username"=>$username, "userpassword"=>$password, "name"=>$name, "address"=>$address, "zipcode"=>$zipcode, "city"=>$city, "phone"=>$phone, "email"=>$email, "user_id"=>$id);
    user::updateuserorder($userarray);
}
else
{
    header("Location: ./profilepage.php");
    exit();
}
header("Location: ./profilepage.php");
exit();