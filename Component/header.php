<!DOCTYPE html>
<html>
<head>
	<title>Header with Dropdown, Cart and Search</title>
	<style>
		/* Header styles */
		header {
			display: flex;
			justify-content: space-between;
			align-items: center;
			background-color:darkgray;
			color: #fff;
			padding: 10px;

		}

		/* Dropdown styles */
		.dropdown {
			position: relative;
			display: inline-block;
		}

		.dropdown-content {
			display: none;
			position: absolute;
			z-index: 1;
			color:black;
		}

		.dropdown:hover .dropdown-content {
			display: block;
		}

		/* Cart styles */
		.cart {
			display: inline-block;
			margin-right: 1.25rem;
			font-size: 1.25rem;
			color: #fff;
			cursor: pointer;
		}

		/* Search styles */
		.search-container {
			display: inline-block;
			text-align: center;
		}

		.search-box {
			padding: 0,625rem;
			border-radius: 0,3125rem;
			border: none;
			width: 18,75rem;
			font-size: 1rem;
		}

		.search-button {
			padding: 0,625rem 1,25rem;
			border-radius: 0,3125rem;
			border: none;
			background-color: #4CAF50;
			color: #fff;
			font-size: 1rem;
			cursor: pointer;
		}
	</style>
</head>
<body>
	<header>
		<div class="dropdown">
			<button>Menu</button>
			<div class="dropdown-content">
				<?php
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
	</header>
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
	
    <img alt="A dog on an iPad" src="../assets/img/logo/sinus-logo-landscape - large.png" />
</body>
</html>