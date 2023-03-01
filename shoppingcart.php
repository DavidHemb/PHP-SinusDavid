<?php
require_once('./classes/row.php');
session_start();
$product_id = $_POST['product_id'];
$quantity = 1;
$arr = array("product_id"=>$product_id, "quantity"=>$quantity);


new Row($arr["product_id"], $arr["quantity"]);
var_dump($arr);

$test = array();

for ($i = 0; $i < count($arr); $i++) 
{ ?>
    <tr>
        <td><?= $test["product_id"]->get_product_id(); ?></td>
        <td><?= $test["quantity"]->get_quantity(); ?></td>
    </tr>
<?php } ?>
*/