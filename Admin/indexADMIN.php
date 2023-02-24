<?php
include('../Component/admin_header.php');
require('../Classes/product.php');

?>

<body>

    <h2>Här visas massa skit!</h2>

    <?php
    echo var_dump($_POST['Add_New_Product']);
    // Selects input form
    // if (isset($_POST['View All'])) {
    //     include('./Admin/views/add_product.php');
    // }
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
            $new_product = new ProductClass();
         break;

//    case 'find':
        
//          break;

//    case 'move':

//          break;

  

//    case 'collect':
      
//          break; 
}




?>

</body>

<?php include('../Component/admin_footer.php') ?>