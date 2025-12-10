<?php

namespace App\Http\Controllers\API\Product\Category;

use App\Http\Controllers\Controller;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function __invoke(ProductCategory $category)
    {
        DB::beginTransaction();
        try{
            $response = $category->delete();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $response = $e->getMessage();
        }
        return $response;
    }
}
