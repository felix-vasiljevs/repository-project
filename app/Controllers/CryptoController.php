<?php

namespace App\Controllers;

use App\Services\CryptoService;
use App\Template;

class CryptoController
{
    public function index(): Template
    {
        $search = $_GET['search'] ?? '';

        $category = $_GET['category'] ?? '';

        $crypto = (new CryptoService())->execute($search, $category);

        return new Template(
            '/crypto/crypto.twig',
            [
                'crypto' => $crypto->getCrypto(),
                'search' => $search,
                'category' => $category,
            ]
        );
    }
}