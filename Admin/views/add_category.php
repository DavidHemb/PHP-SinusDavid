<?php
include('./views/edit_categories.php');
//Anrop till att lägga till produkt
//ProductClass::addproduct($pruduct_id, +$title, $price, +$color, +$product_description, $imagepath, +$stock, $date_created, $date_updated, $is_published);
?>
<h3>Add New category</h3>
<fieldset>
    <legend>Add new category!</legend>
    <form method="post">
        <input type="hidden" name="action" value="add_category">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" autofocus required>

        <label for="category_description">category Description:</label>
        <textarea id="category_description" name="category_description" rows="10" cols="33"></textarea>
        
        <button>Submit</button>
    </form>
</fieldset>