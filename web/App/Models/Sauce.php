<?php

namespace App\Models;

use \App\Interfaces\ReceiptPosition;

class Sauce extends Model implements ReceiptPosition
{
    const TABLE = 'sauces';

    public function getName()
    {
        return $this->name;
    }

    public function getPrice()
    {
        return $this->price;
    }
}