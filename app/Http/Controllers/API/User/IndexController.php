<?php

namespace App\Http\Controllers\API\User;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function __invoke(Request $request)
    {
        $perpage = $request->input("perpage") ? : 12;
        $filter = $request->input("filter") ? : '';
        if($filter){
            $users = User::where('name', 'like', '%'.$filter.'%')->where('email', 'like', '%'.$filter.'%')->paginate($perpage);
        }else{
            $users = User::paginate($perpage);
        }
        return $users;
    }
}
