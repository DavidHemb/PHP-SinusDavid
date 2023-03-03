<?php
require_once('./config.php');
require_once('./classes/product.php');
require_once('./classes/category.php');
$filteraction = filter_input(INPUT_POST, 'filteraction', FILTER_UNSAFE_RAW);
$Usefilter = filter_input(INPUT_POST, 'usefilter', FILTER_UNSAFE_RAW);
$searchaction = filter_input(INPUT_POST, 'searchaction', FILTER_UNSAFE_RAW);
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/main.css">
    <link rel="stylesheet" href="./CSS/header.css">
    <title>SINUS SKATEOARDS</title>
</head>
<header>
    <div class="logo" ;>
    </div>
    <div class="loginbutton" ;>
        <h2 class="usertext">User</h2>
        <?php if (isset($_SESSION["user"])) {
            echo '<a href="./user/profilepage.php" style="text-decoration: none;">';
        } else {
            echo '<a href="./User/loginpage.php" style="text-decoration: none;">';
        } ?>
        <p class="logintext">
            <?php if (!isset($_SESSION["user"])) {
                echo "Login";
            } else if (isset($_SESSION["user"])) {
                echo $_SESSION['user'];
            } ?>
        </p></a>
        <?php if (isset($_SESSION["user"])) { ?> <br> <a href="./User/logoutpage.php"
                style="text-decoration: none; color: white;">
                <p class="logouttext">Logout</p>
            </a>
        <?php } ?>
    </div>
    <div class="search-container">
        <p class="searchtext">Search bar</p>
        <form method="post">
            <input type="hidden" name="searchaction" value="search">
            <input type="text" class="searchbar" name="search">
            <input type="submit" style="font-size: 25px;" name="submit" value="Search" ;>
        </form>
    </div>
    <div class="cart">
        <a href="cart.php" style="text-decoration: none; font-size: 60px;">
            <p class="carttext">Cart</p>
        </a>
    </div>
    <br>
</header>

<body>
    <?php
    $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
    if ($conn instanceof mysqli) { ?>
        <p class="MYSQL">
            <?php echo "Client info: " . $conn->client_info . "\n" . "Client Version: " . $conn->client_version; ?>
        </p>
    <?php }
    $conn->close();
    $categories = Category::ViewCategory(); ?>
    <h1></h1>
    <form method="POST" class="filter">
        <input type="submit" class="submitfilter" id="Clear" name="filteraction" value="Clear";>
        <select class="selectoptionsbar" name="category_title" id="category_title">
            <?php for ($i = 0; $i < count($categories); $i++) { ?>
                <option class="filtertext" value="<?= $categories[$i]->get_title() ?>"><?= $categories[$i]->get_title(); ?>
                </option>
            <?php } ?>
        </select>
        <input class="submitfilter" type="submit" name="filteraction" value="Filter">
    </form>
    <?php
    //SEARCH
    if (!empty($searchaction)) {
        switch ($searchaction) {
            case 'search':
                $products = product::SearchBarMetod();
                break;
        }
    }
    //FILTER
    else if (!empty($filteraction)) {
        switch ($filteraction) {
            case 'Filter':
                $products = product::filterproducts($_POST['category_title']);
                break;
            case 'Clear':
                $products = Product::ADMINviewProducts();
                break;
        }
    }
    //ELSE ALL
    else {
        $products = Product::ADMINviewProducts();
    }
    for ($i = 0; $i < count($products); $i++) {
        if ($products[$i]->get_is_published() == 1) { ?>
            <div class="productcard">
                <div>
                    <td><img style="display: block; margin-right: auto; margin-left: auto;"
                            src="./<?= $products[$i]->get_imagepath(); ?>" alt=" <?= $products[$i]->get_title(); ?> " border=0
                            height=600 width=600></img></td>
                    <p class="title">
                        <?= $products[$i]->get_title(); ?>
                    </p>
                    <p></p>
                    <td>Stock:</td>
                    <td>
                        <?= $products[$i]->get_stock(); ?>
                    </td>
                    <p></p>
                    <td>Price:</td>
                    <td>
                        <?= $currencyFormatter->formatCurrency($products[$i]->get_price(), "SEK"); ?>
                    </td>
                    <p style="margin-bottom: -50px;"></p>
                    <form action="productcard.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= $products[$i]->get_product_id(); ?>">
                        <p></p>
                        <input class="button" style="margin-top: 40px;" type="submit" value="More info">
                    </form>
                    <?php if ($products[$i]->get_stock() > 0) { ?>
                        <form action="shoppingcart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?= $products[$i]->get_product_id(); ?>">
                            <p></p>
                            <input class="button" style="float: right;" type="submit" value="Buy now">
                        </form>
                    <?php } else { ?>
                        <p class="button" style="float: right; cursor: default;">Out of stock!</p>
                    <?php } ?>
                    <form action="picturetab.php" method="POST" target="_blank">
                        <input type="hidden" name="product_id" value="<?= $products[$i]->get_product_id(); ?>">
                        <p></p>
                        <input class="button" type="submit" value="View picture in new tab">
                    </form>
                </div>
            </div>
        <?php }
    } ?>
</body>

</html>