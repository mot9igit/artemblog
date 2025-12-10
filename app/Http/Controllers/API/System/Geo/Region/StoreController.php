<?php

namespace App\Http\Controllers\API\System\Geo\Region;

use App\Http\Requests\Admin\Geo\Region\StoreRequest;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $region = $this->service->store($data);
        return $region;
    }
}
