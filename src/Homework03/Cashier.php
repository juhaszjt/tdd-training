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

    private $sum = 0;

    const QUANTITY = 'quantity';

    const PRICE = 'price';

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

        switch($name)
        {
            case $this->appleProduct->getProductName():
                $this->basket->addToBasket(
                    $this->appleProduct->getProductName(),
                    $this->appleProduct->getPrice(),
                    $this->appleProduct->getUnit(),
                    $quantity
                );
                break;

            case $this->lightProduct->getProductName():
                $this->basket->addToBasket(
                    $this->lightProduct->getProductName(),
                    $this->lightProduct->getPrice(),
                    $this->lightProduct->getUnit(),
                    $quantity
                );
                break;

            case $this->starShipProduct->getProductName():
                $this->basket->addToBasket(
                    $this->starShipProduct->getProductName(),
                    $this->starShipProduct->getPrice(),
                    $this->starShipProduct->getUnit(),
                    $quantity
                );
                break;
        }

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

    public function calculate()
    {
        foreach($this->basket->getBasket() as $oneBasketItem)
        {
            $this->sum += $oneBasketItem[self::QUANTITY] * $oneBasketItem[self::PRICE];
        }

        return $this->sum;
    }
}
