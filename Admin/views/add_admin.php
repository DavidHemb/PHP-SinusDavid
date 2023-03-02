<?php
if (!isset($_SESSION["admin"])) {
    header("Location: ../../User/loginpage.php");
    exit();
}

?>

<fieldset>
    <legend>Add new Admin!</legend>
    <form method="post">
       <input type="hidden" name="action" value="add_admin">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" autofocus required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <br>
        <button>Submit</button>
    </form>
</fieldset>