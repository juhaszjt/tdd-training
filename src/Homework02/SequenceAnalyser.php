<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 23/09/2014
 * Time: 07:19
 */

namespace Tdd\Homework02;

class SequenceAnalyser
{
    private $sequence = null;

    public function __construct(Sequence $sequence)
    {
        $this->sequence = $sequence;
    }
}
