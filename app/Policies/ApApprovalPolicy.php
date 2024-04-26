<?php

namespace App\Policies;

use App\Models\Approval\ApApproval;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class ApApprovalPolicy
{
    use HandlesAuthorization;

    /**
     * Perform pre-authorization checks.
     *
     * @param  \App\Models\User  $user
     * @param  string  $ability
     * @return void|bool
     */
    public function before(User $user, $ability)
    {
        if ($user->is_admin) {
            return true;
        }
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        return $user->role == "Sales" && $user->position == "Manager";
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Approval\ApApproval  $approval
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, ApApproval $approval)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Approval\ApApproval  $approval
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, ApApproval $approval)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Approval\ApApproval  $approval
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, ApApproval $approval)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Approval\ApApproval  $approval
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, ApApproval $approval)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Approval\ApApproval  $approval
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, ApApproval $approval)
    {
        //
    }
}
