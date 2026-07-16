<?php


namespace App\Presentation\Dto\Shared;

/**
 * @template T
 */
class PaginatedResponseDto
{
    public function __construct(
        public array             $data,
        public PaginationMetaDto $meta
    )
    {
    }
}
