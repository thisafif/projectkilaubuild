<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Tim;
use Illuminate\Auth\Access\HandlesAuthorization;

class TimPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Tim');
    }

    public function view(AuthUser $authUser, Tim $tim): bool
    {
        return $authUser->can('View:Tim');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Tim');
    }

    public function update(AuthUser $authUser, Tim $tim): bool
    {
        return $authUser->can('Update:Tim');
    }

    public function delete(AuthUser $authUser, Tim $tim): bool
    {
        return $authUser->can('Delete:Tim');
    }

    public function restore(AuthUser $authUser, Tim $tim): bool
    {
        return $authUser->can('Restore:Tim');
    }

    public function forceDelete(AuthUser $authUser, Tim $tim): bool
    {
        return $authUser->can('ForceDelete:Tim');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Tim');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Tim');
    }

    public function replicate(AuthUser $authUser, Tim $tim): bool
    {
        return $authUser->can('Replicate:Tim');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Tim');
    }

}