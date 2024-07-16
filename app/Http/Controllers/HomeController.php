<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Courier;
use App\Models\Province;
use App\Traits\RajaongkirTraits;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    use RajaongkirTraits;

    public function index()
    {
        $province =  $this->getProvince();
        $courier = $this->getCourier();
        // return view('cek_ongkir', compact('province', 'courier'));
        return view('cek_ongkir', [
            'province' => $province,
            'courier' => $courier,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'asal_provinsi' => 'required',
            'asal_kab' => 'required',
            'tujuan_provinsi' => 'required',
            'tujuan_kab' => 'required',
            'courier' => 'required|array',
            'weight' => 'required|numeric',
        ]);

        $origin = $request->input('asal_kab');
        $destination = $request->input('tujuan_kab');
        $weight = $request->input('weight');
        $couriers = $request->input('courier');
        $results = [];
        foreach ($couriers as $courier) {
            $response = $this->getOngkir($origin, $destination, $weight, $courier);
            $results[] = json_decode($response, true);
        }
        // dd($results);
        // return response()->json(json_decode($response, true));
        // return view('harga_ongkir', [
        //     'results' => $results,
        // ]);
        // Mengembalikan hasil dalam bentuk JSON
        return response()->json([
            'results' => $results,
        ]);
    }

    public function result()
    {
        return view('harga_ongkir');
    }

    public function getCourier()
    {
        return Courier::all();
    }

    public function getProvince()
    {
        return Province::pluck('title', 'code');
    }

    public function getCities($id)
    {
        return City::where('province_code', $id)->pluck('title', 'code');
    }

    public function searchCities(Request $request)
    {
        $search = $request->search;

        if (empty($search)) {
            $cities = City::orderBy('title', 'asc')
                ->select('id', 'title')
                ->limit(5)
                ->get();
        } else {
            $cities = City::orderBy('title', 'asc')
                ->where('title', 'like', '%' . $search . '%')
                ->select('id', 'title')
                ->limit(4)
                ->get();
        }

        $response = [];
        foreach ($cities as $city) {
            $response[] = [
                'id' => $city->id,
                'text' => $city->title
            ];
        }

        return json_encode($response);
    }
}
