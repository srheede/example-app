<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    public static function getRates($apiKey, $baseCurrency)
    {
        $url = "https://www.completeapi.com/v1/{$apiKey}/currency/{$baseCurrency}";

        $response = file_get_contents($url);
        $data = json_decode($response, true);

        if (isset($data['forex'])) {
            return $data['forex'];
        } else {
            return null;
        }
    }
}
