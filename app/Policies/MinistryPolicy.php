<?php

namespace App\Policies;

use App\User;
use App\Ministry;
use Illuminate\Auth\Access\HandlesAuthorization;

class MinistryPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any ministries.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the ministry.
     *
     * @param  \App\User  $user
     * @param  \App\Ministry  $ministry
     * @return mixed
     */
    public function view(User $user, Ministry $ministry)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can create ministries.
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
     * Determine whether the user can update the ministry.
     *
     * @param  \App\User  $user
     * @param  \App\Ministry  $ministry
     * @return mixed
     */
    public function update(User $user, Ministry $ministry)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the ministry.
     *
     * @param  \App\User  $user
     * @param  \App\Ministry  $ministry
     * @return mixed
     */
    public function delete(User $user, Ministry $ministry)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the ministry.
     *
     * @param  \App\User  $user
     * @param  \App\Ministry  $ministry
     * @return mixed
     */
    public function restore(User $user, Ministry $ministry)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the ministry.
     *
     * @param  \App\User  $user
     * @param  \App\Ministry  $ministry
     * @return mixed
     */
    public function forceDelete(User $user, Ministry $ministry)
    {
        if($user->role->id < 2){
            return true;
        }
    }
}
