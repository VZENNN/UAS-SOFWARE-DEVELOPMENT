<?php
// config for Kodepandai/LaravelRajaOngkir
return [
    /*
    |--------------------------------------------------------------------------
    | Raja Ongkir API Key
    |--------------------------------------------------------------------------
    |
    | Masukkan API Key RajaOngkir Anda
    |
    */
    'api_key' => env('RAJAONGKIR_API_KEY', ''),

    /*
    |--------------------------------------------------------------------------
    | Raja Ongkir Package
    |--------------------------------------------------------------------------
    |
    | Package RajaOngkir yang digunakan: starter, basic, atau pro
    |
    */
    'package' => env('RAJAONGKIR_PACKAGE', 'starter'),

    /*
    |--------------------------------------------------------------------------
    | Origin City ID
    |--------------------------------------------------------------------------
    |
    | ID kota asal pengiriman (lokasi toko)
    |
    */
    'origin' => env('RAJAONGKIR_ORIGIN', 501), // Default: Jakarta Pusat
];
