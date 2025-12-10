<?php

namespace App\Http\Controllers\API\System\Geo\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $perpage = $request->input("perpage") ? : 12;
        $filter = $request->input("filter") ? : '';
        if($filter){
            $cities = City::where('name', 'like', '%'.$filter.'%')->paginate($perpage);
        }else{
            $cities = City::paginate($perpage);
        }
        return $cities;
    }
}
