<?php 
require_once('../config.php');
class Catagories
{
    private $title;
    private $description;

    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }
    public function get_title()
    {
        return $this->title;
    }
    public function set_title($title)
    {
        $this->title = $title;
    }
    public function get_description()
    {
        return $this->description;
    }
    public function set_description($description)
    {
        $this->description = $description;
    }
    public function createcatagory()
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("INSERT INTO category (`title`, `description`)
        VALUES (?, ?)");
        $query->bind_param('ss', $title, $description);
        $query->execute();
        $conn->close();
    }
    public function updatecatagory()
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("UPDATE category 
        SET(`title`=?, `description`=?");
        $query->bind_param('ss', $title, $description);
        $query->execute();
        $conn->close();
    }
    public function deletecatagory()
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("DELETE FROM category WHERE `title`=?");
        $query->bind_param('s', $title);
        $query->execute();
        $conn->close();
    }
}
?>