
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
				SearchBarMetod();				
				include('header.css');
				require_once('headerfunc.php');

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



?>
		</header>

</html>