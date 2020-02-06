<?php

namespace App\Policies;

use App\User;
use App\Demographic;
use Illuminate\Auth\Access\HandlesAuthorization;

class DemographicPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any demographics.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the demographic.
     *
     * @param  \App\User  $user
     * @param  \App\Demographic  $demographic
     * @return mixed
     */
    public function view(User $user, Demographic $demographic)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can create demographics.
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
     * Determine whether the user can update the demographic.
     *
     * @param  \App\User  $user
     * @param  \App\Demographic  $demographic
     * @return mixed
     */
    public function update(User $user, Demographic $demographic)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the demographic.
     *
     * @param  \App\User  $user
     * @param  \App\Demographic  $demographic
     * @return mixed
     */
    public function delete(User $user, Demographic $demographic)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the demographic.
     *
     * @param  \App\User  $user
     * @param  \App\Demographic  $demographic
     * @return mixed
     */
    public function restore(User $user, Demographic $demographic)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the demographic.
     *
     * @param  \App\User  $user
     * @param  \App\Demographic  $demographic
     * @return mixed
     */
    public function forceDelete(User $user, Demographic $demographic)
    {
        if($user->role->id < 2){
            return true;
        }
    }
}
