<?php

namespace App\Http\Controllers\Admin\Products\Categories;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke()
    {
        $categories = ProductCategory::all();
        return view("admin.product.category.index", ["categories" => $categories]);
    }
}
