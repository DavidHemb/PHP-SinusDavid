<?php 
class ProductClass
{
    function filldatabase($pruduct_id, $title, $price, $color, $product_description, $imagepath, $stock, $date_created, $date_updated, $is_published)
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $sql = 
       "INSERT INTO Products (product_id, title, price, color, product_description, imagepath, stock, date_created, date_updated, is_published)
        VALUES ('10', '0')";

        $query = $conn->prepare("INSERT INTO Products (product_id, title, price, color, product_description, imagepath, stock, date_created, date_updated, is_published)
        VALUES ('?', '?', '?', '?', '?', '?', '?', '?', '?', '?')");
        $query->bind_param('isdsssiddi', $pruduct_id, $title, $price, $color, $product_description, $imagepath, $stock, $date_created, $date_updated, $is_published, );
        $query->execute();
        $result = $query->get_result();
        $r = $result->fetch_array(MYSQLI_ASSOC);

        if ($conn->query($sql) === TRUE) 
        {
            echo "New record created successfully";
        }
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}
?>