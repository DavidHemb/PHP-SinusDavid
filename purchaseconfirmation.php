<?php
require_once('./config.php');
require_once('./classes/product.php');
require_once('./classes/order.php');
session_start();

//GET INFO
//5 == $orderid
$orderdetails = Order::ViewOrderDetails(3);
$product = product::ADMINselectProductById($_POST['product_id']);

//var_dump($orderdetails);

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
                Your order was successful
            </h2>
            <form style="margin-bottom: -60px;" action="index.php">
                <input type="hidden" name="product_id">
                    <p></p>
                    <input class="button" style="display: inline-block; color: white;" type="submit" value="Back">
                </form>
            <p>
                OrderID: <?php echo $orderdetails['order_id']();?><br><br>
                <img class="img" src="./<?= $product->get_imagepath(); ?>" alt=" <?= $product->get_title(); ?> " border=0 height=400 width=400></img>
                Title: <?php echo $orderdetails['title']();?><br><br>
                Price: <?php echo $currencyFormatter->formatCurrency($orderdetails['price'](), "SEK") ;?>
            </p>
        </div>
    </body>
</html>