<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\SiteController;
use App\Models\Currency;

Route::get('/', [SiteController::class, 'viewHome']);

Route::get('/get-rates', function(Request $request) {
    $apiKey = env('CURRENCY_API_KEY');
    $baseCurrency = $request->query('baseCurrency');
    $rates = Currency::getRates($apiKey, $baseCurrency);
    return response()->json($rates);
});
