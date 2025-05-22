<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class OngkirController extends Controller
{

    public function getAllProvinces()
    {
        $province = Province::all();
        return response()->json($province);
    }

    public function getCitiesByProvince($id)
    {
        $city = City::where('province_id', $id)->get();
        return response()->json($city);
    }

    public function getOngkirServices(Request $request)
    {
        $origin = 152; 
        $destination = $request->destination;
        $courier = $request->courier;

        $response = Http::withHeaders([
            'key' => env('RAJAONGKIR_API_KEY') 
        ])->post('https://api.rajaongkir.com/starter/cost', [
            'origin' => $origin,
            'destination' => $destination,
            'weight' => 1000,
            'courier' => $courier,
        ]);

        $services = $response['rajaongkir']['results'][0]['costs'];
        return response()->json($services);
    }
}
