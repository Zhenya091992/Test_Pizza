<?php

namespace App\Models;

use App\Interfaces\ReceiptPosition;
use App\Services\NBRBAPI;

class Receipt
{
    public $report = [];

    public $total = 0;

    protected $countPosition = 0;

    protected $nbrbRate;

    public function __construct()
    {
        $this->nbrbRate = NBRBAPI::rateUSD();
    }

    public function addPosition(ReceiptPosition $position)
    {
        $price = round($position->getPrice() * $this->nbrbRate, 2);
        $this->report[++$this->countPosition] = [
            'name' => $position->getName(),
            'price' => $price
        ];
        $this->total = $this->total + $price;
    }
}