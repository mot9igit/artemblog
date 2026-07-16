<?php

namespace App\Core\Domain\ValueObjects\Shared;

readonly class PaginatedResultValueObject
{
    public function __construct(
        public array                       $data,
        public int                         $total,
        public PaginationParamsValueObject $params,
    ) {}

    public function getTotalPages(): int
    {
        return (int)ceil($this->total / $this->params->limit);
    }

    public function hasNext(): bool
    {
        return $this->params->page < $this->getTotalPages();
    }

    public function hasPrev(): bool
    {
        return $this->params->page > 1;
    }
}
