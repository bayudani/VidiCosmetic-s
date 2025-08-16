<?php

namespace App\Policies;

use App\Models\OwnerProfile;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OwnerPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('owner_profile: view');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, OwnerProfile $ownerProfile): bool
    {
        return $user->can('owner_profile: view');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('owner_profile: create');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, OwnerProfile $ownerProfile): bool
    {
        return $user->can('owner_profile: update');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, OwnerProfile $ownerProfile): bool
    {
        return $user->can('owner_profile: delete');
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, OwnerProfile $ownerProfile): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, OwnerProfile $ownerProfile): bool
    {
        return false;
    }
}
