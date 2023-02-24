<?php
include('../Component/admin_header.php');
require('../Classes/product.php');
$action = filter_input(INPUT_POST,'action',FILTER_UNSAFE_RAW);
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
switch($action){
    //date('Y/m/d H:i')
   case 'add_product':

    /**
     * Adds product to the database from form.
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
    //    public function __construct(
    
            $date = date('Y/m/d H:i');

            $new_product = new Product(
                $_POST['title'],
                $_POST['price'],
                $_POST['color'],
                $_POST['product_description'],
                "assets/img/products/hoodie-ash.png",
                $_POST['stock'],
                $date,
                $date,
                $_POST['published']
             );
            $new_product->ADMINaddproduct();
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