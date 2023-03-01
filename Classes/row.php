<?php  
class Row
{
    private $product_id;
    private $quantity;
    private $price;
    public function __construct($product_id, $quantity, $price)
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->price = $price;
    }
    public function get_product_id()
    {
        return $this->product_id;
    }
    private function set_product_id($product_id)
    {
        $this->product_id = $product_id;
    }
    public function set_quantity()
    {
        return $this->quantity;
    }
    private function get_quantity($quantity)
    {
        $this->quantity = $quantity;
    }
    public function set_price()
    {
        return $this->quantity;
    }
    private function get_price($price)
    {
        $this->price = $price;
    }
}
?>