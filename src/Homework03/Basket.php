<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 29/09/2014
 * Time: 22:22
 */

namespace Tdd\Homework03;

class Basket
{
    private $basket = array();

    const NAME = 'name';
    const PRICE = 'price';
    const UNIT = 'unit';
    const QUANTITY = 'quantity';

    /**
     * @return array
     */
    public function getBasket()
    {
        return $this->basket;
    }

    /**
     * @param string $name
     * @param string $unit
     * @param float  $price
     * @param int    $quantity
     */
    public function addToBasket($name, $unit, $price, $quantity)
    {
        $this->basket[] = array(
            self::NAME => $name,
            self::UNIT => $unit,
            self::PRICE => $price,
            self::QUANTITY => $quantity,
        );
    }
}
