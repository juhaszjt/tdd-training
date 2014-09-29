<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 29/09/2014
 * Time: 23:47
 */

namespace Tdd\Test\Homework03;

use Tdd\Homework03\Cashier;
use Tdd\Homework03\AppleProduct;
use Tdd\Homework03\LightProduct;
use Tdd\Homework03\StarShipProduct;
use Tdd\Homework03\Basket;

class CashierTest extends \PHPUnit_Framework_TestCase
{
    private $cashier;

    public function setUp()
    {
        $this->cashier = new Cashier();
    }

    public function testCashierClassExists()
    {
        $cashier = $this->cashier;
    }

    public function testCashierProductsExists()
    {
        $cashier = $this->cashier;

        $appleProduct = $cashier->getAppleProduct();
        $lightProduct = $cashier->getLightProduct();
        $starShipProduct = $cashier->getStarShipProduct();
        $basket = $cashier->getBasket();

        $this->assertEquals(new AppleProduct(), $appleProduct);
        $this->assertEquals(new LightProduct(), $lightProduct);
        $this->assertEquals(new StarShipProduct(), $starShipProduct);
        $this->assertEquals(new Basket(), $basket);
    }

    /**
     * @param array $item
     *
     * @dataProvider cashierBuyProductMethodDataProvider
     */
    public function testCashierBuyProductMethod(array $item)
    {
        $cashier = $this->cashier;

        $this->assertEquals(true, $cashier->buyProduct($item[0], $item[1]));
    }

    /**
     * cashierBuyProductMethodDataProvider
     *
     * @return array
     */
    public function cashierBuyProductMethodDataProvider()
    {
        return array(
            array(
                array(AppleProduct::APPLE_PRODUCT_NAME, 8),
                array(LightProduct::LIGHT_PRODUCT_NAME, 29),
                array(StarShipProduct::STAR_SHIP_PRODUCT_NAME, 87),
            ),
        );
    }

    /**
     * @param array $item
     *
     * @dataProvider cashierBuyProductMethodWithInvalidParamsDataProvider
     * @expectedException \InvalidArgumentException
     */
    public function testCashierBuyProductMethodWithInvalidParams(array $item)
    {
        $cashier = $this->cashier;

        $this->assertEquals(false, $cashier->buyProduct($item[0], $item[1]));
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
                array(AppleProduct::APPLE_PRODUCT_NAME, -8),
                array('Sausage', 29),
                array(StarShipProduct::STAR_SHIP_PRODUCT_NAME, 0),
                array('Grapes', 1.11),
                array(new \stdClass, 44),
                array('', 6),
                array(StarShipProduct::STAR_SHIP_PRODUCT_NAME, ''),
            ),
        );
    }
}
