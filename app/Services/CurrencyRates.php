<?php

namespace App\Services;

use GuzzleHttp\Client;

class CurrencyRates
{

    public static function getRates()
    {
        $baseCurrency = CurrencyConversion::getBaseCurrency();

        $url = config('currency_rates.api_url') . '?base_currency=' . $baseCurrency->code .
            '&apikey=' . config('currency_rates.api_key') . '&currencies=' . 'EUR,USD';

        $client = new Client();

        $response = $client->request('GET', $url);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('There is a problem with currency rate service');
        }

        $data = json_decode($response->getBody()->getContents(), true)['data'];
        // dd($data);

        foreach (CurrencyConversion::getCurrencies() as $currency) {
            if (!$currency->isMain()) {
                if (!isset($data[$currency->code])) {
                    throw new \Exception('There is a problem with currency ' . $currency->code);
                } else {
                    $currency->update(['rate' => round(1 / $data[$currency->code]['value'], 2)]);
                    // $currency->touch();
                }
            }
        }
    }

}
