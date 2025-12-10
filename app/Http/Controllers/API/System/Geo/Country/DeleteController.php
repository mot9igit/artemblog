<?php

namespace App\Http\Controllers\API\System\Geo\Country;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function __invoke(Country $country)
    {
        DB::beginTransaction();
        try{
            $response = $country->delete();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $response = $e->getMessage();
        }
        return $response;
    }
}
