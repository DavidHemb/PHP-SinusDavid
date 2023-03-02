<?php

//LÅT STÅ - ANDREAS!!
//I ER php.ini på ER EGNA XAMP Server, leta upp extension=intl och ta bort ; framför annars funkar inte NumberFormatter 
//Fix so that we can switch between formatting currencys from SEK to Euro using a $_SESSION[] variable
$locale = "se-SE";
$currencyFormatter = new NumberFormatter($locale, NumberFormatter::CURRENCY);
//LÅT STÅ - ANDREAS!!

const DB_HOST = 'localhost';
const DB_NAME = 'sinus';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
function Connect($dbHost, $dbName, $dbUsername, $dbPassword)
{
    $conn = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die("Cannot connect to database: \n" . $conn->connect_error . "\n" . $conn->connect_errno);
    }
    return $conn;
}
class Cleaner
{
    static function test_input($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}