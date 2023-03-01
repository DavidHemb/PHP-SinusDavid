<?php
include('./views/edit_products.php');
$products = Product::ADMINviewProducts();

?>
<h3>Products</h3>
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
                <form method="POST">
                    <input class="admin-small-btn-new" type="submit" id="update_product" name="action" value="New Product"></input>
                </form>
            </th>

        </tr>
    </thead>
    <tbody>


        <?php for ($i = 0; $i < count($products); $i++) {  ?>
            <tr>
                <td><?= $products[$i]->get_product_id(); ?></td>
                <td><?= $products[$i]->get_category_title(); ?></td>
                <td><img src="../<?= $products[$i]->get_imagepath(); ?>" alt=" <?= $products[$i]->get_title(); ?> " border=0 height=50 width=50></img></td>
                <td><?= $products[$i]->get_date_created(); ?></td>
                <td><?= $products[$i]->get_date_updated(); ?></td>
                <td><?= $products[$i]->get_title(); ?></td>
                <td><?= $products[$i]->get_product_description(); ?></td>
                <td><?= $products[$i]->get_color(); ?></td>
                <td><?= $products[$i]->get_stock(); ?></td>
                <td><?= $currencyFormatter->formatCurrency($products[$i]->get_price(), "SEK"); ?></td>
                <?php if ($products[$i]->get_is_published() == 1) { ?>
                    <td>Yes</td>
                <?php } else { ?>
                    <td>No</td>
                <?php } ?>
                <td>
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?= $products[$i]->get_product_id(); ?>">
                        <input class="admin-small-btn admin-red-btn" type="submit" id="delete_product" name="action" value="Delete Product"></input>
                        <input class="admin-small-btn" type="submit" id="update_product" name="action" value="Update Product"></input>
                    </form>

                </td>
            </tr>


        <?php  }  ?>
    </tbody>

</table>