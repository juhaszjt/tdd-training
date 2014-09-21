<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 21/09/2014
 * Time: 17:13
 */

namespace Tdd\test\Homework01;
use Tdd\Homework01\Math;

class MathTest extends \PHPUnit_Framework_TestCase
{
    public function testSum()
    {
        $this->assertEquals(2, Math::sum(1, 1));
    }

    public function testprimeFactor()
    {
        $this->assertEquals(array(5, 3), Math::primeFactor(15));
    }
}
