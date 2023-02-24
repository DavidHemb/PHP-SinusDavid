<?php 
require_once('../config.php');
class Product
{
    private $product_id;
    private $title;
    private $price;
    private $color;
    private $product_description;
    private $imagepath;
    private $stock;
    private $date_created;
    private $date_updated;
    private $is_published;

    public function __construct($title, $price, $color, $product_description ,$imagepath, $stock, $date_created, $date_updated, $is_published)
   {
      $this->title = $title;
      $this->price = $price;
      $this->color = $color;
      $this->product_description = $product_description;
      $this->imagepath = $imagepath;
      $this->stock = $stock;
      $this->date_created = $date_created;
      $this->date_updated = $date_updated;
      $this->is_published = $is_published;
   }
   public function get_product_id()
   {
      return $this->product_id;
   }
   
   private function set_product_id($product_id){
    $this->product_id = $product_id;
   }

   public function get_title()
   {
      return $this->title;
   }

   public function set_title($title){
        $this->title = $title;
   }

   public function get_price()
   {
      return $this->price;
   }

   public function set_price($price){
        $this->price = $price;
   }

   public function get_color()
   {
      return $this->color;
   }

   public function set_color($color){
    $this->color = $color;
   }

   public function get_product_description()
   {
      return $this->product_description;
   }


   public function set_product_description($product_description){
     $this->product_description = $product_description;
   }


   public function get_imagepath()
   {
      return $this->imagepath;
   }

   public function set_imagepath($imagepath){
    $this ->imagepath= $imagepath;
    
   }

   public function get_stock()
   {
      return $this->stock;
   }

   public function set_stock($stock){
    $this->stock = $stock;
   }
   public function get_date_created()
   {
      return $this->date_created;
   }

   private function set_date_created($date_created){
    $this->date_created = $date_created;
   }
 
   public function get_date_updated()
   {
      return $this->date_updated;
   }

   public function set_date_updated($date_updated){
    $this->date_updated = $date_updated;
   }

   public function get_is_published()
   {
      return $this->is_published;
   }

   public function set_is_published($is_published){
    $this->is_published = $is_published;
   }

    //MAIN
    //MAIN Function
    static function selectproduct()
    {
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("SELECT * FROM products WHERE is_published=?");
        $query->bind_param('i', $is_published);
        $is_published = "1";
        $query->execute();
        $result = $query->get_result();
        $r = $result->fetch_array(MYSQLI_ASSOC);
        //Return selected product in array 
        $r = new Product($r['pruduct_id'],['title'],['price'],['color'],['product_description'],['imagepath'],['stock'],['date_created'],['date_updated'],['is_published']);
        return $r;

    }
    //ADMIN
    //ADMIN Function
    public function ADMINaddproduct()
    {
        //Varibles in database sent in by calling function
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $test = $this->title;
        $query = $conn->prepare("INSERT INTO products (title, price, color, product_description, imagepath, stock, date_created, date_updated, is_published)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $query->bind_param('sdsssissi', $this->title, $this->price, $this->color, $this->product_description, $this->imagepath, $this->stock, $this->date_created, $this->date_updated, $this->is_published);
        $query->execute();

        $conn->close();
        
    }
    //ADMIN Function
    //Loops all products in the productstable and returns and array of product objects.
    static function ADMINviewProducts(){
                 
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);             

        $sql = "SELECT * FROM products";
        $result = $conn->query($sql);
        $products = array();


        /**
         *    private $product_id;
    private $title;
    private $price;
    private $color;
    private $product_description;
    private $imagepath;
    private $stock;
    private $date_created;
    private $date_updated;
    private $is_published;
         */
  
        while ($row = $result->fetch_assoc()) {
           
           $product = new Product($row['title'], $row['price'], $row['color'], $row['product_description'], $row['imagepath'],$row['stock'], $row['date_created'], $row['date_updated'],$row['is_published']);
           $product->set_product_id($row['product_id']);
           $products[] = $product;
        }
        return $products;

    }


    static function ADMINselectproduct($title)
    {
        //Varible title in database sent in by calling function
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("SELECT * FROM products WHERE title=?");
        $query->bind_param('s', $title);
        $query->execute();
        $result = $query->get_result();
        $r = $result->fetch_assoc();
        //Return selected product in array 
        $r = new Product($r['product_id'],['title'],['price'],['color'],['product_description'],['imagepath'],['stock'],['date_created'],['date_updated'],['is_published']);
        return $r;
    }
    //ADMIN Function
    static function ADMINupdateproduct($product)
    {
        //Varible title in database sent in by calling function
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("UPDATE products SET title, price, color, product_description, imagepath, stock, date_created, date_updated, is_published WHERE product_id=?");
        $query->bind_param('sdsssissii', $product['title'], $product['price'], $product['color'], $product['product_description'], $product['imagepath'], $product['stock'], $product['stock'], $product['date_created'], $product['date_updated'], $product['is_published'], $product['product_id']);
        $query->execute();
        $result = $query->get_result();
        $r = $result->fetch_array(MYSQLI_ASSOC);
    }
    static function ADMINpublishORnotproduct($title)
    {
        //Varible title in database sent in by calling function
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) 
        {
            die("Connection failed: " . $conn->connect_error);
        }
        //SQL
        $query = $conn->prepare("UPDATE products SET is_published WHERE product_id=?");
        $query->bind_param('ii', $is_published, $product_id);
        $query->execute();
        $result = $query->get_result();
        $r = $result->fetch_array(MYSQLI_ASSOC);
    }
}
