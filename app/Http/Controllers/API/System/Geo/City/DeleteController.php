<?php

namespace App\Http\Controllers\API\System\Geo\City;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function __invoke(City $city)
    {
        DB::beginTransaction();
        try{
            $response = $city->delete();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $response = $e->getMessage();
        }
        return $response;
    }
}
