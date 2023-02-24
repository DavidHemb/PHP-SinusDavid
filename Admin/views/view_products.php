<?php

$products = Product::ADMINviewProducts();

?>

<table>
    <thead>
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Product ID</th>
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


        <?php for ($i = 0; $i < count($products); $i++) {  ?>
            <tr>
                <td><img src="../<?= $products[$i]->get_imagepath(); ?>" alt=" <?= $products[$i]->get_title(); ?> " border=0 height=50 width=50></img></td>
                <td><?= $products[$i]->get_product_id(); ?></td>
                <td><?= $products[$i]->get_date_created(); ?></td>
                <td><?= $products[$i]->get_date_updated(); ?></td>
                <td><?= $products[$i]->get_title(); ?></td>
                <td><?= $products[$i]->get_product_description(); ?></td>
                <td><?= $products[$i]->get_color(); ?></td>
                <td><?= $products[$i]->get_stock(); ?></td>
                <td><?= $products[$i]->get_price(); ?></td>
                <?php if($products[$i]->get_is_published() == 1){?>
                <td>Yes</td>
                <?php } else{ ?>
                <td>No</td>
                <?php }?>
            </tr>


        <?php  }  ?>
    </tbody>
    
</table>
