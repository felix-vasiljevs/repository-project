<?php

namespace App\Repositories;

interface CryptoRepository
{
    public function getCrypto(string $search, ?string $category = null): CryptoCollection;
}