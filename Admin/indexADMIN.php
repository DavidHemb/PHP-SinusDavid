<?php
include('../Component/admin_header.php');
require_once('../Classes/product.php');
require_once('../Classes/category.php');
require_once('../config.php');

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);


?>

<main>
    <?php
    //echo var_dump($_POST['Add_New_Product']);
    // Selects input form

    //MAIN MENU!!

    if (isset($_POST['Edit_products'])) {
        include('./views/edit_products.php');
    }
    if (isset($_POST['Edit_categories'])) {
        include('./views/edit_categories.php');
    }


    //EDIT PRODUCT MENU!!
    if (isset($_POST['View_All'])) {
        include('./views/view_products.php');
    }
    if (isset($_POST['Add_New_Product'])) {
        include('./views/add_product.php');
    }

    //EDIT CATEGORY MENU!!
    if (isset($_POST['view_categories'])) {
        include('./views/view_category.php');
    }
    if (isset($_POST['create_category'])) {
        include('./views/add_category.php');
    }
    if (isset($_POST['delete_category'])) {
        include('./views/delete_category.php');
    }
    if (isset($_POST['update_category'])) {
        include('./views/select_category.php');
    }
    if ($action == 'select_category') {
        include('./views/update_category.php');
    }






    // if (isset($_POST['Delete Product'])) {
    //     include('view/delete_product.php');
    // }
    // if (isset($_POST['Update Product'])) {
    //     include('view/update_product.php');
    // }
    // if (isset($_POST['Find'])) {
    //     include('view/find_product.php');
    // }  
    // if (isset($_POST["Logout"])) {
    //     session_destroy();
    //     unset($_SESSION);
    // }




    // Handles input from hidden formaction above
    switch ($action) {
            //date('Y/m/d H:i')
        case 'add_product':

            /**
             * Adds product to the database from form.
             * File Upload script from https://www.w3schools.com/php/php_file_upload.asp
             * $title,
            $price,
            $color,
            $product_description,
            $imagepath,
            $stock,
            $date_created,
            $date_updated,
            $is_published
             * 
             */

            var_dump($_POST['category']);


            $target_dir = "../assets/img/products/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            //echo $target_file;
            $filename =  basename($_FILES["fileToUpload"]["name"]);
            $findLastDot = strpos($filename, ".");
            $fileRenamed = false;
            // Check if file already exists if so rename it with title as suffix
            while (file_exists($target_file)) {
                $suffix = 1;
                $target_file = $target_dir . substr($filename, 0, $findLastDot) . "_" . "{$_POST['title']}" . substr($filename, $findLastDot);
                $filename = substr($filename, 0, $findLastDot) . "_" . "{$_POST['title']}" . substr($filename, $findLastDot);
                $_FILES["fileToUpload"]["name"] = $filename;

                $fileRenamed = true;
            }

            // If file already exists confirm the rename
            if ($fileRenamed && !empty($_FILES["fileToUpload"]["tmp_name"])) { ?>
                <p>File already exists.</p>
                <p>File renamed to <?php echo $_FILES["fileToUpload"]["name"] ?></p>
                <?php $uploadOk = 1;
            }


            if (!empty($_FILES["fileToUpload"]["tmp_name"])) {
                // Check if image file is a actual image or fake image
                if ($action == "add_product") {
                    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                    if ($check !== false) {
                        $uploadOk = 1;
                    } else {
                        echo "File is not an image.";
                        $uploadOk = 0;
                    }
                }

                // Check file size - max filesize allowed is 2Mb
                if ($_FILES["fileToUpload"]["size"] > 2097153) { ?>
                    <h4>Sorry, your file is too large - max filesize allowed for product images is 2Mb</h4> echo
                <?php $uploadOk = 0;
                }

                // Allow certain file formats
                if (
                    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                    && $imageFileType != "gif"
                ) { ?>

                    <h4>Sorry, only JPG, JPEG, PNG & GIF files are allowed.</h4> echo
                    <?php

                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                    // if everything is ok, try to upload file
                } else {
                    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) { ?>
                        <p><em>The file <?php echo htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) ?> has been uploaded!</em></p>
                <?php } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
                $web_filePath = webFilePath($target_file);
            } else {
                $web_filePath = "assets/img/products/default_img.jpg";
            }

            if ($uploadOk) {
                $date = date('Y/m/d H:i');

                $new_product = new Product(
                    $_Post['category_title'],
                    $_POST['title'],
                    $_POST['price'],
                    $_POST['color'],
                    $_POST['product_description'],
                    $web_filePath,
                    $_POST['stock'],
                    $date,
                    $date,
                    $_POST['published']
                );
                $new_product->ADMINaddproduct();

                include('./views/new_product_comfirmation.php');
            }

            break;


        case 'add_category':

            $new_category =  new Category($_POST['category_title'], $_POST['category_description']);

            if ($new_category->createcatagory()) { ?>
                <h3>Title <?php echo $new_category->get_title(); ?> created! </h3>
            <?php } else {
                //$new_category->createcatagory(); 
            ?>

                <h3>Title <?php echo $new_category->get_title(); ?> already exsist, please try again!</h3>
            <?php }

            break;

        case 'update_category':

            Category::UpdateCategory($_POST['category_id'], $_POST['newDescription']);
            ?> <h3>Category Updated!</h3>
        <?php

            break;



        case 'delete_category':

            Category::DeleteCategory($_POST['category_id']); ?>
            <h3>Category Deleted</h3>

    <?php break;
    }




    ?>

</main>

<?php include('../Component/admin_footer.php') ?>
<?php
function webFilePath($filePath)
{
    $possition = strripos($filePath, "assets");
    $cleanPath = substr($filePath, $possition);
    return $cleanPath;
}
?>