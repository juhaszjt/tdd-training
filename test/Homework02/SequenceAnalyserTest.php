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

    public function testGetSequenceMax()
    {
        $this->sequence = new Sequence(array(6, 4));

        $this->sequenceAnalyser = new SequenceAnalyser($this->sequence);
    }
}
 