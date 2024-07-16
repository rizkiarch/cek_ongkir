<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fileKota = file_get_contents(base_path('/database/kota.json'));
        $dataKota = json_decode($fileKota, true);
        $fileKab = file_get_contents(base_path('/database/kabupaten.json'));
        $dataKab = json_decode($fileKab, true);

        City::insert($dataKota);
        City::insert($dataKab);
    }
}
