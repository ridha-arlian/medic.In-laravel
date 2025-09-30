<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\MedicineSupplier;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicineSupplierPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MedicineSupplier');
    }

    public function view(AuthUser $authUser, MedicineSupplier $medicineSupplier): bool
    {
        return $authUser->can('View:MedicineSupplier');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MedicineSupplier');
    }

    public function update(AuthUser $authUser, MedicineSupplier $medicineSupplier): bool
    {
        return $authUser->can('Update:MedicineSupplier');
    }

    public function delete(AuthUser $authUser, MedicineSupplier $medicineSupplier): bool
    {
        return $authUser->can('Delete:MedicineSupplier');
    }

    public function restore(AuthUser $authUser, MedicineSupplier $medicineSupplier): bool
    {
        return $authUser->can('Restore:MedicineSupplier');
    }

    public function forceDelete(AuthUser $authUser, MedicineSupplier $medicineSupplier): bool
    {
        return $authUser->can('ForceDelete:MedicineSupplier');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MedicineSupplier');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MedicineSupplier');
    }

    public function replicate(AuthUser $authUser, MedicineSupplier $medicineSupplier): bool
    {
        return $authUser->can('Replicate:MedicineSupplier');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MedicineSupplier');
    }

}