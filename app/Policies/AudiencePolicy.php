<?php

namespace App\Policies;

use App\User;
use App\Audience;
use Illuminate\Auth\Access\HandlesAuthorization;

class AudiencePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any audiences.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the audience.
     *
     * @param  \App\User  $user
     * @param  \App\Audience  $audience
     * @return mixed
     */
    public function view(User $user, Audience $audience)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can create audiences.
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
     * Determine whether the user can update the audience.
     *
     * @param  \App\User  $user
     * @param  \App\Audience  $audience
     * @return mixed
     */
    public function update(User $user, Audience $audience)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the audience.
     *
     * @param  \App\User  $user
     * @param  \App\Audience  $audience
     * @return mixed
     */
    public function delete(User $user, Audience $audience)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the audience.
     *
     * @param  \App\User  $user
     * @param  \App\Audience  $audience
     * @return mixed
     */
    public function restore(User $user, Audience $audience)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the audience.
     *
     * @param  \App\User  $user
     * @param  \App\Audience  $audience
     * @return mixed
     */
    public function forceDelete(User $user, Audience $audience)
    {
        if($user->role->id < 2){
            return true;
        }
    }
}
