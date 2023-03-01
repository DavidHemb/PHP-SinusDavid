<?php
require_once('../config.php');
require_once('../classes/user.php');
session_start();
$user = user::selectuser($_SESSION["user"]);
var_dump($user);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/profilepages.css">
        <title>SINUS Skateboards</title>
    </head>
    <body>
    <div class="menuviewuser" style="margin-top: 0px;" >
        <div class="viewtitle">
            <h2>PROFILE OF <?=$_SESSION['user'];?>!</h2>
        </div>
            <img class="img" src="../Assets/img/pictures/gigachad.jpg" height=600 width=1080></img>
            <form action="" class="viewuserfrom">
                <!-- Username -->
                <label for="Username">Username:</label>
                <input type="text" id="username" name="username" min="0.00" step="0.01" placeholder="<?php echo $user["username"]; ?> ";>
                <!-- Password -->
                <label for="password">Password:</label>
                <input type="text" id="password" name="password" min="0.00" step="0.01" placeholder="<?php echo $user["userpassword"]; ?> ";>
                <!-- Name -->
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" min="0.00" step="0.01" placeholder="<?php echo $user["name"]; ?> ";>
                <br>
                <!-- Adress -->
                <label for="price">Adress:</label>
                <input type="text" id="adress" name="adress" min="0.00" step="0.01" placeholder="<?php echo $user["address"]; ?> ";>
                <!-- Zipcode -->
                <label for="price">Zipcode:</label>
                <input type="text" id="zipcode" name="zipcode" min="0.00" step="0.01" placeholder="<?php echo $user["zipcode"] ?> ";>
                <!-- City -->
                <label for="price">City:</label>
                <input type="text" id="city" name="city" min="0.00" step="0.01" placeholder="<?php echo $user["city"] ?> ";>
                <!-- Phone -->
                <br>
                <label for="price">Phone Number:</label>
                <input type="text" id="phonenumber" name="price" min="0.00" step="0.01" placeholder="<?php echo $user["phone"] ?> ";>
                <!-- EMail -->
                <label for="price">EMail:</label>
                <input type="text" id="email" name="price" min="0.00" step="0.01" placeholder="<?php echo $user["email"] ?> ";>
                 <!-- Button back -->
                 <button class="button">Submit</button>
                <a href="./profilepage.php" class="button">Back</a>
            </form>
        </div>
    </body>
</html>