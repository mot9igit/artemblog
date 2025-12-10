<?php

namespace App\Http\Controllers\Admin\Products\Categories;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke()
    {
        return view('admin.product.category.create');
    }
}
