<?php
include('./views/edit_categories.php');

if (!isset($_SESSION["admin"])) {
    header("Location: ../../User/loginpage.php");
    exit();
}
//Anrop till att lägga till produkt
//ProductClass::addproduct($pruduct_id, +$title, $price, +$color, +$product_description, $imagepath, +$stock, $date_created, $date_updated, $is_published);
?>

<fieldset>
    <legend>Add new category!</legend>
    <form method="post">
        <input type="hidden" name="action" value="add_category">
        <label for="category_title">Title:</label>
        <input type="text" id="category_title" name="category_title" autofocus required>

        <label for="category_description">Description:</label>
        <textarea id="category_description" name="category_description" rows="10" cols="33"></textarea>
        <br>
        <button>Submit</button>
    </form>
</fieldset>