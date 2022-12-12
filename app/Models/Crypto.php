<?php

namespace App\Models;

class Crypto
{
    private string $symbol;
    private string $name;
    private float $price;
    private float $percentChange1h;
    private float $percentChange24h;
    private float $percentChange7d;

    public function __construct(
        string $symbol,
        string $name,
        float $price,
        float $percentChange1h,
        float $percentChange24h,
        float $percentChange7d
    )
    {
        $this->symbol = $symbol;
        $this->name = $name;
        $this->price = $price;
        $this->percentChange1h = $percentChange1h;
        $this->percentChange24h = $percentChange24h;
        $this->percentChange7d = $percentChange7d;
    }

    public function getSymbol(): string
    {
        return $this->symbol;
    }

    public function getCryptoName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getPercentChange1h(): float
    {
        return $this->percentChange1h;
    }

    public function getPercentChange24h(): float
    {
        return $this->percentChange24h;
    }

    public function getPercentChange7d(): float
    {
        return $this->percentChange7d;
    }
}