<?php

$orders = Order::ViewOrders();
echo "<pre>";
print_r($orders);
echo "</pre>";
echo count($orders);
?>
<h3>Products</h3>
<table class="admin-products-view">
    <thead>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Order Date</th>
            <th scope="col">Items</th>
            <th scope="col">Order Value</th>
        </tr>
    </thead>
    <tbody>

        <?php for ($i = 0; $i < count($orders); $i++) {  ?>
            <tr>
                <td><?= $orders[$i]["order_id"]; ?></td>
                <td><?= $orders[$i]["date_created"]; ?></td>
                <td><?= $orders[$i]["Items"]; ?></td>
                <td><?= $orders[$i]["Total_sum"]; ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="product_id" value="<?= $orders[$i]["order_id"]; ?>">
                        <input class="admin-small-btn admin-red-btn" type="submit" id="delete_product" name="action" value="Delete"></input>
                    </form>

                </td>
            </tr>


        <?php  }  ?>
    </tbody>

</table>