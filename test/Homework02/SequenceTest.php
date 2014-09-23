<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 23/09/2014
 * Time: 06:41
 */

namespace Tdd\Test\Homework02;

use Tdd\Homework02\Sequence;

class SequenceTest extends \PHPUnit_Framework_TestCase
{
    private $sequence = null;

    public function testSequenceInit()
    {
        $elements = array(6, 4);

        $this->sequence = new Sequence($elements);
        $this->assertEquals($elements, $this->sequence->getElements());
    }
}
 