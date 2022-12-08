<?php

namespace App\Models\Collections;

use App\Models\Crypto;

class CryptoCollection
{
    private array $crypto;

    public function __construct(array $crypto = [])
    {
        $this->crypto = $crypto;
    }

    public function add(Crypto $crypto): void
    {
        $this->crypto[] = $crypto;
    }

    public function getCrypto(): array
    {
        return $this->crypto;
    }
}