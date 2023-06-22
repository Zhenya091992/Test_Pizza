<?php

namespace App\Controllers;

use App\Models\Pizza;
use App\Models\Sauce;
use App\Models\Size;
use App\View;

class IndexController extends Controller
{
    public function index()
    {
        $pizzas = Pizza::findAll();
        $sizes = Size::findAll();
        $sauces = Sauce::findAll();

        $this->view->addData([
            'pizzas' => $pizzas,
            'sizes' => $sizes,
            'sauces' => $sauces,
        ]);

        $this->view->display('index.html');
    }
}