<?php

class Order
{

    private $order_id;
    private $date_created;
    //private $date_updated;
    //Array of Row Objects
    private $order_rows;

    public function __construct($order_rows)
    {
        $this->order_rows = $order_rows;
    }


    public function get_order_id()
    {
        return $this->order_id;
    }
    public function set_order_id($order_id)
    {
        $this->order_id = $order_id;
    }
    public function get_date_created()
    {
        return $this->date_created;
    }
    public function set_date_created($date_created)
    {
        $this->date_created = $date_created;
    }
    // public function get_date_updated(){
    //     return $this->date_updated;
    // }
    // public function set_date_updated($date_updated){
    //     $this->date_updated = $date_updated;
    // }
    public function get_order_rows()
    {
        return $this->order_rows;
    }
    public function set_order_rows($order_rows)
    {
        $this->order_rows = $order_rows;
    }

    public function CreateOrder($user_id)
    {

        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        //Creates a new order in the database
        $sql = "INSERT INTO `order` (date_created, date_updated) VALUES (NOW(), NOW())";

        if ($conn->query($sql) === TRUE) {
            echo "Order created successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
        //Sets the currents objects order ID with the last inserted order id from the order table
        $this->set_order_id($conn->insert_id);

        //Loop the order_row array
        for ($i = 0; $i < count($this->order_rows); $i++) {

            $product_id = $this->order_rows[$i]->get_product_id();
            $quantity = $this->order_rows[$i]->get_quantity();
            $price = $this->order_rows[$i]->get_price();

            //
            $query = $conn->prepare("INSERT INTO order_row (product_id, order_id, quantity, price) 
            VALUES (?, ?, ?, ?)");
            $query->bind_param(
                'iiid',
                $product_id,
                $this->order_id,
                $quantity,
                $price
            );
            $query->execute();

            //Update stock in database deduct the $quantity from the stock field on the product.
            $query = $conn->prepare("UPDATE products p SET p.stock= (p.stock-?)
            WHERE product_id=?");
            $query->bind_param(
                'ii',
                $quantity,
                $product_id
            );

            $query->execute();

        }
        echo "innan sista insert: ";
        echo $this->order_id;
        echo "<br>";
        echo $user_id;
        //Insers data into the correct customers orderhistory
        $query = $conn->prepare("INSERT INTO orderhistory
        (order_id, user_id)
        VALUES (?, ?)");
        $query->bind_param(
            'ii',
            $this->order_id,
            $user_id
        );
        $query->execute();

        $conn->close();
    }

    // public function UpdateOrder(){

    // }

    public static function DeleteOrder($order_id)
    {

        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "DELETE FROM order_row WHERE order_id = $order_id";
        if ($conn->query($sql) === TRUE) {
            $result1 = "Rows deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }

        $sql = "DELETE FROM `order` WHERE order_id = $order_id";
        if ($conn->query($sql) === TRUE) {
            $result2 = "Order deleted successfully";
        } else {
            echo "Error deleting record: " . $conn->error;
        }
        $conn->close();
        $resultArray = array($result1, $result2);
        return $resultArray;
    }
    public static function ViewOrders()
    {
        //Return all orders from the db into an array of order objects
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

        $sql = "SELECT o.order_id,u.user_id, u.name , o.date_created , sum(r.quantity) AS Items, SUM(r.price) AS Total_sum FROM `order` o
        JOIN order_row r
        ON r.order_id = o.order_id
        JOIN orderhistory h
           ON o.order_id = h.order_id
           JOIN users u
           ON h.user_id = u.user_id
        GROUP BY o.order_id";
        $result = $conn->query($sql);
        $orders = array();


        while ($row = $result->fetch_assoc()) {

            $orders[] = $row;
        }
        return  $orders;
    }

    public static function ViewOrderDetails($order_id)
    {
        //Return all orders from the db into an array of order objects
        // Create connection
        $conn = connect(DB_HOST, DB_NAME, DB_USERNAME, DB_PASSWORD);

        $sql = "SELECT h.order_id, r.product_id, r.quantity, r.price, p.title, p.color, u.user_id ,u.name, u.address, u.city, u.zipcode, u.phone, u.email FROM orderhistory h 
        JOIN order_row r
        ON h.order_id = r.order_id
        JOIN	products p
        ON r.product_id = p.product_id
        JOIN users u
        ON u.user_id = h.user_id
        WHERE h.order_id = $order_id
        ";

        $result = $conn->query($sql);
        $order_rows = array();


        while ($row = $result->fetch_assoc()) {

            $order_rows[] = $row;
        }
        return  $order_rows;
    }

    private static function GetOrderFromDB($order_id)
    {
        //Get all info and all rows from an order in the db return an order object
        return;
    }
}
