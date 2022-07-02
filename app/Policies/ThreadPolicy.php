<?php

namespace App\Policies;

use App\User;
use App\Thread;
use App\Category;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class ThreadPolicy{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view the thread.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function before(?User $user, $ability){
        if (Auth::check() & $user->hasRole('Owner')) {
            return true;
        }
    }

    /**
     * Determine whether the user can view the thread.
     *
     * @param  \App\User  $user
     * @return mixed
     */

    public function view(?User $user)
    {
        if (Auth::check() & $user->hasRole('Banned')) {
            return false;
        } else
            return true;
    }

    /**
     * Determine whether the user can create threads.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user){
        if (Auth::check() & $user->hasRole('Banned')) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Determine whether the user can update the thread.
     *
     * @param  \App\User  $user
     * @param  \App\Thread  $thread
     * @return mixed
     */
    public function update(User $user, Thread $thread){
        if(Auth::check()) {
            return $user->can('edit thread') | $user->id === $thread->user_id;
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the thread.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user){
        if(Auth::check()) {
            return $user->can('edit thread');
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the thread.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function restore(User $user){
        if(Auth::check()) {
            return $user->can('edit thread');
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can permanently delete the thread.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function forceDelete(User $user){
        if(Auth::check()) {
            return $user->can('edit thread');
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can create in a locked thread.
     *
     * @param  \App\User $user
     * @param Thread $thread
     * @return mixed
     */
    public function isLocked(?User $user, Thread $thread)
    {
        if (Auth::check() & $user->hasRole('Banned')){
            return false;
        } else {
            if ($thread->isLocked){
                return false;
            } else {
                return true;
            }
        }
    }

    /**
     * Determine whether the user can view  a deleted thread.
     *
     * @param  \App\User $user
     * @param Thread $thread
     * @return mixed
     */
    public function istrashed(?User $user, Thread $thread){
        if (Auth::check() & $user->hasRole('Banned')){
            return false;
        } else {
            if ($thread->trashed()){
                return $user->can('edit thread');
            } else {
                return true;
            }
        }
    }
}
