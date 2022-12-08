<?php

namespace App\Models;

class Crypto
{
    private string $name;
    private float $currentPrice;
    private float $percentChange;
    private float $highPrice;
    private float $lowPrice;


    public function __construct(
        string $name,
        float $currentPrice,
        float $percentChange,
        float $highPrice,
        float $lowPrice
    )
    {
        $this->name = $name;

        $this->currentPrice = $currentPrice;
        $this->percentChange = $percentChange;
        $this->highPrice = $highPrice;
        $this->lowPrice = $lowPrice;
    }

    public function getCryptoName(): string
    {
        return $this->name;
    }

    public function getCurrentPrice(): float
    {
        return $this->currentPrice;
    }

    public function getPercentChange(): float
    {
        return $this->percentChange;
    }

    public function getHighPrice(): float
    {
        return $this->highPrice;
    }

    public function getLowPrice(): float
    {
        return $this->lowPrice;
    }

}