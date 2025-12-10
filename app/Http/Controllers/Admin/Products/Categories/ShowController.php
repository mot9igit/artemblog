<?php

namespace App\Http\Controllers\Admin\Products\Categories;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function __invoke(ProductCategory $category)
    {
        return view('admin.product.category.show', ["category" => $category]);
    }
}
