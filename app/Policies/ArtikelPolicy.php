<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Artikel;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtikelPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:Artikel');
    }

    public function view(AuthUser $authUser, Artikel $artikel): bool
    {
        return $authUser->can('View:Artikel');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:Artikel');
    }

    public function update(AuthUser $authUser, Artikel $artikel): bool
    {
        return $authUser->can('Update:Artikel');
    }

    public function delete(AuthUser $authUser, Artikel $artikel): bool
    {
        return $authUser->can('Delete:Artikel');
    }

    public function restore(AuthUser $authUser, Artikel $artikel): bool
    {
        return $authUser->can('Restore:Artikel');
    }

    public function forceDelete(AuthUser $authUser, Artikel $artikel): bool
    {
        return $authUser->can('ForceDelete:Artikel');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:Artikel');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:Artikel');
    }

    public function replicate(AuthUser $authUser, Artikel $artikel): bool
    {
        return $authUser->can('Replicate:Artikel');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:Artikel');
    }

}