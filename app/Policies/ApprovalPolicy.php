<?php

namespace App\Policies;

use App\User;
use App\Approval;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApprovalPolicy
{
    use HandlesAuthorization;
    
    /**
     * Determine whether the user can view any approvals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function viewAny(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can view the approval.
     *
     * @param  \App\User  $user
     * @param  \App\Approval  $approval
     * @return mixed
     */
    public function view(User $user, Approval $approval)
    {
        return true;
    }

    /**
     * Determine whether the user can create approvals.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user)
    {
        return true;
    }

    /**
     * Determine whether the user can update the approval.
     *
     * @param  \App\User  $user
     * @param  \App\Approval  $approval
     * @return mixed
     */
    public function update(User $user, Approval $approval)
    {
        if($approval->status->id === 1){
            return true;
        }

        if($user->role->id < 4){
            return true;
        }
    }

    /**
     * Determine whether the user can delete the approval.
     *
     * @param  \App\User  $user
     * @param  \App\Approval  $approval
     * @return mixed
     */
    public function delete(User $user, Approval $approval)
    {
        if($approval->status->id === 1){
            return true;
        }

        if($user->role->id < 4){
            return true;
        }
    }

    /**
     * Determine whether the user can restore the approval.
     *
     * @param  \App\User  $user
     * @param  \App\Approval  $approval
     * @return mixed
     */
    public function restore(User $user, Approval $approval)
    {
        if($user->role->id < 2){
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the approval.
     *
     * @param  \App\User  $user
     * @param  \App\Approval  $approval
     * @return mixed
     */
    public function forceDelete(User $user, Approval $approval)
    {
        if($user->role->id < 2){
            return true;
        }
    }
}
