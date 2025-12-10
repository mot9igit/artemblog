<?php

namespace App\Http\Controllers\API\System\Geo\City;

use App\Http\Requests\Admin\Geo\City\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $city = $this->service->store($data);
        return $city;
    }
}
