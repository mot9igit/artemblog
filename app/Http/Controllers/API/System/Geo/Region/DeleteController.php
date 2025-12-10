<?php

namespace App\Http\Controllers\API\System\Geo\Region;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function __invoke(Region $region)
    {
        DB::beginTransaction();
        try{
            $response = $region->delete();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $response = $e->getMessage();
        }
        return $response;
    }
}
