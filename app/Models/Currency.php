<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class Currency extends Model
{
    public static function getRates($apiKey, $baseCurrency)
    {
        $cacheKey = 'forex_' . $baseCurrency;

        if (Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        } else {
            $url = "https://www.completeapi.com/v1/{$apiKey}/currency/{$baseCurrency}";

            $response = file_get_contents($url);
            $data = json_decode($response, true);

            if (isset($data['forex'])) {
                Cache::put($cacheKey, $data['forex'], now()->addHour());
                return $data['forex'];
            } else {
                return null;
            }
        }
    }

}
