<?php
/**
 * Created by PhpStorm.
 * User: jani
 * Date: 29/09/2014
 * Time: 23:50
 */

namespace Tdd\Homework03;

class Cashier
{
    private $appleProduct;
    private $lightProduct;
    private $starShipProduct;

    public function __construct()
    {
       $this->appleProduct = new AppleProduct();
       $this->lightProduct = new LightProduct();
       $this->starShipProduct = new StarShipProduct();
    }

    /**
     * @return mixed
     */
    public function getAppleProduct()
    {
        return $this->appleProduct;
    }

    /**
     * @return mixed
     */
    public function getLightProduct()
    {
        return $this->lightProduct;
    }

    /**
     * @return mixed
     */
    public function getStarShipProduct()
    {
        return $this->starShipProduct;
    }


}
