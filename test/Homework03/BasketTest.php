<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 29/09/2014
 * Time: 22:18
 */

namespace Tdd\Test\Homework03;

use Tdd\Homework03\Basket;

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

        $basket->addToBasket();
    }
}
 