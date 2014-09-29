<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 29/09/2014
 * Time: 23:47
 */

namespace Tdd\Test\Homework03;


class CashierTest extends \PHPUnit_Framework_TestCase
{
    private $cashier;

    public function setUp()
    {
        $this->cashier = new Cashier();
    }
}
