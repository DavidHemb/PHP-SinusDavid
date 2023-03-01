<?php 
require_once('./Classes/order.php');
require_once('./Classes/row.php');
require_once('./config.php');
$row1 = new Row(1,3,20);
$row2 = new Row(2,1,99);
$row3 = new Row(3,2,15);

$rows = array($row1,$row2,$row3);
    

 $action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
?>
<form method="post">
<input type="submit" name="action" value="Place Order">
</form>


<?php
if($action == "Place Order"){
    $order = new Order(1, $rows);
    $order->CreateOrder();
}
 
 ?>

 