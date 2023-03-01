<?php
require_once('../config.php');
require_once('../classes/user.php');
session_start();
$user = user::selectuser($_SESSION["user"]);
var_dump($user);
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
            <h1>SINUS PROFILE</h1>
            <img class="img" src="../Assets/img/pictures/gigachad.jpg" height=600 width=1080></img>
            <form action="">
                
            </form>
            <p>Username: <?php $user["username"] ?></p>
            <p>Password: <?php $user["password"] ?></p>
            <p>Name: <?php $user["password"] ?></p>
            <p>Password: <?php $user["password"] ?></p>
            <p>Password: <?php $user["password"] ?></p>
            <p>Password: <?php $user["password"] ?></p>
            <p>Password: <?php $user["password"] ?></p>
                <?php
                    for($i = 0; $i < count($user); $i++){?>
                    <p><?php $user[$i] ?></p>
                <?php } ?>
            <form style="margin-bottom: -60px;" action="index.php">
            <input type="hidden" name="product_id" value="<?= $product->get_product_id(); ?>">
                <p></p>
                <input class="button" style="display: inline-block; background-color: black; color: white;" type="submit" value="Back">
            </form>
            <form action="shoppingcart.php" method="POST">
            <input type="hidden" name="product_id" value="<?= $product->get_product_id(); ?>">
                <p></p>
                <input class="button" style="float: right; background-color: green; margin-top: -30px;" type="submit" value="Buy now">
            </form>
        </div>
    </body>
</html>