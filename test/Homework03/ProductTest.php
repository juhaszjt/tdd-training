<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 28/09/2014
 * Time: 22:32
 */

namespace Tdd\Test\Homework03;

use Tdd\Homework03\Product;

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
}
 