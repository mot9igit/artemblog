<?php

namespace App\Http\Controllers\API\Product\Category;

use App\Http\Requests\Admin\Product\Category\StoreRequest;
use App\Models\ProductCategory;

class StoreController extends BaseController
{
    public function __invoke(StoreRequest $request)
    {
        $data = $request->validated();
        $category = $this->service->store($data);
        return $category;
    }
}
