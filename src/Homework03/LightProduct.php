<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 28/09/2014
 * Time: 23:39
 */

namespace Tdd\Homework03;

class LightProduct extends Product
{
    public function __construct($productName, $unit, $price)
    {
        parent::__construct($productName, $unit, $price);
    }
}