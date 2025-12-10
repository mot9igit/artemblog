<?php

namespace App\Http\Controllers\Admin\System\Geo;

use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('admin.system.geo.index');
    }
}
