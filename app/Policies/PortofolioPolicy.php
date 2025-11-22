<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Portofolio;
use Illuminate\Auth\Access\HandlesAuthorization;

class PortofolioPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Portofolio');
    }

    public function view(AuthUser $authUser, Portofolio $portofolio): bool
    {
        return $authUser->can('View:Portofolio');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Portofolio');
    }

    public function update(AuthUser $authUser, Portofolio $portofolio): bool
    {
        return $authUser->can('Update:Portofolio');
    }

    public function delete(AuthUser $authUser, Portofolio $portofolio): bool
    {
        return $authUser->can('Delete:Portofolio');
    }

    public function restore(AuthUser $authUser, Portofolio $portofolio): bool
    {
        return $authUser->can('Restore:Portofolio');
    }

    public function forceDelete(AuthUser $authUser, Portofolio $portofolio): bool
    {
        return $authUser->can('ForceDelete:Portofolio');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Portofolio');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Portofolio');
    }

    public function replicate(AuthUser $authUser, Portofolio $portofolio): bool
    {
        return $authUser->can('Replicate:Portofolio');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Portofolio');
    }

}