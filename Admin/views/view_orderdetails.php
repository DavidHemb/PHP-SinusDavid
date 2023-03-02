<?php

$order_rows = Order::ViewOrderDetails($_POST["order_id"]);

?>
<h3>Order Details</h3>
<table>
    <thead>
        <tr>
            <th>Customer Details</th>
        </tr>
        <tr>
            <th scope="col">Customer Id</th>
            <th scope="col">Customer Name</th>
            <th scope="col">City</th>
            <th scope="col">Street Adress</th>
            <th scope="col">Zip Code</th>
            <th scope="col">Phone Number</th>
            <th scope="col">E-Mail</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            
            <td><?= $order_rows[0]["user_id"] ?></td>
            <td><?= $order_rows[0]["name"] ?></td>
            <td><?= $order_rows[0]["city"] ?></td>
            <td><?= $order_rows[0]["address"] ?></td>
            <td><?= $order_rows[0]["zipcode"] ?></td>
            <td><?= $order_rows[0]["phone"] ?></td>
            <td><?= $order_rows[0]["email"] ?></td>
            
        </tr>
    </tbody>
</table>
<br>
<table class="admin-products-view">
    <thead>
        <tr>
            <th colspan="5" scope="col">Order ID: <?= $order_rows[0]["order_id"] ?> </th>
        </tr>
        <tr>
            <th scope="col">Product ID</th>
            <th scope="col">Title</th>
            <th scope="col">Color</th>
            <th scope="col">Quantity</th>
            <th scope="col">Price</th>
        </tr>
    </thead>
    <tbody>

        <?php for ($i = 0; $i < count($order_rows); $i++) {  ?>
            <tr>

                <td><?= $order_rows[$i]["product_id"]; ?></td>
                <td><?= $order_rows[$i]["title"]; ?></td>
                <td><?= $order_rows[$i]["color"]; ?></td>
                <td><?= $order_rows[$i]["quantity"]; ?></td>
                <td><?= $currencyFormatter->formatCurrency($order_rows[$i]["price"], "SEK"); ?></td>

            </tr>


        <?php  }  ?>
    </tbody>

</table>