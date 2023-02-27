
<?php include('./views/edit_categories.php');
$categories = Category::ViewCategory();
?>

<fieldset>
    <legend>Update Category!</legend>
    <form method="post">
        <input type="hidden" name="action" value="select_category">
        <label for="category_index">Category:</label>
        <select name="category_index" id="category_index">
            <?php for ($i = 0; $i < count($categories); $i++) { ?>
                <option value="<?= $i; ?>"><?= $categories[$i]->get_title(); ?></option>
            <?php } ?>
        </select>
      
        <button>Submit</button>
    </form>
</fieldset>
