<?php

namespace App\Presentation\Utils;

use App\Core\Domain\ValueObjects\Shared\PaginatedResultValueObject;
use App\Presentation\Dto\Shared\PaginationMetaDto;
use App\Presentation\Dto\Shared\PaginatedResponseDto;

class PaginationFormatterUtil
{
    /**
     * @template T
     * @template R
     * @param PaginatedResultValueObject<T> $paginatedResult
     * @param callable(T): R $mapper
     * @return PaginatedResponseDto<R>
     */
    public static function format(
        PaginatedResultValueObject $paginatedResult,
        callable $mapper
    ): PaginatedResponseDto {
        $data = array_map($mapper, $paginatedResult->data);

        $meta = new PaginationMetaDto(
            page: $paginatedResult->params->page,
            total: $paginatedResult->total,
            limit: $paginatedResult->params->limit,
            totalPages: $paginatedResult->getTotalPages(),
            hasNext: $paginatedResult->hasNext(),
            hasPrev: $paginatedResult->hasPrev()
        );

        return new PaginatedResponseDto($data, $meta);
    }
}
