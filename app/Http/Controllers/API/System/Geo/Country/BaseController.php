<?php

namespace App\Http\Controllers\API\System\Geo\Country;

use App\Http\Controllers\Controller;
use App\Services\Geo\Region\Service;

class BaseController
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
