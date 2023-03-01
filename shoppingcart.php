<?php
require_once('./classes/row.php');
session_start();
$product_id = $_POST['product_id'];
$quantity = 1;
$arr = array("product_id"=>$product_id, "quantity"=>$quantity);


new Row($arr["product_id"], $arr["quantity"]);
?>