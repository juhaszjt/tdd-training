<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 23/09/2014
 * Time: 07:19
 */

namespace Tdd\Test\Homework02;

use Tdd\Homework02\Sequence;
use Tdd\Homework02\SequenceAnalyser;

class SequenceAnalyserTest extends \PHPUnit_Framework_TestCase
{
    private $sequence = null;

    private $sequenceAnalyser = null;

    /**
     * @param array $elements
     * @param int $max
     *
     * @dataProvider sequenceMaxDataProvider
     */
    public function testGetSequenceMax(array $elements, $max)
    {
        $this->sequence = new Sequence($elements);

        $this->sequenceAnalyser = new SequenceAnalyser($this->sequence);

        $this->assertEquals($max, $this->sequenceAnalyser->getSequenceMax());
    }

    /**
     * sequenceMaxDataProvider
     *
     * @return array
     */
    public function sequenceMaxDataProvider()
    {
        return array(
            array(array(6, 9, 15, -2, 92, 11), 92),
        );
    }

    /**
     * @param array $elements
     * @param int $min
     *
     * @dataProvider sequenceMinDataProvider
     */
    public function testGetSequenceMin(array $elements, $min)
    {
        $this->sequence = new Sequence($elements);

        $this->sequenceAnalyser = new SequenceAnalyser($this->sequence);

        $this->assertEquals($min, $this->sequenceAnalyser->getSequenceMin());
    }

    /**
     * sequenceMaxDataProvider
     *
     * @return array
     */
    public function sequenceMinDataProvider()
    {
        return array(
            array(array(6, 9, 15, -2, 92, 11), -2),
        );
    }
}
 