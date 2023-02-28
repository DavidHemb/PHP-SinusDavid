<?php
require_once('./config.php');
require_once('./classes/product.php');
require_once('./classes/category.php');
$filteraction = filter_input(INPUT_POST, 'filteraction', FILTER_UNSAFE_RAW);
$Usefilter = filter_input(INPUT_POST, 'usefilter', FILTER_UNSAFE_RAW);
$searchaction = filter_input(INPUT_POST, 'searchaction', FILTER_UNSAFE_RAW);
session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./CSS/main.css">
        <link rel="stylesheet" href="./CSS/header.css">
        <title>SINUS SKATEOARDS</title>
    </head>
    <header> 
    <div class="logo";>
    </div>
		<div class="dropdown">
			<button>Menu</button>
			<div class="dropdown-content">
				<?php
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
				} ?>
			</div>
		</div>
		<div class="loginbutton";>
            <a href="./User/loginpage.php" style="text-decoration: none;"><p class="logintext">Login</p></a>
        </div>
		<div class="search-container">
            <p class="searchtext">Search bar</p>
			<form method="post">
            <input type="hidden" name="searchaction" value="search">
				<input type="text" name= "search">
				<input type="submit" name = "submit" value="Search";>
			</form>
		</div>
        <div class="cart">
            <a href="shoppingcart.php" style="text-decoration: none;"><p class="carttext">Cart</p></a>
        </div>
    <br>
    </header>	
    <body>
    <?php 
    $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
    if ($conn instanceof mysqli){?>
    <p class="MYSQL"><?php echo "Client info: " .$conn->client_info . "\n" . "Client Version: " . $conn->client_version; ?></p>
    <?php } 
    $conn->close(); 
    $categories = Category::ViewCategory();?>
    <h1></h1>
    <form method="POST" class="filter">
        <input type="hidden" name="filteraction" value="filter">
        <input type="checkbox" id="usefilter" name="usefilter" value="usefilter">
        <label for="usefilter"> Use filter</label><br>
            <select class="selectoptionsbar" name="category_title" id="category_title">
            <?php for ($i = 0; $i < count($categories); $i++) { ?>
                <option class="filtertext" value="<?= $categories[$i]->get_title() ?>"><?= $categories[$i]->get_title(); ?></option>
            <?php } ?>
        </select>
        <input class="submitfilter" type="submit" value="Submit">
    </form>
    <?php 
    if(!empty($filteraction && $Usefilter == 'usefilter'))
    {
        switch ($filteraction) 
        {
        case 'filter':
            $products = product::filterproducts($_POST['category_title']);
            break;
        }
    }
    else if ($searchaction)
    {
        switch ($searchaction) 
        {
        case 'search':
            $products = product::SearchBarMetod();
            break;
        }
    }
    else
    {
        $products = Product::ADMINviewProducts();
    }
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