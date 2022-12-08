<?php

namespace App\Services;

use App\Models\Collections\CryptoCollection;
use App\Repositories\ClientCryptoRepository;
use App\Repositories\CryptoRepository;

class CryptoService
{
    private CryptoRepository $cryptoRepository;

    public function __construct()
    {
        $this->cryptoRepository = new ClientCryptoRepository();
    }

    public function execute(string $search, ?string $category = null): CryptoCollection
    {
        // TODO: Add exceptions

        return $this->cryptoRepository->getCrypto($search, $category);
    }
}