<?php

namespace App\Policies;

use App\User;
use App\Campus;
use Illuminate\Auth\Access\HandlesAuthorization;

class CampusPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any campuses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the campus.
     *
     * @param  \App\User  $user
     * @param  \App\Campus  $campus
     * @return mixed
     */
    public function view(User $user, Campus $campus)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can create campuses.
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
     * Determine whether the user can update the campus.
     *
     * @param  \App\User  $user
     * @param  \App\Campus  $campus
     * @return mixed
     */
    public function update(User $user, Campus $campus)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the campus.
     *
     * @param  \App\User  $user
     * @param  \App\Campus  $campus
     * @return mixed
     */
    public function delete(User $user, Campus $campus)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the campus.
     *
     * @param  \App\User  $user
     * @param  \App\Campus  $campus
     * @return mixed
     */
    public function restore(User $user, Campus $campus)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the campus.
     *
     * @param  \App\User  $user
     * @param  \App\Campus  $campus
     * @return mixed
     */
    public function forceDelete(User $user, Campus $campus)
    {
        if($user->role->id < 2){
            return true;
        }
    }
}
