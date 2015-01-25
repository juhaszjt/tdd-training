<?php

namespace Tdd\StringCalculator;

class StringCalculator
{
    public function add($numbers)
    {
        $sumNumbers = 0;

        if (is_string($numbers))
        {
            if ($numbers != '')
            {               
                $delimiter = ',';
                
                $pos = strpos($numbers, '//');

                if ($pos !== false) 
                {
                    $posDelimiterStart = strpos($numbers, '\n');
                    
                    if ($posDelimiterStart !== false)
                    {
                        $delimiter = substr($numbers, 2, $posDelimiterStart - 2);
                        $numbers = substr($numbers, $posDelimiterStart + 2);
                    }
                    else
                    {
                        throw new \InvalidArgumentException('Invalid delimiter syntactic!');       
                    }
                }
                
                if ($delimiter != ',')
                {                    
                    $explodedNumbers = explode($delimiter, $numbers);
                }
                else
                {     
                    $numbers = str_replace('\n', ',', $numbers);            
                    $explodedNumbers = explode(',', $numbers);
                }

                $negativeNumbers = '';
                $validNumbers = array();
                
                foreach($explodedNumbers as $number)
                {                    
                    if ($number < 0)
                    {    
                        $negativeNumbers .= $number . ',';                            
                    }
                    else
                    {
                        if ($number <= 1000)
                        {    
                            $validNumbers[] = $number;                            
                        }
                    }
                }

                if ($negativeNumbers != '')
                {               
                    throw new \InvalidArgumentException('negatives not allowed' . $negativeNumbers);                
                }
                
                $sumNumbers = array_sum($validNumbers);
            }
        }
        return $sumNumbers;
    }
}