<?php

namespace App\Http\Controllers\Admin\Products\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\Category\StoreRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)
    {
        // dd($request);
        $data = $request->validated();
        $category = ProductCategory::firstOrCreate($data);
        return redirect()->route('admin.product.category.index');
    }
}
