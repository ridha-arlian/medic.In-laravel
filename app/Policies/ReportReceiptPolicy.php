<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ReportReceipt;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReportReceiptPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:ReportReceipt');
    }

    public function view(AuthUser $authUser, ReportReceipt $reportReceipt): bool
    {
        return $authUser->can('View:ReportReceipt');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:ReportReceipt');
    }

    public function update(AuthUser $authUser, ReportReceipt $reportReceipt): bool
    {
        return $authUser->can('Update:ReportReceipt');
    }

    public function delete(AuthUser $authUser, ReportReceipt $reportReceipt): bool
    {
        return $authUser->can('Delete:ReportReceipt');
    }

    public function restore(AuthUser $authUser, ReportReceipt $reportReceipt): bool
    {
        return $authUser->can('Restore:ReportReceipt');
    }

    public function forceDelete(AuthUser $authUser, ReportReceipt $reportReceipt): bool
    {
        return $authUser->can('ForceDelete:ReportReceipt');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:ReportReceipt');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:ReportReceipt');
    }

    public function replicate(AuthUser $authUser, ReportReceipt $reportReceipt): bool
    {
        return $authUser->can('Replicate:ReportReceipt');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:ReportReceipt');
    }

}