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

        $query = $conn->prepare("INSERT INTO `order` (order_id, date_created, date_updated) VALUES (?, NOW(), NOW())");
        $query->bind_param('i', $this->order_id);
        $query->execute();

        //Loop the order_row array
        for ($i=0; $i < count($this->order_rows); $i++) { 
            $query = $conn->prepare("INSERT INTO order_row (product_id, order_id, quantity, price) 
            VALUES (?, ?, ?, ?)");
            $query->bind_param('iiid', 
            $this->order_rows[$i]->get_product_id(),
            $this->order_id,
            $this->order_rows[$i]->get_quantity(),
            $this->order_rows[$i]->get_price());
            $query->execute(); 
        }
       
        $conn->close();
    }

    // public function UpdateOrder(){

    // }

    public function DeleteOrder(){
        
        //Delete order_rows in DB
        //Delete order in DB
        
    }
    public function ViewOrders(){
        //Return all orders from the db into an array of order objects
    }

    private static function GetOrderFromDB($order_id){
        //Get all info and all rows from an order in the db return an order object
        return ;
    }

}
?>