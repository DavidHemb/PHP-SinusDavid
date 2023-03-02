<?php
require_once('../config.php');
require_once('../classes/user.php');
session_start();

$username = Cleaner::test_input($_POST["username"]);
$password = Cleaner::test_input($_POST["password"]);
$name = Cleaner::test_input($_POST["name"]);
$address = Cleaner::test_input($_POST["address"]);
$zipcode = Cleaner::test_input($_POST["zipcode"]);
$city = Cleaner::test_input($_POST["city"]);
$phone = Cleaner::test_input($_POST["phone"]);
$email = Cleaner::test_input($_POST["email"]);
$id = Cleaner::test_input($_POST["user_id"]);

$duplicateusername = user::selectuser($username);

$userarray = array("username" => $username, "userpassword" => $password, "name" => $name, "address" => $address, "zipcode" => $zipcode, "city" => $city, "phone" => $phone, "email" => $email, "user_id" => $id);

if ($username == ($_SESSION["user"])) {
    user::updateuserorder($userarray);
} else if (empty($duplicateusername)) {
    user::updateuserorder($userarray);
} else {
    header("Location: ./profilepage.php");
    exit();
}
header("Location: ./profilepage.php");
exit();