<?php

namespace App\Policies;

use App\Models\Customer\CsCustomer;
use App\Models\Customer\CsTools;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CsCustomerPolicy
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
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CsCustomer  $csCustomer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, CsCustomer $csCustomer)
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

        return $user->role == "Sales";
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CsCustomer  $csCustomer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, CsCustomer $csCustomer)
    {
        return $user->role == "Sales" && $user->user_id == $csCustomer->sales_id && $csCustomer->status === "N" || $user->role == "Sales" && $user->user_id == $csCustomer->sales_id && $csCustomer->status === "A";
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CsCustomer  $csCustomer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, CsCustomer $csCustomer)
    {
        return $user->user_id == $csCustomer->sales_id && $user->role == "Sales"  && $csCustomer->status === "N";
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CsCustomer  $csCustomer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, CsCustomer $csCustomer)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CsCustomer  $csCustomer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, CsCustomer $csCustomer)
    {
        //
    }

    /**
     * Determine whether the user can confirmate Customer Data the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CsCustomer  $csCustomer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function confirm(User $user, CsCustomer $csCustomer)
    {
        return $user->user_id == $csCustomer->sales_id && $user->role == "Sales" && $csCustomer->status === "N";
    }

    /**
     * Determine whether the user can determine schedule Customer Data the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CsCustomer  $csCustomer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function installation(User $user, CsCustomer $csCustomer)
    {
        return $user->role == "Dispatcher" && $csCustomer->status === "D";
    }

    /**
     * Determine whether the user can determine reschedule Customer Data the model after pending status.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CsCustomer  $csCustomer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function pending(User $user, CsCustomer $csCustomer)
    {
        return $user->role == "Dispatcher" && $csCustomer->status === "P";
    }

    /**
     * Determine whether the user can determine tools Customer Data the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CsCustomer  $csCustomer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function tools(User $user, CsCustomer $csCustomer)
    {
        return $user->role == "OM" && $csCustomer->status === "O";
    }

    /**
     * Determine whether the user can update data tools Customer Data the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CsCustomer  $csCustomer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function updateTools(User $user, CsCustomer $csCustomer)
    {
        return $user->role == "OM" && $csCustomer->status === "A";
    }

    /**
     * Determine whether the user can determine tools Customer Data the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CsCustomer  $csCustomer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function activation(User $user, CsCustomer $csCustomer)
    {
        return $user->role == "Dispatcher" && $csCustomer->status === "M";
    }

    /**
     * Determine whether the user can looking data authorization approval edit Customer Data the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CsCustomer  $csCustomer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function statusApproval(User $user, CsCustomer $csCustomer)
    {
        return $user->user_id == $csCustomer->sales_id && $user->role == "Sales" && $csCustomer->status === "V";
    }

    /**
     * Determine whether the user can do processing churn of customer aktivation.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\CsCustomer  $csCustomer
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function churn(User $user, CsCustomer $csCustomer)
    {
        return $user->user_id == $csCustomer->sales_id && $user->role == "Sales" && $csCustomer->status === "A";
    }
}
