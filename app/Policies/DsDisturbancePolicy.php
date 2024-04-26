<?php

namespace App\Policies;

use App\Models\Disturbance\DsDisturbance;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DsDisturbancePolicy
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
        return $user->role == "Dispatcher" || $user->role == "OM";
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DsDisturbance  $dsDisturbance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, DsDisturbance $dsDisturbance)
    {
        return $user->role == "Dispatcher" || $user->role == "OM";
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        return $user->role == "Dispatcher";
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DsDisturbance  $dsDisturbance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, DsDisturbance $dsDisturbance)
    {
        return $user->user_id == $dsDisturbance->user_id && $dsDisturbance->status === "N";
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DsDisturbance  $dsDisturbance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, DsDisturbance $dsDisturbance)
    {
        return $user->user_id == $dsDisturbance->user_id && $dsDisturbance->status === "N";
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DsDisturbance  $dsDisturbance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, DsDisturbance $dsDisturbance)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DsDisturbance  $dsDisturbance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, DsDisturbance $dsDisturbance)
    {
        //
    }

    /**
     * Determine whether the user can confirm data the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DsDisturbance  $dsDisturbance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function confirm(User $user, DsDisturbance $dsDisturbance)
    {
        return $user->user_id === $dsDisturbance->user_id && $dsDisturbance->status === "N";
    }

    /**
     * Determine whether the user can determine work the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DsDisturbance  $dsDisturbance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function works(User $user, DsDisturbance $dsDisturbance)
    {
        return $user->role == "OM" && $dsDisturbance->status === "D";
    }

    /**
     * Determine whether the user can determine work the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DsDisturbance  $dsDisturbance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function finishWorks(User $user, DsDisturbance $dsDisturbance)
    {
        return $user->role == "OM" && $dsDisturbance->status === "M";
    }

    /**
     * Determine whether the user can determine the distrubance is done the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\DsDisturbance  $dsDisturbance
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function done(User $user, DsDisturbance $dsDisturbance)
    {
        return $user->role === "Dispatcher" && $user->user_id === $dsDisturbance->user_id && $dsDisturbance->status === "Y";
    }
}
