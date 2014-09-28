<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 28/09/2014
 * Time: 22:46
 */

namespace Tdd\Homework03;

class Product
{
    private $productName = '';

    private $unit = '';

    private $price = 0;

    public function __construct($productName, $unit, $price)
    {
        $this->productName = $productName;

        $this->unit = $unit;

        $this->price = $price;
    }

    /**
     * @return string
     */
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
}