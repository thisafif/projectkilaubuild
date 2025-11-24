<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Ongoing;
use Illuminate\Auth\Access\HandlesAuthorization;

class OngoingPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Ongoing');
    }

    public function view(AuthUser $authUser, Ongoing $ongoing): bool
    {
        return $authUser->can('View:Ongoing');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Ongoing');
    }

    public function update(AuthUser $authUser, Ongoing $ongoing): bool
    {
        return $authUser->can('Update:Ongoing');
    }

    public function delete(AuthUser $authUser, Ongoing $ongoing): bool
    {
        return $authUser->can('Delete:Ongoing');
    }

    public function restore(AuthUser $authUser, Ongoing $ongoing): bool
    {
        return $authUser->can('Restore:Ongoing');
    }

    public function forceDelete(AuthUser $authUser, Ongoing $ongoing): bool
    {
        return $authUser->can('ForceDelete:Ongoing');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Ongoing');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Ongoing');
    }

    public function replicate(AuthUser $authUser, Ongoing $ongoing): bool
    {
        return $authUser->can('Replicate:Ongoing');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Ongoing');
    }

}