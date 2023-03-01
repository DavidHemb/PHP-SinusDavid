<?php

Class Order{

    private $order_id;
    private $date_created;
    //private $date_updated;
    //Array of Row Objects
    private $order_rows;

    public function __construct($order_id, $date_created, $order_rows){
        $this->order_id = $order_id;
        $this->date_created = $date_created;
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
        //Create Order in DB

        //Send in order_rows in DB

    }

    // public function UpdateOrder(){

    // }

    public function DeleteOrder(){
        //Delete order in DB
        //Delete order_rows in DB
    }
    public function ViewOrder(){
        //Send order info to adminview
    }

}
?>