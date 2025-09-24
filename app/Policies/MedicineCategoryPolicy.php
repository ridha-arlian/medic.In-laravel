<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\MedicineCategory;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicineCategoryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:MedicineCategory');
    }

    public function view(AuthUser $authUser, MedicineCategory $medicineCategory): bool
    {
        return $authUser->can('View:MedicineCategory');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:MedicineCategory');
    }

    public function update(AuthUser $authUser, MedicineCategory $medicineCategory): bool
    {
        return $authUser->can('Update:MedicineCategory');
    }

    public function delete(AuthUser $authUser, MedicineCategory $medicineCategory): bool
    {
        return $authUser->can('Delete:MedicineCategory');
    }

    public function restore(AuthUser $authUser, MedicineCategory $medicineCategory): bool
    {
        return $authUser->can('Restore:MedicineCategory');
    }

    public function forceDelete(AuthUser $authUser, MedicineCategory $medicineCategory): bool
    {
        return $authUser->can('ForceDelete:MedicineCategory');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:MedicineCategory');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:MedicineCategory');
    }

    public function replicate(AuthUser $authUser, MedicineCategory $medicineCategory): bool
    {
        return $authUser->can('Replicate:MedicineCategory');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:MedicineCategory');
    }

}