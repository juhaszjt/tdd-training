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
    // max
    private $max = null;

    private $min = null;

    private $elementCount = null;

    private $average = null;

    const MAX = 'max';

    const MIN = 'min';

    const ELEMENT_COUNT = 'elementCount';

    const VALUE = 'average';

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

        $this->max = $elements[0];
        $this->min = $elements[0];

        $sum = 0;

        foreach ($elements as $element)
        {
            $this->checkAndSetMaxValue($element);

            $this->checkAndSetMinValue($element);

            $sum += $element;
        }

        $this->elementCount = count($elements);

        $this->average = round($sum / $this->elementCount, 4);
    }

    private function checkAndSetMaxValue($element)
    {
        if ($element > $this->max)
        {
            $this->max = $element;
        }
    }

    public function getSequenceMin()
    {
        $this->returnOrCalculate(self::MIN);

        return $this->min;
    }

    private function checkAndSetMinValue($element)
    {
        if ($element < $this->min)
        {
            $this->min = $element;
        }
    }

    public function getSequenceElementCount()
    {
        $this->returnOrCalculate(self::ELEMENT_COUNT);

        return $this->elementCount;
    }

    public function getSequenceAverage()
    {
        $this->returnOrCalculate(self::VALUE);

        return $this->average;
    }
}
