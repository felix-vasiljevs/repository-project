<?php

namespace App\Controllers;

use App\Services\CryptoCurrencies\ListCryptoService;
use App\Session;
use App\Template;

class CryptoController
{
    public function index(): Template
    {

    $search = $_GET['search'] ?? ['BTC', 'ETH', 'XRP', 'LTC', 'BCH', 'BNB', 'EOS', 'BSV', 'XLM', 'ADA'];
        $service = new ListCryptoService();
        $cryptoCurrencies = $service->execute($search);

        return new Template(
            '/crypto/crypto.twig',
            [
                'cryptoCurrencies' => $cryptoCurrencies->all(),
                'search' => $search
            ]
        );
    }
}