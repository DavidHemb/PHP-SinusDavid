<?php
session_start();
session_destroy();
unset($_SESSION);
if (!isset($_SESSION["user"])) {
    header("Location: ../index.php");
    exit();
}
?>