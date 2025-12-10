<?php

namespace App\Http\Controllers\API\System\Geo\Country;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $perpage = $request->input("perpage") ? : 12;
        $filter = $request->input("filter") ? : '';
        if($filter){
            $regions = Country::where('name', 'like', '%'.$filter.'%')->paginate($perpage);
        }else{
            $regions = Country::paginate($perpage);
        }
        return $regions;
    }
}
