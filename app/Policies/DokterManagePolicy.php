<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Dokter;
use Illuminate\Auth\Access\HandlesAuthorization;

class DokterManagePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user): bool
    {
        return $user->can('ViewAny:DokterManage');
    }

    public function view(User $user, Dokter $dokter): bool
    {
        return $user->can('View:DokterManage');
    }

    public function create(User $user): bool
    {
        return $user->can('Create:DokterManage');
    }

    public function update(User $user, Dokter $dokter): bool
    {
        return $user->can('Update:DokterManage');
    }

    public function delete(User $user, Dokter $dokter): bool
    {
        if ($user->id === $dokter->user_id) {
            return false;
        }

        return $user->can('Delete:DokterManage');
    }

    public function restore(User $user, Dokter $dokter): bool
    {
        return $user->can('Restore:DokterManage');
    }

    public function forceDelete(User $user, Dokter $dokter): bool
    {
        return $user->can('ForceDelete:DokterManage');
    }
}