<?php
if (!isset($_SESSION["admin"])) {
    header("Location: ../../User/loginpage.php");
    exit();
}
include('./views/edit_products.php');
$inactiveproducts = Product::ADMINviewNOTActiveProducts();

?>

<h3>Inactive Products</h3>
<form method="POST">
<input class="admin-small-btn" type="submit" name="Edit_products" value="View Active Products"></input>
</form>
    <table class="admin-products-view">
    <thead>
        <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Category</th>
            <th scope="col">Image</th>
            <th scope="col">Date Created</th>
            <th scope="col">Date Updated</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Color</th>
            <th scope="col">Stock</th>
            <th scope="col">Price</th>
            <th scope="col">Published</th>
            <th scope="col">
               
            </th>

        </tr>
    </thead>
    <tbody>


        <?php for ($i = 0; $i < count($inactiveproducts); $i++) {  ?>
            <tr>
                <td><?= $inactiveproducts[$i]->get_product_id(); ?></td>
                <td><?= $inactiveproducts[$i]->get_category_title(); ?></td>
                <td><img src="../<?= $inactiveproducts[$i]->get_imagepath(); ?>" alt=" <?= $inactiveproducts[$i]->get_title(); ?> " border=0 height=50 width=50></img></td>
                <td><?= $inactiveproducts[$i]->get_date_created(); ?></td>
                <td><?= $inactiveproducts[$i]->get_date_updated(); ?></td>
                <td><?= $inactiveproducts[$i]->get_title(); ?></td>
                <td><?= $inactiveproducts[$i]->get_product_description(); ?></td>
                <td><?= $inactiveproducts[$i]->get_color(); ?></td>
                <td><?= $inactiveproducts[$i]->get_stock(); ?></td>
                <td><?= $currencyFormatter->formatCurrency($inactiveproducts[$i]->get_price(), "SEK"); ?></td>
                <?php if ($inactiveproducts[$i]->get_is_published() == 1) { ?>
                    <td>Yes</td>
                <?php } else { ?>
                    <td>No</td>
                <?php } ?>
                <td>
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?= $inactiveproducts[$i]->get_product_id(); ?>">
                        <input class="admin-small-btn-new" type="submit" id="update_product" name="action" value="Activate Product"></input>
                    </form>

                </td>
            </tr>


        <?php  }  ?>
    </tbody>
    
