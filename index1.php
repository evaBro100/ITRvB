<?php

abstract class Product
{
    protected float $basePrice;

    public function __construct(float $basePrice)
    {
        $this->basePrice = $basePrice;
    }

    abstract public function calculateFinalPrice(): float;


    public function calculateRevenue(): float
    {
        return $this->calculateFinalPrice();
    }
}


class DigitalProduct extends Product
{

    public function calculateFinalPrice(): float
    {
        return $this->basePrice / 2;
    }
}

class PhysicalProduct extends Product
{
    private int $quantity;

    public function __construct(float $basePrice, int $quantity)
    {
        parent::__construct($basePrice);
        $this->quantity = $quantity;
    }

    public function calculateFinalPrice(): float
    {
        return $this->basePrice * $this->quantity;
    }
}


class WeightBasedProduct extends Product
{
    private float $weight;

    public function __construct(float $basePrice, float $weight)
    {
        parent::__construct($basePrice);
        $this->weight = $weight;
    }

    public function calculateFinalPrice(): float
    {
        return $this->basePrice * $this->weight;
    }
}
