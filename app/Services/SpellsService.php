<?php

namespace App\Services;

use Carbon\Carbon;

class SpellsService
{
    public function getSpells()
    {
        $today = Carbon::now()->toDateString();

        $httpClient = new \GuzzleHttp\Client();
    $request = $httpClient
                ->get("https://hp-api.onrender.com/api/spells");

        $response = json_decode($request->getBody()->getContents());

        return $response;
    }
}