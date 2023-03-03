
<?php
require_once('./Classes/user.php');
require_once('./config.php');
// form input
$name = cleaner::test_input($_POST['name']);
$address = cleaner::test_input($_POST['address']);
$zipcode = cleaner::test_input($_POST['zipcode']);
$city = cleaner::test_input($_POST['city']);
$phone = cleaner::test_input($_POST['phone']);
$email = cleaner::test_input($_POST['email']);
$currentDateTime = date('Y-m-d H:i:s');
// input into array
$userarray = array('name' => $name, 'address' => $address, 'zipcode' => $zipcode, 'city' => $city, 'phone' => $phone,  'email' => $email, 'currentDateTime' => $currentDateTime );

User::registeruserorder($userarray);
header('Location: ./checkout.php');
exit();
?>