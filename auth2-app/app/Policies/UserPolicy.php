<?php

namespace App\Policies;

use App\Models\User;

class UserPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct()
    {
        //
    }
    public function delete(User $currentUser, User $user)
    {
        // Allow deletion if the current user is an admin
        return $currentUser->usertype === 'admin';
    }
}
