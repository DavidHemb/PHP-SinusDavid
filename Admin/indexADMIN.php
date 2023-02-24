<?php
include('../Component/admin_header.php');
require('../Classes/product.php');
ProductClass::addproduct($pruduct_id, $title, $price, $color, $product_description, $imagepath, $stock, $date_created, $date_updated, $is_published);
?>

<body>

    <h2>Här visas massa skit!</h2>

    <?php

    // Selects input form
    if (isset($_POST['View All'])) {
        include('view/view_product.php');
    }
    if (isset($_POST['Add New Product'])) {
        include('view/add_product.php');
    }
    if (isset($_POST['Delete Product'])) {
        include('view/delete_product.php');
    }
    if (isset($_POST['Update Product'])) {
        include('view/update_product.php');
    }
    if (isset($_POST['Find'])) {
        include('view/find_product.php');
    }
  
    if (isset($_POST["Logout"])) {
        session_destroy();
        unset($_SESSION);
    }

    ?>




</body>

<?php include('./Component/admin_footer.php') ?>