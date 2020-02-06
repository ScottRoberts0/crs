<?php

namespace App\Policies;

use App\User;
use App\PaperType;
use Illuminate\Auth\Access\HandlesAuthorization;

class PaperTypePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any paper types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the paper type.
     *
     * @param  \App\User  $user
     * @param  \App\PaperType  $paperType
     * @return mixed
     */
    public function view(User $user, PaperType $paperType)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can create paper types.
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
     * Determine whether the user can update the paper type.
     *
     * @param  \App\User  $user
     * @param  \App\PaperType  $paperType
     * @return mixed
     */
    public function update(User $user, PaperType $paperType)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the paper type.
     *
     * @param  \App\User  $user
     * @param  \App\PaperType  $paperType
     * @return mixed
     */
    public function delete(User $user, PaperType $paperType)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the paper type.
     *
     * @param  \App\User  $user
     * @param  \App\PaperType  $paperType
     * @return mixed
     */
    public function restore(User $user, PaperType $paperType)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the paper type.
     *
     * @param  \App\User  $user
     * @param  \App\PaperType  $paperType
     * @return mixed
     */
    public function forceDelete(User $user, PaperType $paperType)
    {
        if($user->role->id < 2){
            return true;
        }
    }
}
