<?php

namespace App\Http\Controllers\API\Product\Category;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class TreeController extends Controller
{
    public function __invoke(Request $request)
    {
        $categories = ProductCategory::tree()->get();
        foreach($categories as $key => $category){
            $categories[$key]['key'] = $category['id'];
        }
        $tree = $categories->toTree();
        return $tree;
    }
}
