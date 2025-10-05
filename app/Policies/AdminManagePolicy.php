<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminManagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('ViewAny:AdminManage');
    }

    public function view(User $user, User $admin): bool
    {
        return $user->can('View:AdminManage');
    }

    public function create(User $user): bool
    {
        return $user->can('Create:AdminManage');
    }

    public function update(User $user, User $admin): bool
    {
        return $user->can('Update:AdminManage');
    }

    public function delete(User $user, User $admin): bool
    {
        if ($user->id === $admin->id) {
            return false;
        }

        return $user->can('Delete:AdminManage');
    }

    public function restore(User $user, User $admin): bool
    {
        return $user->can('Restore:AdminManage');
    }

    public function forceDelete(User $user, User $admin): bool
    {
        return $user->can('ForceDelete:AdminManage');
    }
}