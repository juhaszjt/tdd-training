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
use Tdd\Practice03B\LightProduct;
use Tdd\Practice03B\StarShipProduct;

class BasketTest extends \PHPUnit_Framework_TestCase
{
    private $basket;

    public function setUp()
    {
        $this->basket = new Basket();
    }

    public function testBasketExists()
    {
        $basket = $this->basket;
    }

    public function testBasketVariableExists()
    {
        $basket = $this->basket;

        $basket->getBasket();
    }

    public function testBasketVariableEquals()
    {
        $basket = $this->basket;
        $this->assertEquals(array(), $basket->getBasket());
    }

    public function testAddToBasket()
    {
        $basket = $this->basket;

        $basket->addToBasket(AppleProduct::APPLE_PRODUCT_NAME, AppleProduct::KILOGRAM, AppleProduct::PRICE, 65);

        $this->assertEquals(
            array(
                0 => array(
                    Basket::NAME => AppleProduct::APPLE_PRODUCT_NAME,
                    Basket::UNIT => AppleProduct::KILOGRAM,
                    Basket::PRICE => AppleProduct::PRICE,
                    Basket::QUANTITY => 65
                )
            ),
            $basket->getBasket()
        );
    }

    /**
     * @dataProvider cashierBuyProductMethodWithInvalidParamsDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function testAddToBasketWithInvalidParams(array $params)
    {
        $basket = $this->basket;

        $basket->addToBasket($params[0], $params[1], $params[2], $params[3]);

        $this->assertEquals(array(), $basket->getBasket());
    }

    /**
     * cashierBuyProductMethodWithInvalidParamsDataProvider
     *
     * @return array
     */
    public function cashierBuyProductMethodWithInvalidParamsDataProvider()
    {
        return array(
            array(
                array('', AppleProduct::KILOGRAM, 45, 137),
                array(LightProduct::LIGHT_PRODUCT_NAME, 'crow', 21, 9),
                array(StarShipProduct::STAR_SHIP_PRODUCT_NAME, StarShipProduct::PIECE, -33, 55),
                array(LightProduct::LIGHT_PRODUCT_NAME, LightProduct::YEAR, 7, 0),
            )
        );
    }
}
 