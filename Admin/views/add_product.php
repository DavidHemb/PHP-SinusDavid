<?php

//Anrop till att lägga till produkt
//ProductClass::addproduct($pruduct_id, +$title, $price, +$color, +$product_description, $imagepath, +$stock, $date_created, $date_updated, $is_published);
?>

<fieldset>
    <legend>Add new product!</legend>
    <form method="post">
        <input type="hidden" name="action" value="add_product">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description" rows="10" cols="33"></textarea>

        <label for="title">Color:</label>
        <input type="text" id="color" name="Color" required>

        <label for="title">Stock:</label>
        <input type="number" id="Stock" name="Stock" required>

        <label for="cars">Publish now?</label>
        <select id="cars" name="cars">
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select>

        <button>Submit</button>
    </form>
