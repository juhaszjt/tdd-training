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
    private $basket;

    public function __construct()
    {
       $this->appleProduct = new AppleProduct();
       $this->lightProduct = new LightProduct();
       $this->starShipProduct = new StarShipProduct();
       $this->basket = new Basket();
    }

    /**
     * @return Basket
     */
    public function getBasket()
    {
        return $this->basket;
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

    /**
     * @param string $name
     * @param int    $quantity
     *
     * @return void.
     */
    public function buyProduct($name, $quantity)
    {
        $this->validInputParams($name, $quantity);

        return true;
    }

    private function validInputParams($name, $quantity)
    {
        if (
            !in_array(
                $name,
                array(
                    $this->appleProduct->getProductName(),
                    $this->lightProduct->getProductName(),
                    $this->starShipProduct->getProductName(),
                )
            )
        )
        {
            throw new \InvalidArgumentException('Invalid name param!');
        }

        if ($quantity < 0)
        {
            throw new \InvalidArgumentException('Invalid quantity param!');
        }
    }
}
