<?php

namespace App\Services;

use App\Models\Pizza;
use App\Models\Size;

abstract class CalculateCookedPizza
{
    /**
     * @param Pizza $pizza
     * @param Size $size
     * @return float
     *
     * формула расчета: цена начинки * площадь + цена теста определенного диаметра
     */
    public static function getPricePizza(Pizza $pizza, Size $size)
    {
        return $pizza->price * $size->area * 0.001 + $size->price;
    }
}