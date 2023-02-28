include()	

<!DOCTYPE html>

<html>
<head>
	<title>Header with Dropdown, Cart and Search</title>
</head>
<body>
	<header>
		<div class="dropdown">
			<button>Menu</button>
			<div class="dropdown-content">
				<?php
				include('header.css');
					// Generate menu items dynamically from array
					$menuItems = array('home', 'about', 'contact');
					$userChoice = isset($_GET['choice']) ? $_GET['choice'] : '';
					$choices = explode(',',$userChoice);
					foreach ($choices as $item) {
						echo '<a href="">' . $item .'<br>'. '</a>';
						if($choices == 'home')
						{
							echo'<a href=" ">' ;
						}
						
						else echo '-1';
					}

				?>
			</div>
		</div>
		
		<div class="search-container">
			<form method="post">
				<label> Search </label>
				<input type="text" name= "search">
				<input type="submit" name = "submit">
				<div class="cart">Cart</div>
                
			</form>
		</div>
        <br>
		<?php

	?>

<?php
require('../config.php');
// Create connection
$conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST["submit"]))
{
    $str = $_POST["search"];
    $sqlQuery = $conn->prepare("SELECT * FROM products WHERE product_description = ?");
    $sqlQuery->bind_param("s", $str);
    $sqlQuery->execute();
    $result = $sqlQuery->get_result();

    if($row = $result->fetch_assoc())
    {
        ?>
        <br><br><br>
        <table> 
            <tr>
                <th>Name</th>
                <th>Description</th>
            </tr>
            <tr>
                <td><?php var_dump($row)//echo $row['name']; ?></td>
                <td><?php
				if (isset($row['products_catagories'])) {
    echo $row['products_catagories'];
} else {
    // handle the case when the key doesn't exist
} 
echo 'ProductID' . $row['product_id'].'<br>'; 
echo 'Title' . $row['title'].'<br>';
echo 'Product_description' . $row['price'].'<br>';
?></td>

            </tr>
        </table>
        <?php
    }
    else {
        echo "Name does not exist";
    }
}


?>
		</header>

</html>