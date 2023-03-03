<?php
require_once('./config.php');
require_once('./Classes/order.php');
require_once('./Classes/user.php');
require_once('./Classes/product.php');
require_once('./Classes/row.php');
require_once('./Component/purchase.php');
session_start();
//Empty Cart
unset($_SESSION['order']);
unset($_SESSION['rows']);


//Get info on order
$orderdetails = Order::ViewOrderDetails($_SESSION['newOrderID']);



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/productcard.css">
    <title>SINUS Skateboards</title>
</head>

<body>

    <div class="menu">
        <h1>
            SINUS Skateboards
        </h1>
        <h2>
            Your order was successful! Your orderid: <?= $orderdetails[0]['order_id'] ?>
        </h2>
        <form action="index.php">
            <input class="button" style="display: inline-block; color: white;" type="submit" value="Back">
        </form>
       
    </div>
</body>

</html>