<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\PatientList;
use Illuminate\Auth\Access\HandlesAuthorization;

class PatientListPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:PatientList');
    }

    public function view(AuthUser $authUser, PatientList $patientList): bool
    {
        return $authUser->can('View:PatientList');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:PatientList');
    }

    public function update(AuthUser $authUser, PatientList $patientList): bool
    {
        return $authUser->can('Update:PatientList');
    }

    public function delete(AuthUser $authUser, PatientList $patientList): bool
    {
        return $authUser->can('Delete:PatientList');
    }

    public function restore(AuthUser $authUser, PatientList $patientList): bool
    {
        return $authUser->can('Restore:PatientList');
    }

    public function forceDelete(AuthUser $authUser, PatientList $patientList): bool
    {
        return $authUser->can('ForceDelete:PatientList');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:PatientList');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:PatientList');
    }

    public function replicate(AuthUser $authUser, PatientList $patientList): bool
    {
        return $authUser->can('Replicate:PatientList');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:PatientList');
    }

}