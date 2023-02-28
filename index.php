<?php
require_once('./config.php');
require_once('./classes/product.php');
$products = Product::ADMINviewProducts();
?>
<header> 
		<div class="dropdown">
			<button>Menu</button>
			<div class="dropdown-content">
				<?php
            // Header KIM
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
</header>	
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./CSS/main.css">
        <title>SINUS SKATEOARDS</title>
    </head>
    <body>
    <?php 
    $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
    if ($conn instanceof mysqli){?>
    <p class="MYSQL"><?php echo "Client info: " .$conn->client_info . "\n" . "Client Version: " . $conn->client_version; ?></p>
    <?php } $conn->close();?>
        <h1 class="SINUS">SINUS Skateboards</h1>
        <nav class="filter">
            <p></p>
            <a href="#">Price(High-Low)</a>
            <p></p>
            <a href="#">Price(Low-High)</a>
            <p></p>
            <a href="#">Skateboards</a>
            <p></p>
            <a href="#">Chothing</a>
            <p></p>
            <a href="#">Parts</a>
        </nav>
    <?php 
    for ($i = 0; $i < count($products); $i++) 
    {  
    if($products[$i]->get_is_published() == 1)
    { ?>
        <div class="productcard">
            <tr>
                <td><img src="./<?= $products[$i]->get_imagepath(); ?>" alt=" <?= $products[$i]->get_title(); ?> " border=0 height=600 width=600></img></td>
                <p class="title"><?= $products[$i]->get_title(); ?></p>
                <p></p>
                <td>Stock:</td>
                <td><?= $products[$i]->get_stock(); ?></td>
                <p></p>
                <td>Price:</td>
                <td><?= $currencyFormatter->formatCurrency($products[$i]->get_price(), "SEK") ; ?></td>
                <p style="margin-bottom: -50px;"></p>
                <form action="productcard.php" method="POST">
                    <input style="visibility:hidden" type="text" name ="INDEX" value="<?php echo $i ?>">
                    <p></p>
                    <input class="button" style="background-color: brown; margin-top: 40px;" type="submit" value="More info">
                </form>
                <form action="shoppingcart.php" method="POST">
                <input style="visibility:hidden" type="text" name ="INDEX" value="<?php echo $i ?>">
                    <p></p>
                    <input class="button" style="float: right; background-color: green; margin-top: -125;" type="submit" value="Buy now">
                </form>
            </tr>
        </div>  
    <?php }  }  ?>
    </body>
</html>