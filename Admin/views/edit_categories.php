<?php ?>
<nav>
    <form method="POST">
        <input type="submit" name="view_categories" value="View Categories"></input>
        <input type="submit" name="create_category" value="Create Category"></input>
        <input type="submit" name="delete_category" value="Delete Category"></input>
        <input type="submit" name="update_category" value="Update Category"></input>
    </form>
</nav>


<?php
//echo var_dump($_POST['Add_New_Product']);
// Selects input form
if (isset($_POST['view_categories'])) {
    include('./views/view_products.php');
}
if (isset($_POST['create_category'])) {
    include('./views/add_product.php');
}
if (isset($_POST['delete_category'])) {
    include('./views/edit_categories.php');
}
if (isset($_POST['update_category'])) {
    include('./views/edit_categories.php');
}
?>