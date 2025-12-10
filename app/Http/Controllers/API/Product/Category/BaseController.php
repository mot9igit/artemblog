<?php

namespace App\Http\Controllers\API\Product\Category;

use App\Http\Controllers\Controller;
use App\Services\ProductCategory\Service;

class BaseController
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
