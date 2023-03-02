<?php
require_once('./config.php');
require_once('./classes/product.php');
require_once('./classes/category.php');
require_once('./classes/row.php');
session_start();

if (isset($_SESSION["rows"])) {
    $rows = $_SESSION["rows"];
}

//POST
$product_id = $_POST['product_id'];

//Get price
$product = product::ADMINselectProductById($product_id);
$price = $currencyFormatter->formatCurrency($product->get_price(), "SEK") ;
$quantity = 1;

//MAKE ARRAY WHIT VALUES
$arr = array("product_id"=>$product_id, "quantity"=>$quantity, "price"=>$price);

//MAKE OBJECT WHIT ARRAY

$rows[] = new Row($arr["product_id"], $arr["quantity"], $arr["price"]);
$_SESSION["rows"] = $rows;

//INFO FOR PAGE
$product = product::ADMINselectProductById($product_id);
//HTML FOR PAGE
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./CSS/shoppingcart.css">
        <title>SINUS Skateboards</title>
    </head>
    <body>
        <div class="menu">
            <h1>
                SINUS Skateboards
            </h1>
            <img class="img" src="./<?= $product->get_imagepath(); ?>" alt=" <?= $product->get_title(); ?> " border=0 height=400 width=400></img>
            <p style="margin-top: 50px; font-size: 40px;">
                Title: <?php echo $product->get_title();?><br><br>
            </p>
            <h1>Added to cart!</h1>
            <form style="margin-bottom: -60px;" action="index.php">
                <p></p>
                <input class="button" style="display: inline-block; background-color: black; color: white;" type="submit" value="Continue Shopping">
            </form>
            <form action="cart.php" method="POST">
                <input type="hidden" name="product_id" value="<?= $product->get_product_id(); ?>">
                <p></p>
                <input class="button" style="float: right; background-color: green; margin-top: -10px;" type="submit" value="To cart">
            </form>
        </div>
    </body>
</html>