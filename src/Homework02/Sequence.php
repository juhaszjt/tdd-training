<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 23/09/2014
 * Time: 06:41
 */

namespace Tdd\Homework02;

class Sequence
{
    private $elements;

    public function __construct(array $elements)
    {
        $this->elements = $elements;
    }

    public function getElements()
    {
        return $this->elements;
    }

    public function validateElements()
    {
        if (empty($this->elements))
        {
            return false;
        }

        foreach($this->elements as $element)
        {
            if(!is_int($element))
            {
                return false;
            }
        }

        return true;
    }
}
