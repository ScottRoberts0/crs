<?php

namespace App\Policies;

use App\User;
use App\TaskType;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskTypePolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any task types.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the task type.
     *
     * @param  \App\User  $user
     * @param  \App\TaskType  $taskType
     * @return mixed
     */
    public function view(User $user, TaskType $taskType)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can create task types.
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
     * Determine whether the user can update the task type.
     *
     * @param  \App\User  $user
     * @param  \App\TaskType  $taskType
     * @return mixed
     */
    public function update(User $user, TaskType $taskType)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the task type.
     *
     * @param  \App\User  $user
     * @param  \App\TaskType  $taskType
     * @return mixed
     */
    public function delete(User $user, TaskType $taskType)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the task type.
     *
     * @param  \App\User  $user
     * @param  \App\TaskType  $taskType
     * @return mixed
     */
    public function restore(User $user, TaskType $taskType)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the task type.
     *
     * @param  \App\User  $user
     * @param  \App\TaskType  $taskType
     * @return mixed
     */
    public function forceDelete(User $user, TaskType $taskType)
    {
        if($user->role->id < 2){
            return true;
        }
    }
}
