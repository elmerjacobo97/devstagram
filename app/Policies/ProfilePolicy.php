<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\Response;

class ProfilePolicy
{

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, User $profileUser): bool
    {
        return $user->id === $profileUser->id;
    }
}
