<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 28/09/2014
 * Time: 22:32
 */

namespace Tdd\Test\Homework03;

use Tdd\Homework03\Product;
use Tdd\Homework03\AppleProduct;
use Tdd\Homework03\LightProduct;
use Tdd\Homework03\StarShipProduct;

class ProductTest extends \PHPUnit_Framework_TestCase
{
    public function testProductClass()
    {
        $product = new Product('thing', 'unit', 55);
    }

    public function testProductClassStoredValuesEquals()
    {
        $productName = 'Apple';
        $unit = 'kg';
        $price = 32;

        $product = new Product($productName, $unit, $price);

        $this->assertEquals($productName, $product->getProductName());
        $this->assertEquals($unit, $product->getUnit());
        $this->assertEquals($price, $product->getPrice());
    }

    public function testExtendedProductClasses()
    {
        $appleProduct = new AppleProduct('Apple', 'kg', 32);
        $lightProduct = new LightProduct('Light', 'year', 15);
        $starShipProduct = new StarShipProduct('StarShip', 'piece', 999.99);
    }

    /**
     * @param Product $product
     * @param string  $productName
     * @param string  $unit
     * @param float   $price
     *
     * @dataProvider extendedProductClassesStoredValuesEqualsDataProvider
     */
    public function testExtendedProductClassesStoredValuesEquals(Product $product, $productName, $unit, $price)
    {
        $this->assertEquals($productName, $product->getProductName());
        $this->assertEquals($unit, $product->getUnit());
        $this->assertEquals($price, $product->getPrice());
    }

    /**
     * @return array
     */
    public function extendedProductClassesStoredValuesEqualsDataProvider()
    {
        return array(
            array(new AppleProduct('Apple', 'kg', 32), 'Apple', 'kg', 32),
            array(new LightProduct('Light', 'year', 15), 'Light', 'year', 15),
            array(new StarShipProduct('StarShip', 'piece', 999.99), 'StarShip', 'piece', 999.99),
            array(new Product('Pear', 'count', 24), 'Pear', 'count', 24),
            array(new Product('Flag', 'count', 4), 'Flag', 'count', 4),
        );
    }
}
 