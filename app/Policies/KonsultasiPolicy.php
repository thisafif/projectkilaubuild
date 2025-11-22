<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Konsultasi;
use Illuminate\Auth\Access\HandlesAuthorization;

class KonsultasiPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Konsultasi');
    }

    public function view(AuthUser $authUser, Konsultasi $konsultasi): bool
    {
        return $authUser->can('View:Konsultasi');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Konsultasi');
    }

    public function update(AuthUser $authUser, Konsultasi $konsultasi): bool
    {
        return $authUser->can('Update:Konsultasi');
    }

    public function delete(AuthUser $authUser, Konsultasi $konsultasi): bool
    {
        return $authUser->can('Delete:Konsultasi');
    }

    public function restore(AuthUser $authUser, Konsultasi $konsultasi): bool
    {
        return $authUser->can('Restore:Konsultasi');
    }

    public function forceDelete(AuthUser $authUser, Konsultasi $konsultasi): bool
    {
        return $authUser->can('ForceDelete:Konsultasi');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Konsultasi');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Konsultasi');
    }

    public function replicate(AuthUser $authUser, Konsultasi $konsultasi): bool
    {
        return $authUser->can('Replicate:Konsultasi');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Konsultasi');
    }

}