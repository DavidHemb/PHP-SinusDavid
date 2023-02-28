<?php

filter::filterfinder();
Class filter
{
    static public function filterfinder($title)
    {
        
        //Varibles in database sent in by calling function
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("SELECT *
        FROM products
        INNER JOIN category
        ON products.category_id = category.category_id
        WHERE category.title = ?;)");
        $query->bind_param('s', $title);
        $result = $conn->query($query);
        return $result;
    }
}