<?php

namespace App\Repositories;

use App\Models\Collections\CryptoCollection;

interface CryptoRepository
{
    public function findAllSymbols(array $symbols): CryptoCollection;
}