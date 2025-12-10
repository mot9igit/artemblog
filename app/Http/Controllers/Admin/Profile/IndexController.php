<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('admin.profile.index');
    }
}
