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
}
