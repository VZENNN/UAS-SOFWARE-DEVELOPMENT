<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class RajaOngkirService
{
    protected $apiKey;
    protected $baseUrl;
    protected $origin;

    public function __construct()
    {
        $this->apiKey = env('RAJAONGKIR_API_KEY', '');
        $this->origin = env('RAJAONGKIR_ORIGIN', 501);
        
        // Pilih URL berdasarkan tipe akun
        $accountType = env('RAJAONGKIR_PACKAGE', 'starter');
        if ($accountType == 'starter') {
            $this->baseUrl = 'https://api.rajaongkir.com/starter';
        } elseif ($accountType == 'basic') {
            $this->baseUrl = 'https://api.rajaongkir.com/basic';
        } elseif ($accountType == 'pro') {
            $this->baseUrl = 'https://pro.rajaongkir.com/api';
        }
    }

    public function getProvinces()
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get($this->baseUrl . '/province');

        if ($response->successful()) {
            $data = $response->json();
            return $data['rajaongkir']['results'];
        }

        return [];
    }

    public function getCities($provinceId = null)
    {
        $url = $this->baseUrl . '/city';
        $params = [];
        
        if ($provinceId) {
            $params['province'] = $provinceId;
        }

        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->get($url, $params);

        if ($response->successful()) {
            $data = $response->json();
            return $data['rajaongkir']['results'];
        }

        return [];
    }

    public function checkShippingCost($destination, $weight, $courier)
    {
        $response = Http::withHeaders([
            'key' => $this->apiKey
        ])->post($this->baseUrl . '/cost', [
            'origin' => $this->origin,
            'destination' => $destination,
            'weight' => $weight,
            'courier' => $courier
        ]);

        if ($response->successful()) {
            $data = $response->json();
            return $data['rajaongkir']['results'];
        }

        return [];
    }
} 