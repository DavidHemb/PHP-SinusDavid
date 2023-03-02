<?php
require('../Classes/user.php');
$products = Product::ADMINviewProducts();
//$admins = User::GetAllAdminsFromDB();
?>
<h3>Admins</h3>
<table class="admin-products-view">
    <thead>
        <tr>
            <th scope="col">Username</th>
            <th scope="col">
                <form method="POST">
                    <input class="admin-small-btn-new" type="submit" id="update_product" name="action" value="New Admin"></input>
                </form>
            </th>

        </tr>
    </thead>
    <tbody>


        <?php for ($i = 0; $i < count($products); $i++) {  ?>
            <tr>
                <td>ett namn</td>
             
                <td>
                    <form method="POST">
                        <input type="hidden" name="admin_username" value="ETT ADMIN ID!!">
                        <input class="admin-small-btn admin-red-btn" type="submit" id="delete_product" name="action" value="Delete Admin"></input>
                    </form>

                </td>
            </tr>


        <?php  }  ?>
    </tbody>

</table>