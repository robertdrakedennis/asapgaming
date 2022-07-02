<?php

namespace App\Policies;

use App\User;
use App\Article;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class ArticlePolicy{
    use HandlesAuthorization;

    public function before(?User $user, $ability){
        if (Auth::check() && $user->hasRole('Owner')) {
            return true;
        }
    }


    /**
     * Determine whether the user can view the article.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function view(?User $user){
        if (Auth::check() && $user->hasRole('Banned')) {
            return false;
        } else
            return true;
    }

    /**
     * Determine whether the user can create articles.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function create(User $user){
        if (Auth::check()){
            return $user->can('edit news');
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the article.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function update(User $user){
        if (Auth::check()){
            return $user->can('edit category');
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the article.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function delete(User $user){
        if (Auth::check()){
            return $user->can('edit category');
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the article.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function restore(User $user){
        if (Auth::check()){
            return $user->can('edit category');
        } else {
            return false;
        }
    }

    /**
     * Determine whether the user can permanently delete the article.
     *
     * @param  \App\User  $user
     * @return mixed
     */
    public function forceDelete(User $user){
        if (Auth::check()){
            return $user->can('edit category');
        } else {
            return false;
        }
    }
}
