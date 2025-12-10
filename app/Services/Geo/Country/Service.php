<?php

namespace App\Services\Geo\Country;

use App\Models\Country;

class Service
{
    public function store($data){
        $country = Country::firstOrCreate($data);
        return $country;
    }

    public function update($country, $data){
        $country = $country->update($data);
        return $country;
    }
}
