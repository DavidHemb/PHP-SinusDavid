<?php
require('sinuslib.php');
include('./component/header.php');
$conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
if ($conn instanceof mysqli)
{
    echo "Client info: " .$conn->client_info . "\n" . "Client Version: " . $conn->client_version;
}
$conn->close();