<?php

namespace App\Policies;

use App\User;
use App\Copy;
use Illuminate\Auth\Access\HandlesAuthorization;

class CopyPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any copies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the copy.
     *
     * @param  \App\User  $user
     * @param  \App\Copy  $copy
     * @return mixed
     */
    public function view(User $user, Copy $copy)
    {
        return true;
    }

    /**
     * Determine whether the user can create copies.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the copy.
     *
     * @param  \App\User  $user
     * @param  \App\Copy  $copy
     * @return mixed
     */
    public function update(User $user, Copy $copy)
    {
        if($copy->status->id === 1){
            return true;
        }

        if($user->role->id < 4){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the copy.
     *
     * @param  \App\User  $user
     * @param  \App\Copy  $copy
     * @return mixed
     */
    public function delete(User $user, Copy $copy)
    {
        if($copy->status->id === 1){
            return true;
        }

        if($user->role->id < 4){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the copy.
     *
     * @param  \App\User  $user
     * @param  \App\Copy  $copy
     * @return mixed
     */
    public function restore(User $user, Copy $copy)
    {
        if($copy->status->id === 1){
            return true;
        }

        if($user->role->id <= 2){
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the copy.
     *
     * @param  \App\User  $user
     * @param  \App\Copy  $copy
     * @return mixed
     */
    public function forceDelete(User $user, Copy $copy)
    {
        if($copy->status->id === 1){
            return true;
        }

        if($user->role->id <= 2){
            return true;
        }
    }
}
