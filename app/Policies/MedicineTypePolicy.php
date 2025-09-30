<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\MedicineType;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicineTypePolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MedicineType');
    }

    public function view(AuthUser $authUser, MedicineType $medicineType): bool
    {
        return $authUser->can('View:MedicineType');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MedicineType');
    }

    public function update(AuthUser $authUser, MedicineType $medicineType): bool
    {
        return $authUser->can('Update:MedicineType');
    }

    public function delete(AuthUser $authUser, MedicineType $medicineType): bool
    {
        return $authUser->can('Delete:MedicineType');
    }

    public function restore(AuthUser $authUser, MedicineType $medicineType): bool
    {
        return $authUser->can('Restore:MedicineType');
    }

    public function forceDelete(AuthUser $authUser, MedicineType $medicineType): bool
    {
        return $authUser->can('ForceDelete:MedicineType');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MedicineType');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MedicineType');
    }

    public function replicate(AuthUser $authUser, MedicineType $medicineType): bool
    {
        return $authUser->can('Replicate:MedicineType');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MedicineType');
    }

}