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

    private $max = null;

    const MAX = 'max';

    public function __construct(Sequence $sequence)
    {
        $this->sequence = $sequence;
    }

    public function getSequenceMax()
    {
        $this->returnOrCalculate(self::MAX);

        return $this->max;
    }

    private function returnOrCalculate($value)
    {
        if (is_null($this->$value))
        {
            $this->runAnalyser();
        }
    }

    private function runAnalyser()
    {
        $elements = $this->sequence->getElements();

        $this->max = 0;

        foreach ($elements as $element)
        {
            $this->checkAndSetMaxValue($element);
        }
    }

    private function checkAndSetMaxValue($element)
    {
        if ($element > $this->max)
        {
            $this->max = $element;
        }
    }
}
