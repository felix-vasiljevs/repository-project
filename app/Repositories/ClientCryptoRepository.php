<?php

namespace App\Repositories;

use App\Models\Collections\CryptoCollection;
use App\Models\Crypto;
use Finnhub\Api\DefaultApi;

class ClientCryptoRepository implements CryptoRepository
{
    private DefaultApi $apiKey;

    public function __construct()
    {
        $this->apiKey = new DefaultApi($_ENV['API_KEY']);
    }

    public function getCrypto(string $search, ?string $category = null): CryptoCollection
    {
        $cryptoResponse = $this->findCrypto($search, $category);

        $cryptoCollection = new CryptoCollection();
        $count = 0;
        foreach ($cryptoResponse->cryptoCollection as $money) {
            if ($count < 10) {
                $cryptoCollection->add(new Crypto(
                    $money->name,
                    $money->currentPrice,
                    $money->percentChange,
                    $money->highPrice,
                    $money->lowPrice
                ));
            }
            $count++;
        }
        return $cryptoCollection;
    }

    private function findCrypto(string $search, ): string
    {
        if (!$search) {
            return $this->apiKey->quote($search);
        }

        return $this->apiKey->quote($search);
//        $client->quote('AAPL')

//        $apiInstance = new DefaultApi();
//        $response = $apiInstance->cryptoCandles($search, 'D', 1590988249, 1591852249, $this->apiKey);
    }
}
{

}