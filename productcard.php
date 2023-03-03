<?php
require_once('./config.php');
require_once('./classes/product.php');
$product = product::ADMINselectProductById($_POST['product_id']);
session_start();
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
            <img class="img" src="./<?= $product->get_imagepath(); ?>" alt=" <?= $product->get_title(); ?> " border=0 height=400 width=400></img>
            <p style="margin-top: 50px; font-size: 40px;">
                Title: <?php echo $product->get_title();?><br><br>
            </p>
            <p style="margin-top: -70px;">
                Color: <?php echo $product->get_color(); ?><br><br>
                Description: <?php echo $product->get_product_description(); ?><br><br>
                Stock: <?php echo $product->get_stock(); ?><br><br>
                Category: <?php echo $product->get_category_title();?><br><br>
                Price: <?php echo $currencyFormatter->formatCurrency($product->get_price(), "SEK") ;?>
            </p>
                <tr>
                    <td>ProductID: <?php echo $product->get_product_id();?></td>
                    <td> Release Date: <?php echo $product->get_date_created();?></td>
                    <?php $updateddate = $product->get_date_updated();
                    if($updateddate =! null)
                    {?>
                    <td> Product updated: <?php echo $product->get_date_updated();?></td>
                    <?php } ?>
                </tr>
                <form style="margin-bottom: -60px;" action="index.php">
                <input type="hidden" name="product_id" value="<?= $product->get_product_id(); ?>">
                    <p></p>
                    <input class="button" style="display: inline-block; color: white;" type="submit" value="Back">
                </form>
                <form action="shoppingcart.php" method="POST">
                <?php if ($product->get_stock() > 0) { ?>
                        <form action="shoppingcart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?= $product->get_product_id(); ?>">
                            <p></p>
                            <input class="button" style="float: right;" type="submit" value="Buy now">
                        </form>
                    <?php } else { ?>
                        <p class="button" style="float: right; cursor: default;">Out of stock!</p>
                    <?php } ?>
        </div>
    </body>
</html>