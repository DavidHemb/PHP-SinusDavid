<?php
require_once('./config.php');
require_once('./Classes/order.php');
require_once('./Classes/user.php');
require_once('./Classes/product.php');
require_once('./Classes/row.php');
require_once('./Component/purchase.php');
session_start();

//GET INFO
//5 == $orderid
$orderdetails = Order::ViewOrderDetails(3);
$order = $_SESSION["order"];

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
        <form action="index.php">
            <input class="button" style="display: inline-block; color: white;" type="submit" value="Back">
        </form>
        <?php
        for ($i = 0; $i < count($order); $i++) {
            $products = product::ADMINselectProductById($order[$i]->get_product_id());
            ?>
            <table>
                <th>Title</th>
                <th></th>
                <th>Color</th>
                <th>Price</th>
                <th>Quantity</th>
                <tr>
                    <td>
                        <?= $products->get_title(); ?>
                    </td>
                    <td><img src="../<?= $products->get_imagepath(); ?>" alt=" <?= $products->get_title(); ?> " border=0
                            height=50 width=50></img></td>
                    <td>
                        <?= $products->get_color(); ?>
                    </td>
                    <td>
                        <?= $order[$i]->get_price(); ?>
                    </td>
                    <td>
                        <?php echo $order[$i]->get_quantity(); ?>
                    </td>
            </table>
        <?php } ?>
    </div>
</body>

</html>