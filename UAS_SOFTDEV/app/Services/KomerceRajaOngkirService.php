<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class KomerceRajaOngkirService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('komerce.api_key');
        $this->baseUrl = config('komerce.base_url');
    }

    public function getProvinces()
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])->get($this->baseUrl . '/provinces');

        return $response->json();
    }

    public function getCities($provinceId)
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])->get($this->baseUrl . '/cities?province_id=' . $provinceId);

        return $response->json();
    }

    public function getShippingCost($originCityId, $destinationCityId, $courier, $weightInGram)
    {
        $response = Http::withHeaders([
            'x-api-key' => $this->apiKey,
        ])->post($this->baseUrl . '/shipping-cost', [
            'origin' => $originCityId,
            'destination' => $destinationCityId,
            'courier' => $courier,
            'weight' => $weightInGram,
        ]);

        return $response->json();
    }
}
