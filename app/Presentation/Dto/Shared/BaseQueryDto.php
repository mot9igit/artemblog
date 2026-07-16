<?php

namespace App\Presentation\Dto\Shared;
class BaseQueryDto
{
    public function __construct(
        public int $limit = 20,
        public int $page = 1
    )
    {

    }
}
