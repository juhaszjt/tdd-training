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

    private $min = null;

    private $elementCount = null;

    const MAX = 'max';

    const MIN = 'min';

    const ELEMENT_COUNT = 'elementCount';

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

        foreach ($elements as $element)
        {
            $this->checkAndSetMaxValue($element);

            $this->checkAndSetMinValue($element);
        }

        $this->elementCount = count($elements);
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
}
