<?php

namespace App\Policies;

use App\User;
use App\Staffnet;
use Illuminate\Auth\Access\HandlesAuthorization;

class StaffnetPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any staffnets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the staffnet.
     *
     * @param  \App\User  $user
     * @param  \App\Staffnet  $staffnet
     * @return mixed
     */
    public function view(User $user, Staffnet $staffnet)
    {
        return true;
    }

    /**
     * Determine whether the user can create staffnets.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the staffnet.
     *
     * @param  \App\User  $user
     * @param  \App\Staffnet  $staffnet
     * @return mixed
     */
    public function update(User $user, Staffnet $staffnet)
    {
        if($staffnet->status->id === 1){
            return true;
        }

        if($user->role->id < 4){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the staffnet.
     *
     * @param  \App\User  $user
     * @param  \App\Staffnet  $staffnet
     * @return mixed
     */
    public function delete(User $user, Staffnet $staffnet)
    {
        if($staffnet->status->id === 1){
            return true;
        }

        if($user->role->id < 4){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the staffnet.
     *
     * @param  \App\User  $user
     * @param  \App\Staffnet  $staffnet
     * @return mixed
     */
    public function restore(User $user, Staffnet $staffnet)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the staffnet.
     *
     * @param  \App\User  $user
     * @param  \App\Staffnet  $staffnet
     * @return mixed
     */
    public function forceDelete(User $user, Staffnet $staffnet)
    {
        //
    }
}
