<?php 
include('../Component/admin_header.php');
require('../Classes/product.php');
ProductClass::filldatabase($pruduct_id, $title, $price, $color, $product_description, $imagepath, $stock, $date_created, $date_updated, $is_published);
?>
    <body>
    
    <h2>Här visas massa skit!</h2>
       
    </body>

    <?php include('./Component/admin_footer.php') ?>