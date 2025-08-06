<?php

namespace App\Policies;

use App\Models\Store_galery;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class GaleryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('gallery: view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Store_galery $storeGalery): bool
    {
        return $user->can('gallery: view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('gallery: create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Store_galery $storeGalery): bool
    {
        return $user->can('gallery: update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Store_galery $storeGalery): bool
    {
        return $user->can('gallery: delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Store_galery $storeGalery): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Store_galery $storeGalery): bool
    {
        return false;
    }
}
