<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 28/09/2014
 * Time: 23:39
 */

namespace Tdd\Homework03;

class StarShipProduct extends Product
{
    const STAR_SHIP_PRODUCT_NAME = 'StarShip';

    const PIECE = 'piece';

    const PRICE = 999.99;

    public function __construct()
    {
        parent::__construct(self::STAR_SHIP_PRODUCT_NAME, self::PIECE, self::PRICE);
    }
}
