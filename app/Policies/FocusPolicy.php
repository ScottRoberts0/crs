<?php

namespace App\Policies;

use App\User;
use App\Focus;
use Illuminate\Auth\Access\HandlesAuthorization;

class FocusPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any foci.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the focus.
     *
     * @param  \App\User  $user
     * @param  \App\Focus  $focus
     * @return mixed
     */
    public function view(User $user, Focus $focus)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can create foci.
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
     * Determine whether the user can update the focus.
     *
     * @param  \App\User  $user
     * @param  \App\Focus  $focus
     * @return mixed
     */
    public function update(User $user, Focus $focus)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the focus.
     *
     * @param  \App\User  $user
     * @param  \App\Focus  $focus
     * @return mixed
     */
    public function delete(User $user, Focus $focus)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the focus.
     *
     * @param  \App\User  $user
     * @param  \App\Focus  $focus
     * @return mixed
     */
    public function restore(User $user, Focus $focus)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the focus.
     *
     * @param  \App\User  $user
     * @param  \App\Focus  $focus
     * @return mixed
     */
    public function forceDelete(User $user, Focus $focus)
    {
        if($user->role->id < 2){
            return true;
        }
    }
}
