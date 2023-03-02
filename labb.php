<?php 
require_once('./Classes/order.php');
require_once('./Classes/row.php');
require_once('./config.php');
$row1 = new Row(9,3,123);
$row2 = new Row(11,1,12);


$rows = array($row1,$row2);
var_dump($rows);

 $action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
?>
<form method="post">
<input type="submit" name="action" value="Place Order">
</form>


<?php
if($action == "Place Order"){
    $order = new Order($rows);
    $order->CreateOrder();
}
 
$foo = array(

    'whatever', // [0]
    'foo', // [1]
    'bar',
    'banan',
    'ketchup'


);

echo "<pre>";
var_dump($foo);
echo "</pre>"; 

unset($foo[0]); // remove item at index 0


echo "<pre>";
var_dump($foo);
echo "</pre>"; 


$foo = array_values($foo); // 'reindex' array

echo "<pre>";
var_dump($foo);
echo "</pre>"; 

//Gamla produktkortet TA INTE BORT - ANDREAS
/* <div class="productcard">
<tr>
    <td><img src="./<?= $products[$i]->get_imagepath(); ?>" alt=" <?= $products[$i]->get_title(); ?> " border=0 height=600 width=600></img></td>
    <p class="title"><?= $products[$i]->get_title(); ?></p>
    <p></p>
    <td>Stock:</td>
    <td><?= $products[$i]->get_stock(); ?></td>
    <p></p>
    <td>Price:</td>
    <td><?= $currencyFormatter->formatCurrency($products[$i]->get_price(), "SEK") ; ?></td>
    <p style="margin-bottom: -50px;"></p>
    <form action="productcard.php" method="POST">
    <input type="hidden" name="product_id" value="<?= $products[$i]->get_product_id(); ?>">
        <p></p>
        <input class="button" style="background-color: brown; margin-top: 40px;" type="submit" value="More info">
    </form>
    <?php if($products[$i]->get_stock() > 0) { ?>
        <form action="shoppingcart.php" method="POST">
        <input type="hidden" name="product_id" value="<?= $products[$i]->get_product_id(); ?>">
            <p></p>
            <input class="button" style="float: right; background-color: green;" type="submit" value="Buy now">
        </form>
    <?php } else {?>
        <p class="button" style="float: right; background-color: green; cursor: default;">Out of stock!</p>
    <?php } ?>
    <form action="picturetab.php" method="POST" target="_blank">
    <input type="hidden" name="product_id" value="<?= $products[$i]->get_product_id(); ?>">
        <p></p>
        <input class="button" style=" background-color: black;" type="submit" value="View picture in new tab">
    </form>
</tr>
</div>  */




 ?>

 