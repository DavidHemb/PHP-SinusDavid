<?php
include('../Component/admin_header.php');
require('../Classes/product.php');

$action = filter_input(INPUT_POST, 'action', FILTER_UNSAFE_RAW);
?>

<main>



    <h2>Här visas massa skit!</h2>

    <?php
    //echo var_dump($_POST['Add_New_Product']);
    // Selects input form
    if (isset($_POST['View_All'])) {
        include('./views/view_products.php');
    }
    if (isset($_POST['Add_New_Product'])) {
        include('./views/add_product.php');
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
            
            $target_dir = "../assets/img/products/";
            $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            // Check if image file is a actual image or fake image
            if ($action == "add_product") {
                $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }
            }

            // Check if file already exists
            if (file_exists($target_file)) {
                echo "Sorry, file already exists.";
                $uploadOk = 0;
            }

            // Check file size
            if ($_FILES["fileToUpload"]["size"] > 500000) {
                echo "Sorry, your file is too large.";
                $uploadOk = 0;
            }

            // Allow certain file formats
            if (
                $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
                && $imageFileType != "gif"
            ) {
                echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                $uploadOk = 0;
            }

            // Check if $uploadOk is set to 0 by an error
            if ($uploadOk == 0) {
                echo "Sorry, your file was not uploaded.";
                // if everything is ok, try to upload file
            } else {
                if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
                    echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            }

            var_dump($uploadOk);

            if($uploadOk){
                $date = date('Y/m/d H:i');
                $target_file = cleanFilePath($target_file);
                $new_product = new Product(
                    $_POST['title'],
                    $_POST['price'],
                    $_POST['color'],
                    $_POST['product_description'],
                    $target_file,
                    $_POST['stock'],
                    $date,
                    $date,
                    $_POST['published']
                );
                $new_product->ADMINaddproduct();
            }
           
            break;

            //    case 'find':

            //          break;

            //    case 'move':

            //          break;



            //    case 'collect':

            //          break; 
    }




    ?>

</main>

<?php include('../Component/admin_footer.php') ?>
<?php 
    function cleanFilePath($filePath){
        $possition = strripos($filePath,"assets");
        $cleanPath = substr($filePath,$possition);
        return $cleanPath;
    }
?>
