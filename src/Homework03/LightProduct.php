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
    const LIGHT_PRODUCT_NAME = 'Light';

    const YEAR = 'year';

    const PRICE = 15;

    public function __construct()
    {
        parent::__construct(self::LIGHT_PRODUCT_NAME, self::YEAR, self::PRICE);
    }
}