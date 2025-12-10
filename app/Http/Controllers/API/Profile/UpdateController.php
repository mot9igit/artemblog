<?php

namespace App\Http\Controllers\API\Profile;

use App\Http\Requests\Admin\Profile\UpdateRequest;

class UpdateController extends BaseController
{
    public function __invoke(UpdateRequest $request)
    {
        $data = $request->validated();
        $response = $this->service->update($data);
        return response()->json(["message" => "success", "data" => $response]);
    }
}
