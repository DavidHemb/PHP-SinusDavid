<?php
require_once('./config.php');
include('./component/header.php');
$conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
if ($conn instanceof mysqli)
{
    echo "Client info: " .$conn->client_info . "\n" . "Client Version: " . $conn->client_version;
}
$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="stylemenu.css">
        <title>Park</title>
    </head>
    <body>

    </body>
</html>