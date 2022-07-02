<?php

namespace App\Http\Controllers\Admin\Users;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Validator;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::paginate(15);

        $userCount = User::count();
    }

    /**
     * Show the form for creating a new resource.
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('', compact());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $steam = new SteamUser("[U:1:{$request->steam_account_id}]");

        $steam->getUserInfo();

        // avatar url
        $url = $steam->avatar;
        // get image
        $contents = file_get_contents($url);
        // hash url
        $name = md5($url).'.jpg';
        // public path for avi's
        $path = 'public/avatars/' . $name;
        // save image
        Storage::put('/'. $path, $contents);

        $user = User::where('steam_account_id', '=',  $steam->accountId)->firstOrCreate(
            ['steam_account_id' => $steam->accountId,],[
            'name' => $steam->name,
            'steam_account_id' => $steam->accountId,
            'slug' => $steam->steamId,
            'avatar' => $path,
        ]);
        app()['cache']->forget('spatie.permission.cache');
        $user->assignRole('User');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('', compact());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('', compact());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $messages = [
            'mimetypes' => 'Sorry, only donators can use gifs for their avatar. Consider becoming one! It directly supports the server uptime! (or you just uploaded a file we don\'t allow.)',
        ];

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
            'background' => 'nullable|image|max:2048',
            'post_background' => 'nullable|image|max:2048',
            'color' => 'sometimes',
        ];

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
    }
}
