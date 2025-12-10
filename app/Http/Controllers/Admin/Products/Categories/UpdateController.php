<?php

namespace App\Http\Controllers\Admin\Products\Categories;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\Category\UpdateRequest;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, ProductCategory $category)
    {
        $data = $request->validated();
        $category->update($data);
        return redirect()->route("admin.category.show", ["category" => $category]);
    }
}
