<?php
require_once('../Classes/user.php');
if (!isset($_SESSION["admin"])) {
    header("Location: ../../User/loginpage.php");
    exit();
}
$admins = User::GetAllAdminsFromDB();

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


        <?php for ($i = 1; $i < count($admins); $i++) {  ?>
            <tr>
                <td><?= $admins[$i]["username"] ?> </td>
             
                <td>
                    <form method="POST">
                        <input type="hidden" name="admin_username" value="<?= $admins[$i]["username"]?>">
                        <input class="admin-small-btn admin-red-btn" type="submit" id="delete_admin" name="action" value="Delete Admin"></input>
                    </form>

                </td>
            </tr>


        <?php  }  ?>
    </tbody>

</table>