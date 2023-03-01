<?php

Class Order{

    private $order_id;
    private $date_created;
    //private $date_updated;
    //Array of Row Objects
    private $order_rows;

    public function __construct($order_id, $order_rows){
        $this->order_id = $order_id;
        $this->order_rows = $order_rows;
    }


    public function get_order_id(){
        return $this->order_id; 
    }
    public function set_order_id($order_id){
        $this->order_id = $order_id;
    }
    public function get_date_created(){
        return $this->date_created;
    }
    public function set_date_created($date_created){
        $this->date_created = $date_created;
    }
    // public function get_date_updated(){
    //     return $this->date_updated;
    // }
    // public function set_date_updated($date_updated){
    //     $this->date_updated = $date_updated;
    // }
    public function get_order_rows(){
        return $this->order_rows;
    }
    public function set_order_rows($order_rows){
        $this->order_rows = $order_rows;
    }

    public function CreateOrder(){
        
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "INSERT INTO `order` (date_created, date_updated) VALUES (NOW(), NOW())";
        
        if ($conn->query($sql) === TRUE) {
            echo "Order created successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
        $this->set_order_id($conn->insert_id);

        //Loop the order_row array
        for ($i=0; $i < count($this->order_rows); $i++) {
            
            $product_id = $this->order_rows[$i]->get_product_id();
            $quantity = $this->order_rows[$i]->get_quantity();
            $price = $this->order_rows[$i]->get_price();

            $query = $conn->prepare("INSERT INTO order_row (product_id, order_id, quantity, price) 
            VALUES (?, ?, ?, ?)");
            $query->bind_param('iiid', 
            $product_id,
            $this->order_id,
            $quantity,
            $price);
            $query->execute(); 
        }
       
        $conn->close();
    }

    // public function UpdateOrder(){

    // }

    public function DeleteOrder($order_id){
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $sql = "DELETE FROM order_rows WHERE order_id = $order_id";
        $conn->close();
        //2
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        $sql = "DELETE FROM `order` WHERE order_id = $order_id";
        $conn->close();
        return;
    }
    public static function ViewOrders(){
        //Return all orders from the db into an array of order objects
           // Create connection
           $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

           $sql = "SELECT o.order_id, o.date_created , sum(r.quantity) AS Items, SUM(r.price) AS Total_sum FROM `order` o
           JOIN order_row r
           ON r.order_id = o.order_id
           GROUP BY o.order_id";
           $result = $conn->query($sql);
           $orders = array();
   
   
           while ($row = $result->fetch_assoc()) {
                echo "<pre>";
                echo print_r($row);
                echo "</pre>";

               $orders[] = $row;
           }
           return  $orders;
    }

    private static function GetOrderFromDB($order_id){
        //Get all info and all rows from an order in the db return an order object
        return ;
    }

}
?>