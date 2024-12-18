<?php

namespace App\Policies;

use App\enums\RolesEnum;
use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{

    use HandlesAuthorization;

    
    public function create(User $user): bool
    {
        return $user->hasPermissionTo(RolesEnum::ADMIN->value) || $user->hasPermissionTo(RolesEnum::SUPPLIER->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Category $category): bool
    {
        return $user->hasPermissionTo(RolesEnum::ADMIN->value) ||
               ($user->hasPermissionTo(RolesEnum::SUPPLIER->value) && $user->id === $category->supplier_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Category $category): bool
    {
        return $user->hasPermissionTo(RolesEnum::ADMIN->value) ||
               ($user->hasPermissionTo(RolesEnum::SUPPLIER->value) && $user->id === $category->supplier_id);
    }
}
