<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ReportVisit;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportVisitPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ReportVisit');
    }

    public function view(AuthUser $authUser, ReportVisit $reportVisit): bool
    {
        return $authUser->can('View:ReportVisit');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ReportVisit');
    }

    public function update(AuthUser $authUser, ReportVisit $reportVisit): bool
    {
        return $authUser->can('Update:ReportVisit');
    }

    public function delete(AuthUser $authUser, ReportVisit $reportVisit): bool
    {
        return $authUser->can('Delete:ReportVisit');
    }

    public function restore(AuthUser $authUser, ReportVisit $reportVisit): bool
    {
        return $authUser->can('Restore:ReportVisit');
    }

    public function forceDelete(AuthUser $authUser, ReportVisit $reportVisit): bool
    {
        return $authUser->can('ForceDelete:ReportVisit');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ReportVisit');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ReportVisit');
    }

    public function replicate(AuthUser $authUser, ReportVisit $reportVisit): bool
    {
        return $authUser->can('Replicate:ReportVisit');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ReportVisit');
    }

}