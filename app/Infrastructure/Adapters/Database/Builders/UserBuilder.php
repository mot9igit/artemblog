<?php

namespace App\Infrastructure\Adapters\Database\Builders;

use App\Core\Domain\ValueObjects\Modules\User\UserFiltersValueObject;
use Illuminate\Database\Eloquent\Builder;

class UserBuilder
{
    public static function build(Builder $query, UserFiltersValueObject $filters): void
    {
        if ($filters->search !== null) {
            $search = '%' . $filters->search . '%';
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', $search)
                    ->orWhere('email', 'like', $search)
                    ->orWhere('phone', 'like', $search)
                    ->orWhere('fullname', 'like', $search);
            });
        }

        if ($filters->name !== null) {
            $query->where('name', 'like', '%' . $filters->name . '%');
        }

        if ($filters->email !== null) {
            $query->where('email', 'like', '%' . $filters->email . '%');
        }

        if ($filters->active !== null) {
            $query->where('active', $filters->active);
        }
    }
}
