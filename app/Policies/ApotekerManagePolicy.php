<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Apoteker;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApotekerManagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('ViewAny:ApotekerManage');
    }

    public function view(User $user, Apoteker $apoteker): bool
    {
        return $user->can('View:ApotekerManage');
    }

    public function create(User $user): bool
    {
        return $user->can('Create:ApotekerManage');
    }

    public function update(User $user, Apoteker $apoteker): bool
    {
        return $user->can('Update:ApotekerManage');
    }

    public function delete(User $user, Apoteker $apoteker): bool
    {
        if ($user->id === $apoteker->user_id) {
            return false;
        }

        return $user->can('Delete:ApotekerManage');
    }

    public function restore(User $user, Apoteker $apoteker): bool
    {
        return $user->can('Restore:ApotekerManage');
    }

    public function forceDelete(User $user, Apoteker $apoteker): bool
    {
        return $user->can('ForceDelete:ApotekerManage');
    }
}