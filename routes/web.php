<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);
Route::get('/api/province/{id}/cities', [HomeController::class, 'getCities']);
Route::post('/api/cities', [HomeController::class, 'searchCities']);
Route::post('/store', [HomeController::class, 'store'])->name('store');
Route::get('/harga_ongkir', [HomeController::class, 'store'])->name('harga_ongkir');
