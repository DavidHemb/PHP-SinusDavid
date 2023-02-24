<?php
require('config.php');
class sinuslib
{
    function filldatabase()
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = 
       "INSERT INTO product_id (ParkingSpotID, OccupationStatus, OccupationStatus, OccupationStatus, OccupationStatus, OccupationStatus)
        VALUES ('10', '0')";

        if ($conn->query($sql) === TRUE) 
        {
            echo "New record created successfully";
        }
        else 
        {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}