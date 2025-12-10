<?php

namespace App\Services\Geo\City;

use App\Models\City;

class Service
{
    public function store($data){
        $city = City::firstOrCreate($data);
        return $city;
    }

    public function update($city, $data){
        $city = $city->update($data);
        return $city;
    }
}
