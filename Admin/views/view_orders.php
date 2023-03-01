<?php

//$orders = ROPA PÅ EN STATISK FUNKTION I ORDER SOM HÄMTAR ALLA ORDER;

?>
<h3>Products</h3>
<table class="admin-products-view">
    <thead>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Items</th>
            <th scope="col">Order Value</th>
        </tr>
    </thead>
    <tbody>


        <?php for ($i = 0; $i < count($products); $i++) {  ?>
            <tr>
                <td><?= $products[$i]->get_product_id(); ?></td>
                <td><?= $products[$i]->get_category_title(); ?></td>
                <td><img src="../<?= $products[$i]->get_imagepath(); ?>" alt=" <?= $products[$i]->get_title(); ?> " border=0 height=50 width=50></img></td>
              
                <td>
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?= $products[$i]->get_product_id(); ?>">
                        <input class="admin-small-btn admin-red-btn" type="submit" id="delete_product" name="action" value="Delete"></input>
                        <input class="admin-small-btn" type="submit" id="update_product" name="action" value="Update"></input>
                    </form>

                </td>
            </tr>


        <?php  }  ?>
    </tbody>

</table>