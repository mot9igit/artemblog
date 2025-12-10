<?php

namespace App\Http\Controllers\API\System\Geo\City;

use App\Http\Controllers\Controller;
use App\Services\Geo\City\Service;

class BaseController
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
