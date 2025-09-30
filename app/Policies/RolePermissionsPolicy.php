<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\RolePermissions;
use Illuminate\Auth\Access\HandlesAuthorization;

class RolePermissionsPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:RolePermissions');
    }

    public function view(AuthUser $authUser, RolePermissions $rolePermissions): bool
    {
        return $authUser->can('View:RolePermissions');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:RolePermissions');
    }

    public function update(AuthUser $authUser, RolePermissions $rolePermissions): bool
    {
        return $authUser->can('Update:RolePermissions');
    }

    public function delete(AuthUser $authUser, RolePermissions $rolePermissions): bool
    {
        return $authUser->can('Delete:RolePermissions');
    }

    public function restore(AuthUser $authUser, RolePermissions $rolePermissions): bool
    {
        return $authUser->can('Restore:RolePermissions');
    }

    public function forceDelete(AuthUser $authUser, RolePermissions $rolePermissions): bool
    {
        return $authUser->can('ForceDelete:RolePermissions');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:RolePermissions');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:RolePermissions');
    }

    public function replicate(AuthUser $authUser, RolePermissions $rolePermissions): bool
    {
        return $authUser->can('Replicate:RolePermissions');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:RolePermissions');
    }

}