<?php

namespace App\Presentation\Controllers\Web\Admin;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

class ProfileController
{
    public function findAll(): View
    {
        return view('admin.profile.index');
    }

    public function findMy(): View
    {
        return view('front.profile.index');
    }

    public function findMyAdmin(): View
    {
        return view('admin.profile.index');
    }
}
