<?php

namespace App\Http\Controllers\API\Profile;

use App\Models\User;

class ShowController extends BaseController
{
    public function __invoke(User $user)
    {
        return $user;
    }
}
