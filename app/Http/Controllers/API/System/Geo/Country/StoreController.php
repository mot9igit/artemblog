<?php

namespace App\Http\Controllers\API\System\Geo\Country;

use App\Http\Requests\Admin\Geo\Country\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $country = $this->service->store($data);
        return $country;
    }
}
