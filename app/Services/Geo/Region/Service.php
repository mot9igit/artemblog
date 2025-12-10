<?php

namespace App\Services\Geo\Region;

use App\Models\Region;

class Service
{
    public function store($data){
        $region = Region::firstOrCreate($data);
        return $region;
    }

    public function update($region, $data){
        $region = $region->update($data);
        return $region;
    }
}
