<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UsersController extends Controller
{
    public function index()
    {
        //Get all users
        $users = User::all();

        // Return a collection of $users with pagination
        return UserResource::collection($users);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return array|string
     */
    public function show(User $user){
        return (new UserResource($user))->resolve();
    }
}
