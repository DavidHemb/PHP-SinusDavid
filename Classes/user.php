<?php
class User
{
    static public function registeruser($username, $password, $date)
    {
        
        //Varibles in database sent in by calling function
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("INSERT INTO users (username, userpassword, date_created)
        VALUES (?, ?, ?)");
        $query->bind_param('sss', $username, $password, $date);
        $query->execute();
        $conn->close();
    }
    static public function registeruserorder($userarray)
    {
        //KLAR MEN ADDERA DATECREATED!!!!
        //Varibles in database sent in by calling function
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("INSERT INTO users (username, userpassword, `name`, `address`, zipcode, city, phone, email)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param('sssssssss', $userarray['username'], $userarray['userpassword'], $userarray['name'], $userarray['address'], $userarray['zipcode'], $userarray['city'], $userarray['phone'], $userarray['email']);
        $query->execute();
        $conn->close();
    }
    static public function updateuserorder($userarray)
    {
        
        //Varibles in database sent in by calling function
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        var_dump($userarray);
        $sql = ("UPDATE users SET userpassword={$userarray['userpassword']}, `name`={$userarray['name']}, `address`={$userarray['address']}, zipcode={$userarray['zipcode']}, city={$userarray['city']}, phone={$userarray['phone']}, email={$userarray['email']} WHERE username={$userarray['username']})");
        if ($conn->query($sql) === TRUE) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . $conn->error;
        }
        $conn->close();
    }
    static function selectuser($username)
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("SELECT * FROM users WHERE username=?");
        $query->bind_param('s', $username);
        $query->execute();
        $result = $query->get_result();
        $r = $result->fetch_array(MYSQLI_ASSOC);
        //Return selected product in array 
        return $r;
    }
    static function selectadmins($username)
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("SELECT * FROM admins WHERE username=?");
        $query->bind_param('s', $username);
        $query->execute();
        $result = $query->get_result();
        $r = $result->fetch_array(MYSQLI_ASSOC);
        //Return selected product in array 
        return $r;
    }
}
?>