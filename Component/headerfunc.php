<?php
require('../config.php');
require_once('./index.php');
function SearchBarMetod()
{

// Create connection
$conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["submit"]))
{
    $str = $_GET["search"];
    $sqlQuery = $conn->prepare("SELECT title,imagepath,price,stock FROM products WHERE title OR product_description LIKE '%?%';");
    $sqlQuery->bind_param("s", $str);
    $sqlQuery->execute();
    $result = $sqlQuery->get_result();

    while($row = mysqli_fetch_array($result))
    {
        echo '<li><a href="details.php?id=' . $row['product_id'] . '">' . $row['title'] . '</a></li>';
    }
   
}
// Göra en return på alla productid
}
function MenuMetod()
{

}
function CartMetod()
{}



?>