<?php

namespace App\Core\Domain\Aggregates;

use App\Core\Domain\Entities\UserEntity;

class UserAggregate
{
    public function __construct(
        public UserEntity $userEntity,
    ) {}
}
