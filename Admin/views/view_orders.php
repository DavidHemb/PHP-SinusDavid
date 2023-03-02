<?php
if (!isset($_SESSION["admin"])) {
    header("Location: ../../User/loginpage.php");
    exit();
}
$orders = Order::ViewOrders();

?>
<h3>Orders</h3>
<table class="admin-products-view">
    <thead>
        <tr>
            <th scope="col">Order ID</th>
            <th scope="col">Customer Id</th>
            <th scope="col">Customer Name</th>
            <th scope="col">Order Date</th>
            <th scope="col">Items</th>
            <th scope="col">Order Value</th>
        </tr>
    </thead>
    <tbody>

        <?php for ($i = 0; $i < count($orders); $i++) {  ?>
            <tr>
                <td><?= $orders[$i]["order_id"]; ?></td>
                <td><?= $orders[$i]["user_id"]; ?></td>
                <td><?= $orders[$i]["name"]; ?></td>
                <td><?= $orders[$i]["date_created"]; ?></td>
                <td><?= $orders[$i]["Items"]; ?></td>
                <td><?= $currencyFormatter->formatCurrency($orders[$i]["Total_sum"], "SEK"); ?></td>
                <td>
                    <form method="POST">
                        <input type="hidden" name="order_id" value="<?= $orders[$i]["order_id"]; ?>">
                        <input class="admin-small-btn admin-red-btn" type="submit" id="delete_product" name="action" value="Delete Order"></input>
                        <input class="admin-small-btn " type="submit" id="delete_product" name="action" value="Order Details"></input>
                    </form>

                </td>
            </tr>


        <?php  }  ?>
    </tbody>

</table>