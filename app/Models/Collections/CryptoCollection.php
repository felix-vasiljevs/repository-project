<?php

namespace App\Models\Collections;

use App\Models\Crypto;

class CryptoCollection
{
    private array $crypto;

    public function __construct(array $crypto = [])
    {
        foreach ($crypto as $currency) {
            $this->add($currency);
        }
    }

    public function add(Crypto $crypto): void
    {
        $this->crypto[] = $crypto;
    }

    public function all(): array
    {
        return $this->crypto;
    }
}