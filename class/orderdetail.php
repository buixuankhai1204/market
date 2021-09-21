<?php
require_once '../myhelper.php';
require_once 'vegetable.php';
require_once 'orderdetail.php';
class orderdetail
{
    // Properties
    public $vegetableId;
    public $quantity;
    public $price;
    public $name;
    public $picture;

    public function __construct($vegetableId, $quantity, $price, $name, $picture)
    {
        $this->vegetableId = $vegetableId;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->name = $name;
        $this->picture = $picture;
    }

}