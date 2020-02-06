<?php

namespace App\Policies;

use App\User;
use App\MartialStatus;
use Illuminate\Auth\Access\HandlesAuthorization;

class MaritalStatusPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any martial statuses.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the martial status.
     *
     * @param  \App\User  $user
     * @param  \App\MartialStatus  $martialStatus
     * @return mixed
     */
    public function view(User $user, MartialStatus $martialStatus)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can create martial statuses.
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
     * Determine whether the user can update the martial status.
     *
     * @param  \App\User  $user
     * @param  \App\MartialStatus  $martialStatus
     * @return mixed
     */
    public function update(User $user, MartialStatus $martialStatus)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the martial status.
     *
     * @param  \App\User  $user
     * @param  \App\MartialStatus  $martialStatus
     * @return mixed
     */
    public function delete(User $user, MartialStatus $martialStatus)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the martial status.
     *
     * @param  \App\User  $user
     * @param  \App\MartialStatus  $martialStatus
     * @return mixed
     */
    public function restore(User $user, MartialStatus $martialStatus)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the martial status.
     *
     * @param  \App\User  $user
     * @param  \App\MartialStatus  $martialStatus
     * @return mixed
     */
    public function forceDelete(User $user, MartialStatus $martialStatus)
    {
        if($user->role->id < 2){
            return true;
        }
    }
}
