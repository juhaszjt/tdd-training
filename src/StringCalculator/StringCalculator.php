<?php

namespace Tdd\StringCalculator;

class StringCalculator
{
    public function add($numbers)
    {
        $sumNumbers = 0;

        if (is_string($numbers))
        {
            $explodedNumbers = explode(',', $numbers);

            if (count($explodedNumbers) > 1)
            {
                foreach ($explodedNumbers as $number)
                {
                    //print $number;
                    if (is_int($number))
                    {
                        $sumNumbers += $number;
                    }
                    else
                    {
                        throw new \InvalidArgumentException;
                    }
                }
            }
            else
            {
                if (is_int($explodedNumbers[0]))
                {
                    $sumNumbers = $explodedNumbers[0];
                }
                else
                {
                    throw new \InvalidArgumentException;
                }
            }
        }

        return $sumNumbers;
    }
}