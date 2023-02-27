<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../CSS/loginpage.css">
        <title>Park</title>
    </head>
    <body>
        <div class=menu>
                <form action="registerconfirmation.php" method="post">
                    <h1>Sinus</h1>
                    <h2>Register</h2>
                    <?php if (isset($_GET['error'])) {?><p class="error"><?php echo $_GET['error']; ?></p><?php } ?>
                    <label for="username">Username</label><br>
                    <input type="text" id="username" name="username" value=""><br>
                    <label for="password">Password</label><br>
                    <input type="password" id="password" name="password" value=""><br>

                    <h2></h2>
                    <input style="background-color: black; color: white;" type="submit" value="Register">
                </form>
                <form action="loginpage.php">
                        <input style="background-color: black; color: white;" type="submit" value="Back">
                </form>
            </div>
    </body>
</html>