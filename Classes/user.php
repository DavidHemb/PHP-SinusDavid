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
        $username = $userarray['username'];
        $userpassword = $userarray['userpassword'];
        $uname = $userarray['name'];
        $uaddress = $userarray['address'];
        $uzip = $userarray['zipcode'];
        $ucity = $userarray['city'];
        $tele = $userarray['phone'];
        $mail = $userarray['email'];
        $id = $userarray['user_id'];
        //Varibles in database sent in by calling function
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $sql = ("UPDATE `users` SET `username`='$username', userpassword='$userpassword', `name`='$uname', `address`='$uaddress', zipcode='$uzip', city='$ucity', phone='$tele', email='$mail' WHERE user_id='$id'");
        if ($conn->query($sql) === TRUE) {
            return;
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
    static function selectorderhistory($username)
    {
        //JOIN BORH KEYS
        //ORDERHISTORY
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



    //FUNCTIONS FOR ADMIN SECTION OF THE SITE

    static public function GetAllAdminsFromDB(){
        
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT username FROM admins";

        $result = $conn->query($sql);
        $admins = array();


        while ($row = $result->fetch_array()) {

            $admins[] = $row;
        }
        return  $admins;
    }

    static public function GetAllCustomersFromDB(){
         // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "";

        $result = $conn->query($sql);
        $customers = array();


        while ($row = $result->fetch_array()) {

            $customers[] = $row;
        }
        return  $customers;


    }

}
