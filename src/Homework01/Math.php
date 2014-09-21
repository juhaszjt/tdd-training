<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 11/09/2014
 * Time: 22:52
 */

namespace Tdd\Homework01;

class Math
{
    /**
     * @param int $a
     * @param int $b
     *
     * @return int
     */
    public function sum($a, $b)
    {
        return $a + $b;
    }

    /**
     * @param int $num
     *
     * @return array
     */
    public function primeFactor($num)
    {
        $sqrt = sqrt($num);

        for ($i = 2; $i <= $sqrt; $i++)
        {
            if ($num % $i == 0)
            {
                return array_merge(
                    self::primeFactor($num / $i),
                    array($i)
                );
            }
        }

        return array($num);
    }
}
