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

    private function set_category_id($category_id)
    {
        $this->category_id = $category_id;
    }

    public function get_category_id()
    {
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

        $sql = "SELECT * FROM category order BY title";
        $result = $conn->query($sql);
        $categories = array();


        while ($row = $result->fetch_assoc()) {

            $category = new category($row['title'], $row['description']);
            $category->set_category_id($row['category_id']);
            $categories[] = $category;
        }
        return $categories;
    }

    private static function TitleExists($title){

        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $titleToCheck = $title;

        $sql = "SELECT * FROM category WHERE title = '$titleToCheck'";
        $titleCheck = $conn->query($sql);
        $titleExist = false;
        
        if ($titleCheck->num_rows > 0) {
            $titleExist = true;
        }
        return $titleExist;
    }

    public function createcatagory()
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //Check if category title exists in DB
        $titleExist = true;

        if (Category::TitleExists($this->get_title())) {
            $titleExist = false;
        } else {
            //SQL
            $query = $conn->prepare("INSERT INTO category (`title`, `description`)
            VALUES (?, ?)");
            $query->bind_param('ss', $this->title, $this->description);
            $query->execute();
        }

        $conn->close();
        return (bool)$titleExist;
    }

    public static function UpdateCategory($id, $description)
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $titleExist = false;
       
       
            
            $query = "UPDATE category SET description='$description' WHERE category_id=$id";
            
            if ($conn->query($query) === TRUE) {
            
            } else {
                echo "Error updating record: " . $conn->error;
            }
       

        $conn->close();
        return (bool)$titleExist;
    }

    public static function OverwriteCategory($id, $description){

    }

   

    public static function DeleteCategory($category_id)
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("DELETE FROM category WHERE `category_id`=?");
        $query->bind_param('i', $category_id);
        $query->execute();
        $conn->close();
    }
}
