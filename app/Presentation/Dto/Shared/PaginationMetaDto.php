<?php

namespace App\Presentation\Dto\Shared;
class PaginationMetaDto
{
    public function __construct(
        public int  $page,
        public int  $total,
        public int  $limit,
        public int  $totalPages,
        public bool $hasNext,
        public bool $hasPrev
    )
    {
    }
}

