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
    const APPLE_PRODUCT_NAME = 'Apple';

    const KILOGRAM = 'kg';

    const PRICE = 32;

    public function __construct()
    {
        parent::__construct(self::APPLE_PRODUCT_NAME, self::KILOGRAM, self::PRICE);
    }
}
