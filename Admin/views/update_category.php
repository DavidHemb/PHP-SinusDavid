<?php include('./views/edit_categories.php');
$categories = Category::ViewCategory();
echo $categories[$_POST['category_index']]->get_category_id();
?>
<fieldset>
    <legend>Update category!</legend>
    <form method="post">
        <input type="hidden" name="action" value="update_category">
        <input type="hidden" name="category_id" value="<?php echo $categories[$_POST['category_index']]->get_category_id() ?>"> 
        <label for="newTitle">Title:</label>
        <input type="text" id="newTitle" name="newTitle" value="<?php echo $categories[$_POST['category_index']]->get_title() ?>" autofocus required>

        <label for="newDescription">Description:</label>
        <textarea id="newDescription" name="newDescription" rows="10" cols="33"><?php echo $categories[$_POST['category_index']]->get_description(); ?></textarea>
        <br>
        <button>Submit</button>
    </form>
</fieldset>