<?php
require_once('./config.php');
require_once('./classes/product.php');
require_once('./classes/category.php');
$product = product::ADMINselectProductById($_POST['product_id']);
?>
<img class="img" src="./<?= $product->get_imagepath(); ?>" alt=" <?= $product->get_title(); ?> "></img>