<?php

namespace App\Http\Controllers\API\System\Geo\Region;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $perpage = $request->input("perpage") ? : 12;
        $filter = $request->input("filter") ? : '';
        if($filter){
            $regions = Region::where('name', 'like', '%'.$filter.'%')->paginate($perpage);
        }else{
            $regions = Region::paginate($perpage);
        }
        return $regions;
    }
}
