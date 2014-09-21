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

    /**
     * @param array $result
     * @param int   $factorizeNumber
     */
    public function testprimeFactor($result, $factorizeNumber)
    {
        $this->assertEquals($result, Math::primeFactor($factorizeNumber));
    }
}
