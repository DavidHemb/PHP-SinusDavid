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

        <label for="fileToUpload">Select image to upload:</label>
        <input type="file" name="fileToUpload" id="fileToUpload">

        <label for="color">Color:</label>
        <input type="text" id="color" name="color" required>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" required>

        <label for="stock">Stock:</label>
        <input type="number" id="stock" name="stock" required>

        <label for="published">Publish now?</label>
        <select id="published" name="published">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <button>Submit</button>
    </form>