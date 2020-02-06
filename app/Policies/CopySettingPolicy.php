<?php

namespace App\Policies;

use App\User;
use App\CopySetting;
use Illuminate\Auth\Access\HandlesAuthorization;

class CopySettingPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any copy settings.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the copy setting.
     *
     * @param  \App\User  $user
     * @param  \App\CopySetting  $copySetting
     * @return mixed
     */
    public function view(User $user, CopySetting $copySetting)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can create copy settings.
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
     * Determine whether the user can update the copy setting.
     *
     * @param  \App\User  $user
     * @param  \App\CopySetting  $copySetting
     * @return mixed
     */
    public function update(User $user, CopySetting $copySetting)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the copy setting.
     *
     * @param  \App\User  $user
     * @param  \App\CopySetting  $copySetting
     * @return mixed
     */
    public function delete(User $user, CopySetting $copySetting)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the copy setting.
     *
     * @param  \App\User  $user
     * @param  \App\CopySetting  $copySetting
     * @return mixed
     */
    public function restore(User $user, CopySetting $copySetting)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the copy setting.
     *
     * @param  \App\User  $user
     * @param  \App\CopySetting  $copySetting
     * @return mixed
     */
    public function forceDelete(User $user, CopySetting $copySetting)
    {
        if($user->role->id < 2){
            return true;
        }
    }
}
