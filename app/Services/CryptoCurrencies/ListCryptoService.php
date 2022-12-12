<?php

namespace App\Services\CryptoCurrencies;

use App\Models\Collections\CryptoCollection;
use App\Repositories\CoinMarketCapCryptoRepository;
use App\Repositories\CryptoRepository;

class ListCryptoService
{
    private CryptoRepository $cryptoRepository;

    public function __construct()
    {
        $this->cryptoRepository= new CoinMarketCapCryptoRepository();
    }

    public function execute(array $symbols): CryptoCollection
    {
        return $this->cryptoRepository->findAllSymbols($symbols);
    }
}