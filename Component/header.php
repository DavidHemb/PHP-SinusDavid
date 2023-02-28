<?php
require_once('./config.php');
function SearchBarMetod() {
	$conn = Connect(DB_HOST,DB_NAME,DB_USERNAME,DB_PASSWORD);
    if (isset($_POST["submit"])) {
        $str = $_POST["search"];
        $sqlQuery = $conn->prepare("SELECT title, imagepath, price, stock FROM products WHERE title LIKE ? OR product_description LIKE ?");
        $str = '%' . $str . '%';
        $sqlQuery->bind_param("ss", $str, $str);
        $sqlQuery->execute();
        $result = $sqlQuery->get_result();
		echo 'Hello World';
        while ($row = $result->fetch_assoc()) {
            echo '<li><a href="details.php?id=' . $row['title'] . '">' . $row['imagepath'] . $row['price'] . $row['stock'] . '</a></li>';
        }
    }
	var_dump($row);
}


?>
		</header>

</html>