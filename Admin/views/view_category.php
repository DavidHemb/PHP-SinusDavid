<?php 
include('./views/edit_categories.php');
$category = Category::ViewCategory();

?>
<h3>Categories</h3>
<table>
    <thead>
        <tr>
            <th scope="col">Category ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
        </tr>
    </thead>
    <tbody>
        <?php for ($i = 0; $i < count($category); $i++) {  ?>
            <tr>
                <td><?= $category[$i]->get_category_id(); ?></td>
                <td><?= $category[$i]->get_title(); ?></td>
                <td><?= $category[$i]->get_description(); ?></td>
                <?php }?>
            </tr>
       
    </tbody>
    
</table>