<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Arr;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $data = [];
    protected $uploadsFolder = 'uploads/';

    protected $rajaOngkirApiKey = null;
    protected $rajaOngkirBaseUrl = null;
    protected $rajaOngkirOrigin = null;
    protected $couriers = [
        'jne' => 'JNE',
        'pos' => 'POS Indonesia',
        'tiki' => 'Titipan Kilat'
    ];

    protected $provinces = [];

    public function __construct() {
        $this->rajaOngkirApiKey = env('RAJAONGKIR_API_KEY');
        $this->rajaOngkirBaseUrl = env('RAJAONGKIR_BASE_URL');
        $this->rajaOngkirOrigin = env('RAJAONGKIR_ORIGIN');
        
        $this->initAdminMenu();
    }

    private function initAdminMenu(){
        $this->data['currentAdminMenu'] = 'dashboard';
        $this->data['currentAdminSubMenu'] = '';
    }

    protected function load_theme($view, $data = [])
    {
        return view('themes/'. env('APP_THEME') .'/'. $view, $data);
    }

    protected function rajaOngkirRequest($resource, $params = [], $method = 'GET')
    {
        $client = new \GuzzleHttp\Client();

        $headers = ['key' => $this->rajaOngkirApiKey];
        $requestParams = [
            'headers' => $headers,
        ];
        $url = $this->rajaOngkirBaseUrl . $resource;
        if ($params && $method == 'POST') {
            $requestParams['form_params'] = $params;
        } else if ($params && $method == 'GET') {
            $query = is_array($params) ? '?'.http_build_query($params) : '';
            $url = $this->rajaOngkirBaseUrl . $resource . $query;
        }
        $response = $client->request($method, $url, $requestParams);
        return json_decode($response->getBody(), true);
    }
    //api rajaongkir yang dipakai hanya data kota dan provinsi
    protected function getProvinces()
    {
        $provinceFile = 'provinces.txt';
        $provinceFilePath = $this->uploadsFolder. 'files/' . $provinceFile;

        $isExistProvinceJson = \Storage::disk('local')->exists($provinceFilePath);

        if (!$isExistProvinceJson){
            $response = $this->rajaOngkirRequest('province');
            \Storage::disk('local')->put($provinceFilePath, serialize($response['rajaongkir']['results']));
        }

        $province = unserialize(\Storage::get($provinceFilePath));
        $provinces2 = data_get($province, '5');
        // dd($provinces2);
        $provinces = [];
        if(!empty($provinces2)) {
            foreach($province as $province){
                $provinces[$provinces2['province_id']] = strtoupper($provinces2['province']);
            }
        }
        return $provinces;
    }
    //data provinsi

    protected function getCities($provinceId){
        $cityFile = 'cities_at_'. $provinceId .'.txt';
        $cityFilePath = $this->uploadsFolder. 'files/' .$cityFile;
        $isExistCitiesJson = \Storage::disk('local')->exists($cityFilePath);

        if (!$isExistCitiesJson){
            $response = $this->rajaOngkirRequest('city', ['province' => $provinceId]);
            \Storage::disk('local')->put($cityFilePath, serialize($response['rajaongkir']['results']));
        }

        $cityList = unserialize(\Storage::get($cityFilePath));
        $cityList2 = Arr::except($cityList, '5');
        $cities = [];
        if(!empty($cityList2)){
            foreach($cityList2 as $city){
                 $cities[$city['city_id']] = strtoupper($city['type'].' '.$city['city_name']);
            }
        }
        return $cities;
    }
    //data kota berdasarkan province berbentuk array

    protected function initPaymentGateway()
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
    }
    //memanggil api midtrans
}
