<?php

namespace App\Models\Builders;

use App\Classes\Filter\UseFilter;
use App\Models\Filters\ActiveFilter;
use App\Models\Filters\CreatedAtDateRangeFilter;
use App\Models\Filters\User\RoleFilter;

class UserBuilder extends BaseBuilder
{
    use UseFilter;

    public function filters(): array
    {
        return [
            new RoleFilter(fn($role) => $this->hasRole($role)),
            new ActiveFilter(fn($active) => $this->isActive($active)),
            new CreatedAtDateRangeFilter(fn($date) => $this->createdAtRange($date)),
        ];
    }


    final public function hasRole(?int $role): static
    {
        return $this->when($role, function($q) use ($role) {
            $q->whereHas('roles', fn($z) => $z->where('roles.id', $role));
        });
    }
}
