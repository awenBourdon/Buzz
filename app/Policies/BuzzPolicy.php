<?php

namespace App\Policies;

use App\Models\Buzz;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class BuzzPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Buzz $buzz): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Buzz $buzz): bool
    {
        return $buzz->user()->is($user);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Buzz $buzz): bool
    {
        return $this->update($user, $buzz);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Buzz $buzz): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Buzz $buzz): bool
    {
        //
    }
}
