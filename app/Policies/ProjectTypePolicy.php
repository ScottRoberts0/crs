<?php

namespace App\Policies;

use App\User;
use App\ProjectType;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProjectTypePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any project types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the project type.
     *
     * @param  \App\User  $user
     * @param  \App\ProjectType  $projectType
     * @return mixed
     */
    public function view(User $user, ProjectType $projectType)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can create project types.
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
     * Determine whether the user can update the project type.
     *
     * @param  \App\User  $user
     * @param  \App\ProjectType  $projectType
     * @return mixed
     */
    public function update(User $user, ProjectType $projectType)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the project type.
     *
     * @param  \App\User  $user
     * @param  \App\ProjectType  $projectType
     * @return mixed
     */
    public function delete(User $user, ProjectType $projectType)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the project type.
     *
     * @param  \App\User  $user
     * @param  \App\ProjectType  $projectType
     * @return mixed
     */
    public function restore(User $user, ProjectType $projectType)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the project type.
     *
     * @param  \App\User  $user
     * @param  \App\ProjectType  $projectType
     * @return mixed
     */
    public function forceDelete(User $user, ProjectType $projectType)
    {
        if($user->role->id < 2){
            return true;
        }
    }
}
