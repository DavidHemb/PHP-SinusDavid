<?php
if (!isset($_SESSION["admin"])) {
    header("Location: ../../User/loginpage.php");
    exit();
}
?>