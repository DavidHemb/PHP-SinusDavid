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

</head>

<body>

	<h1 style="text-align: center;">Checkout Form</h1>

	<?php
        require_once('./config.php');
        require_once('./Classes/order.php');
        require_once('./Classes/user.php');
		require_once('./Component/purchase.php');
		//require_once('./User/checkoutconfir.php');
		session_start();

	// define variables and set to empty values
	$nameErr = $addressErr = $zipcodeErr = $cityErr = $phoneErr = $emailErr = "";
	$name = $address = $zipcode = $city = $phone = $email = "";
	function test_input($data) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	  }
	

	if ($_SERVER["REQUEST_METHOD"] == "POST") { 
	  if (empty($_POST["name"])) {
	    $nameErr = "Name is required";
	  } else {
	    $name = test_input($_POST["name"]);
	    // check if name only contains letters and whitespace
	    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
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
	    if (!preg_match("/^[0-9]{5}$/",$zipcode)) { 
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
	    if (!preg_match("/^[0-9]{10}$/",$phone)) {
	      $phoneErr = "Invalid phone number";
	    }
	  }

	  if (empty($_POST["email"])) {
	    $emailErr = "Email is required";
	  } else {
	    $email = test_input($_POST["email"]);
	    // check if email address is valid
	    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	      $emailErr = "Invalid email format";
	    }
	  }
	}


	?>

</form></fieldset>

<form>
	<fieldset>
		<legend> Welcome to checkout! </legend>					
<?php foreach($_SESSION as $key => $value)
{?>
<label for="<=php echo $key; ?>"><?php echo $value ;?></label>
<br>
<?php } ?>
	


	</fieldset>
</form>
<br>
<form>
	<fieldset>
		<legend> Wish to login or register? </legend>					

	
<button onclick="location.href='./User/loginpage.php'">
  <a href="./User/loginpage.php">Loginpage</a>
</button>

<button onclick="location.href='./User/registerpage.php'">
  <a href="./User/registerpage.php">Registerpage</a>
</button>


	</fieldset>
</form>
<br>
<?php   
if (!isset($_SESSION["user"])) { // finns det en user

}   ?>
	<form method="post" action="./checkoutconf.php">
		<fieldset>
			<p><span class="error">* required field</span></p>

			<label for="name">Name:</label>
			<input type="text" id="name" name="name" value="<?php echo $name;?>"; required>
			<span class="error">* <?php echo $nameErr;?></span>
			<br><br>

			<label for="address">Address:</label>
			<input type="text" id="address" name="address" value="<?php echo $address;?>"; required>
			<span class="error">* <?php echo $addressErr;?></span>
			<br><br>

			<label for="zipcode">Zipcode:</label>
			<input type="text" id="zipcode" name="zipcode" value="<?php echo $zipcode;?>"; required>
			<span class="error">* <?php echo $zipcodeErr;?></span>
            <br><br>

            <label for="city">City:</label>
			<input type="text" id="city" name="city" value="<?php echo $city;?>"; required>
			<span class="error">* <?php echo $cityErr;?></span>
            <br><br>

            <label for="phone">Phone:</label>
			<input type="text" id="phone" name="phone" value="<?php echo $phone;?>"; required>
			<span class="error">* <?php echo $phoneErr;?></span>
            <br><br>

            <label for="email">Email :</label>
			<input type="text" id="email" name="email" value="<?php echo $email;?>"; required>
			<span class="error">* <?php echo $emailErr;?></span>
            <br><br>
     
            <input type="submit" name = "submit" value="Submit";>

			<br><br>
			<form>
	<fieldset>
<?php 



?>						
	 

	
<button onclick="location.href='./User/loginpage.php'">
  <a href="./User/index.php">Return to Homepage</a>
</button>

<button onclick="location.href='./User/registerpage.php'">
  <a href="./User/registerpage.php">Finish purchase</a>
</button>

	</fieldset>
</form>

</body>
</html>