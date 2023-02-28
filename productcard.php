<?php
require_once('./config.php');
require_once('./classes/product.php');
$products = Product::ADMINviewProducts();
$i = $_POST['INDEX'];
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
            <img class="img" src="./<?= $products[$i]->get_imagepath(); ?>" alt=" <?= $products[$i]->get_title(); ?> " border=0 height=400 width=400></img>
            <p style="margin-top: 50px; font-size: 40px;">
                Title: <?php echo $products[$i]->get_title();?><br><br>
            </p>
            <p style="margin-top: -70px;">
                Color: <?php echo $products[$i]->get_color();?><br><br>
                Description: <?php echo $products[$i]->get_product_description();?><br><br>
                Stock: <?php echo $products[$i]->get_stock();?><br><br>
                Category: <?php echo $products[$i]->get_category_title();?><br><br>
                Price: <?php echo $currencyFormatter->formatCurrency($products[$i]->get_price(), "SEK") ;?>
            </p>
                <tr>
                    <td>ProductID: <?php echo $products[$i]->get_product_id();?></td>
                    <td> Release Date: <?php echo $products[$i]->get_date_created();?></td>
                    <?php $updateddate = $products[$i]->get_date_updated();
                    if($updateddate =! null)
                    {?>
                    <td> Product updated: <?php echo $products[$i]->get_date_updated();?></td>
                    <?php } ?>
                </tr>
                <form style="margin-bottom: -60px;" action="index.php">
                    <input style="visibility:hidden" type="text" name ="INDEX" value="<?php echo $i ?>">
                    <p></p>
                    <input class="button" style="display: inline-block; background-color: black; color: white;" type="submit" value="Back">
                </form>
                <form action="shoppingcart.php" method="POST">
                <input style="visibility:hidden" type="text" name ="INDEX" value="<?php echo $i ?>">
                    <p></p>
                    <input class="button" style="float: right; background-color: green; margin-top: -30px;" type="submit" value="Buy now">
                </form>
        </div>
    </body>
</html>