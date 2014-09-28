<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 28/09/2014
 * Time: 23:38
 */

namespace Tdd\Homework03;

class AppleProduct extends Product
{
    public function __construct($productName, $unit, $price)
    {
        parent::__construct($productName, $unit, $price);
    }
}
