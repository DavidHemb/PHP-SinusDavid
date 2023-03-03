<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    exit();
}
require_once('../config.php');
require_once('../classes/user.php');
$useraction = filter_input(INPUT_POST, 'useraction', FILTER_UNSAFE_RAW);
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
        <!-- AUDIO -->
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
        <input type="hidden" name="useraction" value="OpenUser">
        <input class="buttontext" type="submit" value="User">
    </form>
    <?php if($useraction == 'OpenUser'){ $user = user::selectuser($_SESSION["user"]); var_dump($user["user_id"]) ?>
        <div class="menuviewuser" style="margin-top: 0px;" >
            <div class="viewtitle">
                <h2>PROFILE OF <?=$_SESSION['user'];?>!</h2>
            </div>
                <img class="img" src="../Assets/img/pictures/gigachad.jpg" height=600 width=1080></img>
                <form action="updateuser.php" method="POST" class="viewuserfrom">
                    <!-- Username -->
                    <label for="Username">Username:</label>
                    <input type="text" id="username" name="username" value="<?php echo $user["username"]; ?> "; required>
                    <!-- Password -->
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" value="<?php echo $user["userpassword"]; ?> "; required>
                    <!-- Name -->
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="<?php echo $user["name"]; ?> "; required>
                    <br>
                    <!-- Adress -->
                    <label for="address">Address:</label>
                    <input type="text" id="address" name="address" value="<?php echo $user["address"]; ?> "; required>
                    <!-- Zipcode -->
                    <label for="price">Zipcode:</label>
                    <input type="text" id="zipcode" name="zipcode" value="<?php echo $user["zipcode"] ?> "; required>
                    <!-- City -->
                    <label for="price">City:</label>
                    <input type="text" id="city" name="city" value="<?php echo $user["city"] ?> "; required>
                    <!-- Phone -->
                    <br>
                    <label for="phone">Phone Number:</label>
                    <input type="text" id="phone" name="phone" value="<?php echo $user["phone"] ?> "; required>
                    <!-- EMail -->
                    <label for="email">EMail:</label>
                    <input type="text" id="email" name="email" value="<?php echo $user["email"] ?> "; required>
                    <!-- UserID -->
                    <label for="user_id">UserID:</label>
                    <tr> <td> <?php echo $user["user_id"]; ?> </td> </tr>
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo $user["user_id"];?>">
                    <!-- Button back -->
                    <button class="button" name="Submit">Submit</button>
                    <input class="button" name="useraction" type="submit" value="CloseUser">

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