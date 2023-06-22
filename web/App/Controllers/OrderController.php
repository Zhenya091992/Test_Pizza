<?php

namespace App\Controllers;

use App\Models\CookedPizza;
use App\Models\Pizza;
use App\Models\Receipt;
use App\Models\Sauce;
use App\Models\Size;

class OrderController extends Controller
{
    public function order()
    {
        $receipt = new Receipt();
        $pizza = Pizza::findById($_POST['pizzas']);
        $size = Size::findById($_POST['sizes']);
        $receipt->addPosition(new CookedPizza($pizza, $size));
        if ($_POST['sauces']) {
            $receipt->addPosition(Sauce::findById($_POST['sauces']));
        }

        echo json_encode($receipt, 256);
    }
}