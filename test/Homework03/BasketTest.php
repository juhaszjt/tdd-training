<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 29/09/2014
 * Time: 22:18
 */

namespace Tdd\Test\Homework03;

use Tdd\Homework03\Basket;
use Tdd\Homework03\AppleProduct;
use Tdd\Homework03\Product;

class BasketTest extends \PHPUnit_Framework_TestCase
{
    public function testBasketExists()
    {
        $basket = new Basket();
    }

    public function testBasketVariableExists()
    {
        $basket = new Basket();

        $basket->getBasket();
    }

    public function testBasketVariableEquals()
    {
        $basket = new Basket();
        $this->assertEquals(array(), $basket->getBasket());
    }

    public function testAddToBasket()
    {
        $basket = new Basket();

        $basket->addToBasket(AppleProduct::APPLE_PRODUCT_NAME, AppleProduct::KILOGRAM, AppleProduct::PRICE, 65);
        $this->assertEquals(
            array(
                0 => array(
                    'name' => AppleProduct::APPLE_PRODUCT_NAME,
                    'price' => AppleProduct::KILOGRAM,
                    'unit' => AppleProduct::PRICE,
                    'quantity'=> 65
                )
            ),
            $basket->getBasket()
        );
    }
}
 