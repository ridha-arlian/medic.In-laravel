<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(User $user): bool
    {
        return $user->can('ViewAny:Role');
    }

    public function view(User $user, Role $role): bool
    {
        return $user->can('View:Role');
    }

    public function create(User $user): bool
    {
        return $user->can('Create:Role');
    }

    public function update(User $user, Role $role): bool
    {
        return $user->can('Update:Role');
    }

    public function delete(User $user, Role $role): bool
    {
        return $user->can('Delete:Role');
    }

    public function deleteAny(User $user): bool
    {
        return $user->can('DeleteAny:Role');
    }

    public function restore(User $user, Role $role): bool
    {
        return $user->can('{{ Restore }}');
    }

    public function forceDelete(User $user, Role $role): bool
    {
        return $user->can('{{ ForceDelete }}');
    }

    public function forceDeleteAny(User $user): bool
    {
        return $user->can('{{ ForceDeleteAny }}');
    }

    public function restoreAny(User $user): bool
    {
        return $user->can('{{ RestoreAny:User }}');
    }

    public function replicate(User $user, Role $role): bool
    {
        return $user->can('{{ Replicate }}');
    }

    public function reorder(User $user): bool
    {
        return $user->can('{{ Reorder }}');
    }

}