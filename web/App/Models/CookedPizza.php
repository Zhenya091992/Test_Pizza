<?php

namespace App\Models;

use \App\Interfaces\ReceiptPosition;
use App\Services\CalculateCookedPizza;

class CookedPizza implements ReceiptPosition
{
    protected $name = '';

    protected $price = 0;

    public function __construct(Pizza $pizza, Size $size)
    {
        $this->price = CalculateCookedPizza::getPricePizza($pizza, $size);
        $this->name = $pizza->name . ' ' . $size->size . 'см.';
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}