<?php

namespace App\Policies;

use App\User;
use App\Credit;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class CreditPolicy
{
    use HandlesAuthorization;

    public function before($user, $ability){
        if (Auth::check() && $user->hasRole('Owner')) {
            return true;
        }
    }


    /**
     * Determine whether the user can view the credit.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(?User $user){
        if(Auth::check() && $user->hasRole('Banned')) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Determine whether the user can create credits.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user){
        if(Auth::check() && $user->hasRole('Owner')) {
            return true;
        } else {
            return true;
        }
    }

    /**
     * Determine whether the user can update the credit.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user){
        if(Auth::check() && $user->hasRole('Owner')) {
            return true;
        } else {
            return true;
        }
    }

    /**
     * Determine whether the user can delete the credit.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user){
        if(Auth::check() && $user->hasRole('Owner')) {
            return true;
        } else {
            return true;
        }
    }

    /**
     * Determine whether the user can restore the credit.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function restore(User $user){
        if(Auth::check() && $user->hasRole('Owner')) {
            return true;
        } else {
            return true;
        }
    }

    /**
     * Determine whether the user can permanently delete the credit.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function forceDelete(User $user){
        if(Auth::check() && $user->hasRole('Owner')) {
            return true;
        } else {
            return true;
        }
    }
}
