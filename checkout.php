<?php
require_once('./config.php');
require_once('./Classes/order.php');
require_once('./Classes/user.php');
require_once('./Classes/product.php');
require_once('./Classes/row.php');
require_once('./Component/purchase.php');
//require_once('./User/checkoutconfir.php');
$useraction = filter_input(INPUT_POST, 'useraction', FILTER_UNSAFE_RAW);

session_start();

$order = $_SESSION["order"];
for ($i = 0; $i < count($order); $i++) {
	$products = product::ADMINselectProductById($order[$i]->get_product_id());
	?>
	<table>
		<th>Title</th>
		<th></th>
		<th>Color</th>
		<th>Price</th>
		<th>Quantity</th>
		<tr>
			<td>
				<?= $products->get_title(); ?>
			</td>
			<td><img src="../<?= $products->get_imagepath(); ?>" alt=" <?= $products->get_title(); ?> " border=0 height=50
					width=50></img></td>
			<td>
				<?= $products->get_color(); ?>
			</td>
			<td>
				<?= $order[$i]->get_price(); ?>
			</td>
			<td>
				<?php echo $order[$i]->get_quantity(); ?>
			</td>
	</table>
<?php }
// define variables and set to empty values
$usernameErr = $userpasswordErr = $nameErr = $addressErr = $zipcodeErr = $cityErr = $phoneErr = $emailErr = "";
$username = $userpassword = $name = $address = $zipcode = $city = $phone = $email = "";

if (!empty($_POST['makearray'])) {
	$makearray = $_POST['makearray'];
}
switch ($useraction) {
	case 'registeruser':
		$duplicateusername = user::selectuser($username);
		break;
}
function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["username"])) {
		$usernameErr = "Username is required";
	} else {
		$username = test_input($_POST["username"]);
	}
	if (empty($_POST["userpassword"])) {
		$userpasswordErr = "Password is required";
	} else {
		$userpassword = test_input($_POST["userpassword"]);
	}
	if (empty($_POST["name"])) {
		$nameErr = "Name is required";
	} else {
		$name = test_input($_POST["name"]);
		// check if name only contains letters and whitespace
		if (!preg_match("/^[a-zA-Z-' ]*$/", $name)) {
			$nameErr = "Only letters and white space allowed";
		}
	}
	if (empty($_POST["address"])) {
		$addressErr = "Address is required";
	} else {
		$address = test_input($_POST["address"]);
	}

	if (empty($_POST["zipcode"])) {
		$zipcodeErr = "Zipcode is required";
	} else {
		$zipcode = test_input($_POST["zipcode"]);
		// check if zipcode is valid
		if (!preg_match("/^[0-9]{5}$/", $zipcode)) {
			// preg_match Method searching for patterns.
			$zipcodeErr = "Invalid zipcode try agian 64354";
		}
	}
	if (empty($_POST["city"])) {
		$cityErr = "City is required";
	} else {
		$city = test_input($_POST["city"]);
	}
	if (empty($_POST["phone"])) {
		$phoneErr = "Phone number is required";
	} else {
		$phone = test_input($_POST["phone"]);
		// check if phone number is valid
		if (!preg_match("/^[0-9]{10}$/", $phone)) {
			$phoneErr = "Invalid phone number";
		}
	}
	if (empty($_POST["email"])) {
		$emailErr = "Email is required";
	} else {
		$email = test_input($_POST["email"]);
		// check if email address is valid

	}
}
if (!empty($makearray)) {
	if ($makearray == 1) {

		$userarray = array("username" => $username, "userpassword" => $userpassword, "name" => $name, "address" => $address, "zipcode" => $zipcode, "city" => $city, "phone" => $phone, "email" => $email, "user_id" => $_POST['user_id']);
		//IF DUPLICATE USERNAME
		if (!empty($duplicateusername)) {
			$duplicateusernameid = 1;
		}
	}
}
?>
<!DOCTYPE html>
<html>

<head>
	<title>Checkout Form</title>
	<style>
		form {
			display: flex;
			flex-direction: column;
			align-items: center;
		}
	</style>
</head>

<body>
	<h1 style="text-align: center;">Checkout Form</h1>
	<div>
		<p>
			<?php if (isset($_SESSION["user"])) {
				echo $_SESSION['user'];
			} ?>
		</p>
	</div>

	<br>
	<div>
		<?php if (!isset($_SESSION["user"])) { ?>
			<form method="POST">
				<input type="submit" name="useraction" value="Login">
				<input type="submit" name="useraction" value="Register">
			</form>
		<?php } else {
			$user = User::selectuser($_SESSION["user"]);
			?>
			<form method="POST">
				<fieldset>
					<p><span class="error">* required field</span></p>

					<label for="username">Username:</label>
					<input type="text" id="username" name="username" value="<?php echo $user["username"]; ?>" required>
					<span class="error">*
						<?php echo $nameErr; ?>
					</span>
					<br><br>

					<label for="password">Password:</label>
					<input type="password" id="password" name="password" value="<?php echo $user["userpassword"]; ?>"
						required>
					<span class="error">*
						<?php echo $nameErr; ?>
					</span>
					<br><br>

					<label for="name">Name:</label>
					<input type="text" id="name" name="name" value="<?php echo $user["name"]; ?>" required>
					<span class="error">*
						<?php echo $nameErr; ?>
					</span>
					<br><br>

					<label for="address">Address:</label>
					<input type="text" id="address" name="address" value="<?php echo $user["address"]; ?>" required>
					<span class="error">*
						<?php echo $addressErr; ?>
					</span>
					<br><br>

					<label for="zipcode">Zipcode:</label>
					<input type="text" id="zipcode" name="zipcode" value="<?php echo $user["zipcode"];
					; ?>" required>
					<span class="error">*
						<?php echo $zipcodeErr; ?>
					</span>
					<br><br>

					<label for="city">City:</label>
					<input type="text" id="city" name="city" value="<?php echo $user["city"]; ?>" required>
					<span class="error">*
						<?php echo $cityErr; ?>
					</span>
					<br><br>

					<label for="phone">Phone:</label>
					<input type="text" id="phone" name="phone" value="<?php echo $user["phone"]; ?>" required>
					<span class="error">*
						<?php echo $phoneErr; ?>
					</span>
					<br><br>

					<label for="email">Email :</label>
					<input type="text" id="email" name="email" value="<?php echo $user["email"]; ?>" required>
					<span class="error">*
						<?php echo $emailErr; ?>
					</span>
					<br><br>

					<input type="hidden" id="user_id" name="user_id" value="<?php echo $user["user_id"]; ?>">
					<input type="hidden" name="useraction" value="updateuser">
					<input type="hidden" name="makearray" value="1">
					<input type="submit" name="submit" value="Confirm purchase" ;>
					<br><br>
				</fieldset>
			</form>
		<?php
		} ?>
	</div>
	<br>
	<?php
	switch ($useraction) {
		case 'Login': ?>
			<form method="post">
				<h1>Sinus</h1>
				<h2>Login</h2>

				<label for="username">Username</label><br>
				<input type="text" id="username" name="username" value=""><br>
				<label for="password">Password</label><br>
				<input type="password" id="password" name="password" value=""><br>
				<input type="hidden" name="useraction" value="loginsubmit">
				<h2></h2>
				<input type="submit" value="Login">
			</form>
			<?php break;
		case 'Register':
			?>
			<form method="POST">
				<fieldset>
					<p><span class="error">* required field</span></p>

					<?php //ERROR MESSAGE ?>
					<?php if (isset($_GET['error'])) { ?>
						<p class="error">
							<?php echo $_GET['error']; ?>
						</p>
					<?php } ?>

					<label for="username">Username:</label>
					<input type="text" id="username" name="username" value="" required>
					<span class="error">*
						<?php echo $nameErr; ?>
					</span>
					<br><br>

					<label for="password">Password:</label>
					<input type="password" id="password" name="password" value="" required>
					<span class="error">*
						<?php echo $nameErr; ?>
					</span>
					<br><br>

					<label for="name">Name:</label>
					<input type="text" id="name" name="name" value="" required>
					<span class="error">*
						<?php echo $nameErr; ?>
					</span>
					<br><br>

					<label for="address">Address:</label>
					<input type="text" id="address" name="address" value="" required>
					<span class="error">*
						<?php echo $addressErr; ?>
					</span>
					<br><br>

					<label for="zipcode">Zipcode:</label>
					<input type="text" id="zipcode" name="zipcode" value="" ]; ; ?>" required>
					<span class="error">*
						<?php echo $zipcodeErr; ?>
					</span>
					<br><br>

					<label for="city">City:</label>
					<input type="text" id="city" name="city" value="" required>
					<span class="error">*
						<?php echo $cityErr; ?>
					</span>
					<br><br>

					<label for="phone">Phone:</label>
					<input type="text" id="phone" name="phone" value="" required>
					<span class="error">*
						<?php echo $phoneErr; ?>
					</span>
					<br><br>

					<label for="email">Email :</label>
					<input type="text" id="email" name="email" value="" required>
					<span class="error">*
						<?php echo $emailErr; ?>
					</span>
					<br><br>

					<input type="hidden" name="useraction" value="registeruser">
					<input type="hidden" name="makearray" value="1">
					<input type="submit" name="submit" value="Register" ;>
					<br><br>
				</fieldset>
			</form>
			<?php
			break;
		case 'loginsubmit':
			$inputusername1 = strtolower($_POST['username']);
			$inputpassword1 = strtolower($_POST['password']);
			$inputusername = Cleaner::test_input($inputusername1);
			$inputpassword = Cleaner::test_input($inputpassword1);
			$FoundUser = User::selectuser($inputusername);
			//Check for user loggin
			if ($FoundUser['username'] != $inputusername || $FoundUser['userpassword'] != $inputpassword) {
				echo 'Username or password incorrect';
			} else {
				$_SESSION["user"] = $FoundUser['username'];
				header('Location: ./checkout.php');
			}
			break;
		//ORDER & STUFF
		case 'updateuser':
			if ($username == ($_SESSION["user"])) {
				$duplicateusernameid = 0;
			}
			if ($duplicateusernameid == 0) {
				User::updateuserorder($userarray);
				header("Location: purchaseconfirmation.php");
			} else {
				header("Location: checkout.php?error= Username already exists!");
			}
			break;
		case 'registeruser':
			if ($duplicateusernameid == 0) {
				user::registeruserorder($userarray);
				$_SESSION["user"] = $userarray['username'];
				header('Location: ./checkout.php');
			} else {
				header("Location: checkout.php?error= Username already exists!");
			}
			break;
	}
	?>
</body>

</html>