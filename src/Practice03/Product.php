<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 23/09/2014
 * Time: 18:13
 */

namespace Tdd\Practice03;

abstract class Product
{
    protected  $quantity = 0;
    protected  $price    = 0;
    protected  $unit     = '';

    
    public function __construct($quantity)
    {
        if($this->validate($quantity))
        {
            $this->quantity = $quantity;
        } else {
            throw new \InvalidArgumentException();
        }
    }
    
   final public function calculate()
   {
       if(empty($this->quantity) || empty($this->price))
       {
           return 0;
       }

       return ($this->quantity * $this->price);
   }

    private function validate($quantity)
    {
        // TODO: min max validation in the future
        return  (is_int($quantity));
    }

}