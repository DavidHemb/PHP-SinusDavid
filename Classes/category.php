<?php
require_once('../config.php');
class Category
{
    private $category_id;
    private $title;
    private $description;

    public function __construct($title, $description)
    {
        $this->title = $title;
        $this->description = $description;
    }

    private function set_category_id($category_id){
        $this->category_id = $category_id;
    }

    public function get_category_id(){
        return $this->category_id;
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

    public static function ViewCategory()
    {

        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

        $sql = "SELECT * FROM category";
        $result = $conn->query($sql);
        $categories = array();
    

        while ($row = $result->fetch_assoc()) {

            $category = new category($row['title'], $row['description']);
            $category->set_category_id($row['category_id']);
            $categories[] = $category;
        }
        return $categories;
    }

    public function createcatagory()
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //Check if category exists
        $titleToCheck = $this->get_title();
        $sql = "SELECT * FROM category WHERE title = '$titleToCheck'";
        $titleCheck = $conn->query($sql);
        $titleExist = 1;

        if ($titleCheck->num_rows > 0) {
            $titleExist = 0;
        } else {
            //SQL
            $query = $conn->prepare("INSERT INTO category (`title`, `description`)
            VALUES (?, ?)");
            $query->bind_param('ss', $this->title, $this->description);
            $query->execute();

        }

        $conn->close();
        return $titleExist;
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
