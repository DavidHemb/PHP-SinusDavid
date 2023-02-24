<?php 
class Product
{
    public $product_id;
    public $title;
    public $price;
    public $color;
    public $product_description;
    public $imagepath;
    public $stock;
    public $date_created;
    public $date_updated;
    public $is_published;
    public function __construct($product_id, $title, $price, $color, $product_description ,$imagepath, $stock, $date_created, $date_updated, $is_published)
   {
      $this->product_id = $product_id;
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
   public function product_id()
   {
      return $this->product_id;
   }
   public function title()
   {
      return $this->title;
   }
   public function price()
   {
      return $this->price;
   }
   public function color()
   {
      return $this->color;
   }
   public function product_description()
   {
      return $this->product_description;
   }
   public function imagepath()
   {
      return $this->imagepath;
   }
   public function stock()
   {
      return $this->stock;
   }
   public function date_created()
   {
      return $this->date_created;
   }
   public function date_updated()
   {
      return $this->date_updated;
   }
   public function is_published()
   {
      return $this->is_published;
   }
}
class ProductClass
{
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
    static function ADMINaddproduct($pruduct_id, $title, $price, $color, $product_description, $imagepath, $stock, $date_created, $date_updated, $is_published)
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
        $query = $conn->prepare("INSERT INTO products (product_id, title, price, color, product_description, imagepath, stock, date_created, date_updated, is_published)
        VALUES ('?', '?', '?', '?', '?', '?', '?', '?', '?', '?')");
        $query->bind_param('isdsssissi', $pruduct_id, $title, $price, $color, $product_description, $imagepath, $stock, $date_created, $date_updated, $is_published);
        $query->execute();
        $result = $query->get_result();
        $r = $result->fetch_array(MYSQLI_ASSOC);
    }
    //ADMIN Function
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
        $r = new Product($r['pruduct_id'],['title'],['price'],['color'],['product_description'],['imagepath'],['stock'],['date_created'],['date_updated'],['is_published']);
        return $r;
    }
    //ADMIN Function
    static function ADMINupdateproduct($title)
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
        $query->bind_param('sdsssissii', $title, $price, $color, $product_description, $imagepath, $stock, $date_created, $date_updated, $is_published, $product_id, );
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
?>