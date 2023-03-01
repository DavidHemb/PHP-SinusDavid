<?php  
class Row
{
    private $product_id;
    private $quantity;
    public function __construct($product_id, $quantity)
    {
        $this->product_id = $product_id;
        $this->quantity = $quantity;
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
}
?>