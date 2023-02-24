<?php 
require('config.php');
class ProductClass
{
    //ADMIN Function
    static function addproduct($pruduct_id, $title, $price, $color, $product_description, $imagepath, $stock, $date_created, $date_updated, $is_published)
    {
        //Varibles in database sent in by calling function
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("INSERT INTO Products (product_id, title, price, color, product_description, imagepath, stock, date_created, date_updated, is_published)
        VALUES ('?', '?', '?', '?', '?', '?', '?', '?', '?', '?')");
        $query->bind_param('isdsssiddi', $pruduct_id, $title, $price, $color, $product_description, $imagepath, $stock, $date_created, $date_updated, $is_published, );
        $query->execute();
        $result = $query->get_result();
        $r = $result->fetch_array(MYSQLI_ASSOC);
        //Error message
        if ($conn->query($query) === TRUE) 
        {
            echo "New record created successfully";
        }
        else 
        {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }
    //ADMIN Function
    static function selectproduct($title)
    {
        //Varible title in database sent in by calling function
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("SELECT * FROM producs WHERE title=?");
        $query->bind_param('s', $title);
        $query->execute();
        $result = $query->get_result();
        $r = $result->fetch_array(MYSQLI_ASSOC);
        //Return selected product in array 
        if ($conn->query($query) === TRUE) 
        {
            return $r;
        }
        else 
        {
            echo "Error: " . $query . "<br>" . $conn->error;
        }
    }

}
?>