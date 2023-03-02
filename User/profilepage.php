<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    exit();
}
require_once('../config.php');
require_once('../classes/user.php');
$useraction = filter_input(INPUT_POST, 'useraction', FILTER_UNSAFE_RAW);
$Usefilter = filter_input(INPUT_POST, 'usefilter', FILTER_UNSAFE_RAW);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/profilepages.CSS">
        <title>SINUS PROFILE</title>
    </head>
    <body>
    <audio autoplay>
        <source src="../Assets/songs/GIGACHADshort.mp3" type="audio/mpeg">
    </audio>
    <div class="header">
        <h1 class="headertitle">Welcome GIGACHAD: <?=$_SESSION['user'];?>!</h1>
    </div>
    <div class="menu">
        <a href="./logoutpage.php" class="buttontext">Logout</a>
    </div>
    <div class="logout">
        <a href="../index.php" class="buttontext">To website</a>
    </div>
    <div class="orderhistory">
        <a href="" class="buttontext">Orderhistory</a>
    </div>
    <form method="POST" class="user">
        <input type="hidden" name="useraction" value="filter">
        <input type="checkbox" id="usefilter" name="usefilter" value="usefilter">
        <input class="buttontext" type="submit" value="User">
    </form>
    <?php if(!empty($useraction && $Usefilter == 'usefilter')){ $user = user::selectuser($_SESSION["user"]);?>
        <div class="menuviewuser" style="margin-top: 0px;" >
            <div class="viewtitle">
                <h2>PROFILE OF <?=$_SESSION['user'];?>!</h2>
            </div>
                <img class="img" src="../Assets/img/pictures/gigachad.jpg" height=600 width=1080></img>
                <form action="updateuser.php" method="POST" class="viewuserfrom">
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
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" min="0.00" step="0.01" placeholder="<?php echo $user["address"]; ?> ";>
                    <!-- Zipcode -->
                    <label for="price">Zipcode:</label>
                    <input type="text" id="zipcode" name="zipcode" min="0.00" step="0.01" placeholder="<?php echo $user["zipcode"] ?> ";>
                    <!-- City -->
                    <label for="price">City:</label>
                    <input type="text" id="city" name="city" min="0.00" step="0.01" placeholder="<?php echo $user["city"] ?> ";>
                    <!-- Phone -->
                    <br>
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" min="0.00" step="0.01" placeholder="<?php echo $user["phone"] ?> ";>
                    <!-- EMail -->
                    <label for="email">EMail:</label>
                    <input type="text" id="email" name="email" min="0.00" step="0.01" placeholder="<?php echo $user["email"] ?> ";>
                    <!-- Button back -->
                    <button class="button">Submit</button>
                    <a href="./profilepage.php" class="button">Back</a>
                </form>
            </div>
        <?php } ?>
    <div class="footer">
        <h2 class="footerleft">For all gigachads</h2>
        <h2 class="footertitle">Made by real Gs for real Gs</h2>
        <h2 class="footerright">"Insperational quote"</h2>
    </div>
    </body>
</html>