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

	<?php
        require_once('./config.php');
        require_once('./Classes/order.php');
        require_once('./Classes/user.php');
		require_once('./User/checkoutconfir.php');
		session_start();

	// define variables and set to empty values
	$nameErr = $addressErr = $zipcodeErr = $cityErr = $phoneErr = $emailErr = "";
	$name = $address = $zipcode = $city = $phone = $email = "";


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

	function test_input($data) {
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}
	?>

	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<fieldset>
			<p><span class="error">* required field</span></p>

			<label for="name">Name:</label>
			<input type="text" id="name" name="name" value="<?php echo $name;?>">
			<span class="error">* <?php echo $nameErr;?></span>
			<br><br>

			<label for="address">Address:</label>
			<input type="text" id="address" name="address" value="<?php echo $address;?>">
			<span class="error">* <?php echo $addressErr;?></span>
			<br><br>

			<label for="zipcode">Zipcode:</label>
			<input type="text" id="zipcode" name="zipcode" value="<?php echo $zipcode;?>">
			<span class="error">* <?php echo $zipcodeErr;?></span>
            <br><br>

            <label for="city">City:</label>
			<input type="text" id="city" name="city" value="<?php echo $city;?>">
			<span class="error">* <?php echo $cityErr;?></span>
            <br><br>

            <label for="phone">Phone:</label>
			<input type="text" id="phone" name="phone" value="<?php echo $phone;?>">
			<span class="error">* <?php echo $phoneErr;?></span>
            <br><br>

            <label for="email">Email :</label>
			<input type="text" id="email" name="email" value="<?php echo $email;?>">
			<span class="error">* <?php echo $emailErr;?></span>
            <br><br>
     
            <input type="submit" name = "submit" value="Search";>
			<br><br>
       

            </form></fieldset>

	<form>
		<fieldset>
			<legend> Order Data </legend>					
	<?php foreach($_SESSION as $key => $value)
	{?>
	<label for="<=php echo $key; ?>"><?php echo $key . ':' . $value;?></label>
	<br>
	<?php } ?>
		

		</fieldset>
	</form>