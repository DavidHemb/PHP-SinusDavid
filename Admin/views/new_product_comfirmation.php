<?php
if (!isset($_SESSION["admin"])) {
    header("Location: ../../User/loginpage.php");
    exit();
} ?>
<h3>Success: New Product <?php echo $new_product->get_title()?> Created</h3>
<table>
    <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Date Created</th>
            <th scope="col">Date Updated</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Color</th>
            <th scope="col">Stock</th>
            <th scope="col">Price</th>
            <th scope="col">Published</th>

        </tr>
    </thead>
    <tbody>

        <tr>
            <td><img src="../<?= $new_product->get_imagepath(); ?>" alt=" <?= $new_product->get_title(); ?> " border=0 height=50 width=50></img></td>
            <!-- <td><?= $new_product->get_product_id(); ?></td> -->
            <td><?= $new_product->get_date_created(); ?></td>
            <td><?= $new_product->get_date_updated(); ?></td>
            <td><?= $new_product->get_title(); ?></td>
            <td><?= $new_product->get_product_description(); ?></td>
            <td><?= $new_product->get_color(); ?></td>
            <td><?= $new_product->get_stock(); ?></td>
            <td><?= $currencyFormatter->formatCurrency($new_product->get_price(), "SEK"); ?></td>
            <?php if ($new_product->get_is_published() == 1) { ?>
                <td>Yes</td>
            <?php } else { ?>
                <td>No</td>
            <?php } ?>
        </tr>

    </tbody>

</table>