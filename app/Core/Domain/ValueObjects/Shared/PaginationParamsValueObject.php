<?php

namespace App\Core\Domain\ValueObjects\Shared;

class PaginationParamsValueObject
{
    public function __construct(
        public int $page = 1,
        public int $limit = 20,
    ) {}

    public function skip(): int
    {
        return ($this->page - 1) * $this->limit;
    }

    public function take(): int
    {
        return $this->limit;
    }
}
