<?php
require_once('./config.php');
require_once('./classes/product.php');
require_once('./classes/category.php');
require_once('./classes/row.php');
session_start();

echo "<pre>";
var_dump($_SESSION["rows"]);
echo "</pre>";

//HTML FOR PAGE
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="">
        <title>SINUS Skateboards</title>
    </head>
    <body>
    </body>
</html>