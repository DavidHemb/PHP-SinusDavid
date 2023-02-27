<?php
require_once('./config.php');
require_once('./classes/product.php');
$products = Product::ADMINviewProducts();
$conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
if ($conn instanceof mysqli){?>
    <p class="MYSQL"><?php echo "Client info: " .$conn->client_info . "\n" . "Client Version: " . $conn->client_version; ?></p>
    <?php } $conn->close();?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./CSS/main.css">
        <title>Park</title>
    </head>
    <body>
        <h1 class="SINUS">SINUS Skateboards</h1>
        <h2 style="color: white; text-align: right;">(filter)</h2>
    <?php 
    for ($i = 0; $i < count($products); $i++) 
    {  
    if($products[$i]->get_is_published() == 1)
    { ?>
        <div class="productcard">
            <tr>
                <td><img src="./<?= $products[$i]->get_imagepath(); ?>" alt=" <?= $products[$i]->get_title(); ?> " border=0 height=600 width=600></img></td>
                <p class="title"><?= $products[$i]->get_title(); ?></p>
                <p></p>
                <td>Stock:</td>
                <td><?= $products[$i]->get_stock(); ?></td>
                <p></p>
                <td>Price:</td>
                <td><?= $currencyFormatter->formatCurrency($products[$i]->get_price(), "SEK") ; ?></td>
                <p style="margin-bottum: -50px;"></p>
                <form action="productcard.php" method="POST">
                    <input style="visibility:hidden" type="text" name ="INDEX" value="<?php echo $i ?>">
                    <p></p>
                    <input class="button" style="background-color: brown; margin-top: 40px;" type="submit" value="More info">
                </form>
                <form action="shoppingcart.php" method="POST">
                <input style="visibility:hidden" type="text" name ="INDEX" value="<?php echo $i ?>">
                    <p></p>
                    <input class="button" style="float: right; background-color: green; margin-top: -125;" type="submit" value="Buy now">
                </form>
            </tr>
        </div>  
    <?php }  }  ?>
    </body>
</html>