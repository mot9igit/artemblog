<?php

namespace App\Http\Controllers\API\Product\Category;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $perpage = $request->input("perpage") ? : 12;
        $filter = $request->input("filter") ? : '';
        if($filter){
            $categories = ProductCategory::where('title', 'like', '%'.$filter.'%')->paginate($perpage);
        }else{
            $categories = ProductCategory::paginate($perpage);
        }
        return $categories;
    }
}
