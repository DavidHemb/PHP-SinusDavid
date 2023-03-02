<?php
include('./views/edit_products.php');
if (!isset($_SESSION["admin"])) {
    header("Location: ../../User/loginpage.php");
    exit();
}
//Array of Category Objects
$categories = Category::ViewCategory();
$productToUpdate = Product::ADMINselectProductById($_POST['product_id']);

?>
<h3>Update product!</h3>
<fieldset>
    <legend>Update product!</legend>
    <p class="redtext">*Required fields</p>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="action" value="update_product">
        <input type="hidden" name="product_id "value="<?= $productToUpdate->get_product_id(); ?>">
        <input type="hidden" name="old_webpath" value="<?= $productToUpdate->get_imagepath(); ?>">
        <label for="title">*Title:</label>
        <input type="text" id="title" name="title" value="<?= $productToUpdate->get_title(); ?>"autofocus required>

        <label for="category_id">Choose a Categories:</label>
        <label>(You must have a category before you can add products)</label>
        <select name="category_id" id="category_id" required>
            <?php for ($i = 0; $i < count($categories); $i++) { ?>
                <option value="<?= $categories[$i]->get_category_id() ?>"><?= $categories[$i]->get_title(); ?></option>
            <?php } ?>
        </select>

        <label for="product_description">Product Description:</label>
        <textarea id="product_description" name="product_description" rows="10" cols="33"><?= $productToUpdate->get_product_description(); ?></textarea>

        <p>Only <strong>JPG, JPEG, PNG</strong> & <strong>GIF</strong> files are allowed.</p>
        <p>Max size: <em>2Mb</em></p>
        <label type="button" for="fileToUpload" class="getFileButton">Select image</label>
        <input type="file" name="fileToUpload" id="fileToUpload" style="visibility:hidden">

        <label for="color">Color:</label>
        <input type="text" id="color" name="color" value="<?= $productToUpdate->get_color(); ?>">

        <label for="price">*Price:</label>
        <input type="number" id="price" name="price" min="0.00" step="0.01" value="<?= $productToUpdate->get_price(); ?>" required>

        <label for="stock">*Stock:</label>
        <input type="number" id="stock" name="stock" value="<?= $productToUpdate->get_stock(); ?>" required>

        <label for="published">*Publish now?</label>
        <select id="published" name="published" required>
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>

        <button>Submit</button>
    </form>
</fieldset>