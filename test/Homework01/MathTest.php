<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 21/09/2014
 * Time: 17:13
 */

class MathTest extends PHPUnit_Framework_TestCase
{
    public function testSum()
    {
        $this->assertEquals(2, Math::sum(1, 1));
    }
}
 