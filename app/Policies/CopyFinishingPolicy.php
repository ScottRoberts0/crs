<?php

namespace App\Policies;

use App\User;
use App\CopyFinishing;
use Illuminate\Auth\Access\HandlesAuthorization;

class CopyFinishingPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any copy finishings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the copy finishing.
     *
     * @param  \App\User  $user
     * @param  \App\CopyFinishing  $copyFinishing
     * @return mixed
     */
    public function view(User $user, CopyFinishing $copyFinishing)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can create copy finishings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can update the copy finishing.
     *
     * @param  \App\User  $user
     * @param  \App\CopyFinishing  $copyFinishing
     * @return mixed
     */
    public function update(User $user, CopyFinishing $copyFinishing)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the copy finishing.
     *
     * @param  \App\User  $user
     * @param  \App\CopyFinishing  $copyFinishing
     * @return mixed
     */
    public function delete(User $user, CopyFinishing $copyFinishing)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the copy finishing.
     *
     * @param  \App\User  $user
     * @param  \App\CopyFinishing  $copyFinishing
     * @return mixed
     */
    public function restore(User $user, CopyFinishing $copyFinishing)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the copy finishing.
     *
     * @param  \App\User  $user
     * @param  \App\CopyFinishing  $copyFinishing
     * @return mixed
     */
    public function forceDelete(User $user, CopyFinishing $copyFinishing)
    {
        if($user->role->id < 2){
            return true;
        }
    }
}
