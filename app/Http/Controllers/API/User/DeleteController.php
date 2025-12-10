<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DeleteController extends Controller
{
    public function __invoke(User $user)
    {
        DB::beginTransaction();
        try{
            $response = $user->delete();
            DB::commit();
        }catch(\Exception $e){
            DB::rollback();
            $response = $e->getMessage();
        }
        return $response;
    }
}
