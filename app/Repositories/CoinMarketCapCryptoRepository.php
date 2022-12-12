<?php

namespace App\Repositories;

use App\Models\Collections\CryptoCollection;
use App\Models\Crypto;
use GuzzleHttp\Client;

class CoinMarketCapCryptoRepository implements CryptoRepository
{
    private const API_URL = 'https://pro-api.coinmarketcap.com/v1/cryptocurrency/quotes/latest';
    private Client $httpClient;

    public function __construct()
    {
        $this->httpClient = new Client(['base_uri' => self::API_URL]);
    }

    public function findAllSymbols(array $symbols): CryptoCollection
    {
        $url = self::API_URL;
        $parameters = [
            'symbol' => implode(',', $symbols),
            'convert' => 'USD'
        ];

        $headers = [
            'Accepts: application/json',
            'X-CMC_PRO_API_KEY: ' . $_ENV['API_KEY']
        ];
        $qs = http_build_query($parameters); // query string encode the parameters
        $request = "{$url}?{$qs}"; // create the request URL


        $curl = curl_init(); // Get cURL resource
        // Set cURL options
        curl_setopt_array($curl, [
            CURLOPT_URL => $request,            // set the request URL
            CURLOPT_HTTPHEADER => $headers,     // set the headers
            CURLOPT_RETURNTRANSFER => 1         // ask for raw response instead of bool
        ]);

        $response = curl_exec($curl); // Send the request, save the response
        $response = json_decode($response);    // print json decoded response
        curl_close($curl); // Close request


        $cryptoCurrencies = new CryptoCollection();

        foreach ($response->data as $currency) {
            $cryptoCurrencies->add(
                new Crypto(
                    $currency->symbol,
                    $currency->name,
                    $currency->quote->USD->price,
                    $currency->quote->USD->percent_change_1h,
                    $currency->quote->USD->percent_change_24h,
                    $currency->quote->USD->percent_change_7d,
                )
            );
        }
        return $cryptoCurrencies;
    }
}