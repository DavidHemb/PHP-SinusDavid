<?php 
if (!isset($_SESSION["admin"])) {
    header("Location: ../../User/loginpage.php");
    exit();
}
?>
    <form method="POST">
        <input type="submit" name="view_categories" value="View Categories"></input>
        <input type="submit" name="create_category" value="Create Category"></input>
        <input type="submit" name="delete_category" value="Delete Category"></input>
        <input type="submit" name="update_category" value="Update Category"></input>
    </form>



