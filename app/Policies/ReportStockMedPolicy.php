<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ReportStockMed;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportStockMedPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ReportStockMed');
    }

    public function view(AuthUser $authUser, ReportStockMed $reportStockMed): bool
    {
        return $authUser->can('View:ReportStockMed');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ReportStockMed');
    }

    public function update(AuthUser $authUser, ReportStockMed $reportStockMed): bool
    {
        return $authUser->can('Update:ReportStockMed');
    }

    public function delete(AuthUser $authUser, ReportStockMed $reportStockMed): bool
    {
        return $authUser->can('Delete:ReportStockMed');
    }

    public function restore(AuthUser $authUser, ReportStockMed $reportStockMed): bool
    {
        return $authUser->can('Restore:ReportStockMed');
    }

    public function forceDelete(AuthUser $authUser, ReportStockMed $reportStockMed): bool
    {
        return $authUser->can('ForceDelete:ReportStockMed');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ReportStockMed');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ReportStockMed');
    }

    public function replicate(AuthUser $authUser, ReportStockMed $reportStockMed): bool
    {
        return $authUser->can('Replicate:ReportStockMed');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ReportStockMed');
    }

}