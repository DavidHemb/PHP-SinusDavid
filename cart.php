<?php
require_once('./config.php');
require_once('./classes/product.php');
require_once('./classes/category.php');
require_once('./classes/row.php');
session_start();
$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);


if (!empty($action)) {
    switch ($action) {
        case 'Remove':
            //UNSET
            $order = $_SESSION["rows"];
            $action = "";
            unset($order[$_POST['index']]);

            //REINDEX
            $order = array_values($order);
            $_SESSION["rows"] = $order;
            break;
        case 'Update':
            $quantity = $_POST['quantity'];

            $order = $_SESSION["rows"];

            //CHECK QUANTITY
            $quantityerror = 0;
            for ($i = 0; $i < count($order); $i++) {
                $products = product::ADMINselectProductById($order[$i]->get_product_id());

                //COMPARE
                if ($products->get_stock() < $quantity) {
                    $quantityerror = 1;
                }
            }
            //IF NO ERRORS
            if ($quantityerror == 0) {
                $order[$_POST['index']]->set_quantity($quantity);
                $_SESSION["rows"] = $order;
                var_dump($_SESSION["rows"]);
                break;
                //IF ERRORS
            } else { ?>
                <div class="quantityerrorclass">
                    <p class="quantityerror">Quantity cannot exceede stock!</p>
                </div>
                <?php break;
            }
        case 'Checkout':
            //MAKE SESSON ORDER
            $order = $_SESSION["rows"];
            $_SESSION["order"] = $order;
            header("Location: ./checkout.php");
            exit();
    }
}

if (empty($_SESSION["rows"])) { ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./CSS/cart.css">
        <title>SINUS Skateboards</title>
    </head>

    <body>
        <div class="header">
            <h2 class="backbutton"><a href="./index.php" class="text">Back</a></h2>
            <div style="margin: auto;">
                <h1 class="headertitle">CART</h1>
            </div>
            <h2><a href="./checkout.php"></a></h2>
        </div>
        <div class="cart">
            <form action="" method="POST">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Color</th>
                            <th scope="col">Description</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                </table>
            </form>
        </div>
        <div class="cart">
            <p class="nothingincart">There is nothing in you cart</p>
        </div>
    </body>

    </html>
<?php } else {

    $order = $_SESSION["rows"];
    //HTML FOR PAGE
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./CSS/cart.css">
        <title>SINUS Skateboards</title>
    </head>

    <body>
        <div class="header">
            <h2 class="backbutton"><a href="./index.php" class="text">Back</a></h2>
            <div style="margin: auto;">
                <h1 class="headertitle">CART</h1>
            </div>
            <h2><a href="./checkout.php"></a></h2>
        </div>
        <div class="cart">
            <form action="" method="POST">
                <table>
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Color</th>
                            <th scope="col">Description</th>
                            <th scope="col">Stock</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                        </tr>
                    </thead>
                    <tr>
                        <td>
                            <?php for ($i = 0; $i < count($order); $i++) {
                                $products = product::ADMINselectProductById($order[$i]->get_product_id());
                                ?>
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
                                <?= $products->get_product_description(); ?>
                            </td>
                            <td>
                                <?= $products->get_stock(); ?>
                            </td>
                            <td>
                                <?= $order[$i]->get_price(); ?>
                            </td>
                            <td>
                                <form method="POST">
                                    <input type="int" id="quantity" name="quantity" value="" placeholder="<?php echo $order[$i]->get_quantity(); ?>">
                                    <input type="hidden" id="index" name="index" value="<?php echo ($i) ?>">
                                    <input type="submit" name="action" value="Update">
                                </form>
                            </td>
                            <td>
                                <form method="POST">
                                    <input type="hidden" id="index" name="index" value="<?php echo ($i) ?>">
                                    <input type="submit" name="action" value="Remove">
                                </form>
                            </td>
                        <?php } ?>
                        <?php if (!empty($_SESSION["rows"])) { ?>
                            <input type="submit" style="font-size: 40px;" name="action" value="Checkout">
                        <?php } ?>
                </table>
            </form>
        </div>
    </body>

    </html>
<?php } ?>