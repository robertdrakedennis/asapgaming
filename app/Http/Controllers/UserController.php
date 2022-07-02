<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Helpers\Quill\Plaintext;
use App\Players;
use App\User;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use kanalumaddela\LaravelSteamLogin\SteamUser;
use Spatie\Permission\Models\Role;
use Validator;

class UserController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $allUsers = User::all()->count();

        $users = User::paginate(15);

        $query = $request->input('query');

        if(! is_null($query)){
            $users = User::where('name', 'LIKE', '%' . $query . '%')->paginate(15);
        }


        return view('main.users.index', compact('users', 'allUsers'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function staff(){
        $users = User::role(['Owner', 'Administrator', 'Staff'])->paginate(15);
        return view('main.users.staff.index', compact('users'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function show(User $user){
        $this->authorize('view', User::class);

        $steam = new SteamUser("[U:1:$user->steam_account_id]");
        $steam->getUserInfo();

        $roles = Role::all();

        // $darkrp = Players::where('uid', '=', $steam->steamId)->first();
        
        $darkrp = null;

        $comments = $user->comments()->latest()->paginate(5);

        return view('main.users.show', compact('user', 'steam', 'roles', 'comments', 'darkrp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(User $user){
        $this->authorize('update', $user);
        $roles = Role::all();

        return view('users.show', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, User $user){
        $this->authorize('update', $user);

        $messages = [
            'mimetypes' => 'Sorry, only donators can use gifs for their avatar. Consider becoming one! It directly supports the server uptime! (or you just uploaded a file we don\'t allow.)',
        ];

        if($user->hasAnyRole(['Owner', 'Administrator', 'Staff']) || $user->donator_tier != null){
            $rules = [
                'name' => 'nullable|min:3|max:255',
                'body' => 'nullable|json|min:5',
                'avatar' => 'nullable|image|max:2048',
                'slug' => [
                    'nullable',
                    'min:1',
                    'max:50',
                    Rule::unique('users')->ignore($user->id), // when it's an array every single rule has to be its own value
                ],
                'background' => 'nullable|image|max:8192',
                'post_background' => 'nullable|image|max:8192',
                'color' => 'sometimes',
            ];
        } else {
            $rules = [
                'name' => 'nullable|min:3|max:255',
                'body' => 'nullable|json|min:5',
                'avatar' => 'nullable|mimetypes:image/png,image/jpeg|max:2048',
                'slug' => [
                    'nullable',
                    'min:1',
                    'max:50',
                    Rule::unique('users')->ignore($user->id), // when it's an array every single rule has to be its own value
                ],
                'background' => 'nullable|image|max:2048',
                'post_background' => 'nullable|image|max:2048',
                'color' => 'sometimes',
            ];
        }

        Validator::make($request->all(), $rules, $messages)->validate();

        if ($request->name != null){
            $user->name = $request->name;
        }

        if ($request->body != null){
            $body = json_decode($request->body, true);
            $user->about = json_encode($request->body);
            $user->plaintext = (new Plaintext)->strip($body);
        }

        if ($request->slug != null){
            $this->authorize('donator', $user);
            $user->slug = (new Slugify)->slugify($request->slug);
        }

        if ($request->background != null){
            $this->authorize('donator', $user);
            $background = $request->file('background')->store('public/backgrounds');
            $user->background = $background;
        }

        if ($request->post_background != null){
            $this->authorize('donator', $user);
            $post_background = $request->file('post_background')->store('public/backgrounds');
            $user->post_background = $post_background;
        }

        if ($request->color != null){
            $this->authorize('donator', $user);
            $color = substr($request->color, 1);
            if(ctype_xdigit($color) && strlen($color) == 6){
                $user->color = $request->color;
            }
        }

        if ($request->avatar != null){
            $avatar = $request->file('avatar')->store('public/avatars');
            $user->avatar = $avatar;
        }

        $user->save();
        toast('Profile Updated Successfully!','success','top-right');
        return redirect()->route('users.show', $user);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function setRank(Request $request, User $user){
        $this->authorize('ban', $user); // just using this policy to not have to make another one
        app()['cache']->forget('spatie.permission.cache');

        if (Auth::user()->id === $user->id & $user->hasAnyRole('Owner')){
            toast('You can\'t change your rank because you are owner.','success','top-right');

            return redirect()->route('users.show', $user);
        }

        $user->syncRoles([$request->role]);

        toast('Profile Role Updated Successfully!','success','top-right');

        return redirect()->route('users.show', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function ban(User $user){
        $this->authorize('ban', $user);

        if ($user->hasRole('User')){
            app()['cache']->forget('spatie.permission.cache');
            $user->syncRoles(['Banned']);

            toast('User Successfully Banned!','success','top-right');

            return redirect(route('users.show', $user));
        } else {
            $user->syncRoles(['User']);
        }

        toast('User Successfully Un-banned!','success','top-right');

        return redirect()->route('users.show', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function syncWithSteam(User $user){
        $this->authorize('update', $user);

        $steam = new SteamUser("[U:1:$user->steam_account_id]");

        $steam->getUserInfo();

        // avatar url
        $url = $steam->avatar;
        // get image
        $contents = file_get_contents($url);
        // hash url
        $name = md5($url).'.jpg';
        // path to image
        $path = 'public/avatars/' . $name;
        // save image
        Storage::put('/'. $path, $contents);

        $user->name = $steam->name;
        $user->steam_account_id = $steam->accountId;
        $user->avatar = $path;

        $user->save();

        toast('Synced With Steam Successfully!','success','top-right');

        return redirect()->route('users.show', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  \App\User $user
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function setCredits(Request $request, User $user){
        $this->authorize('update', $user);
        $this->authorize('ban', $user);

        $user->credits = $request->credits;

        $user->save();

        return redirect()->route('users.show', $user);
    }
}
