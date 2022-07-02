@extends('layouts.master')

@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="{{ config('app.name') }}, {{config('app.url')}}, game servers, us game servers, garrysmod, us garrysmod servers, garrys mod, garrysmod, darkrp, Darkrp, darkRP, dark roleplay, dark role play">
    <meta name="description" content="{{ config('APP_NAME') }}. Good content, good servers, good fun.">
    <meta name="title" content="{{ config('app.name') }} - Darkrp | Dark Roleplay | US darkrp | dark rp server">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $user->name }}">
    <meta property="og:description" content="{{ \Illuminate\Support\Str::limit($user->plaintext, 150) }}">
    <meta property="og:type" content="Product">
    <meta property="og:image" content="{{ Storage::url($user->avatar) }}">
    <meta property="og:url" content="{{ route('users.show', $user->slug) }}">
    <meta content="summary_large_image" name="twitter:card">
    <meta content="{{ config('app.name') }}" name="twitter:site">
    <meta name="twitter:description" content="{{ \Illuminate\Support\Str::limit($user->plaintext, 150) }}">
    <meta name="twitter:image" content="{{ Storage::url($user->avatar) }}">
    <meta name="theme-color" content="#955799">
@endsection

@section('html-background', 'bg-brand-black')

@section('css')
    <style>
        body:before {
            z-index: -99999;
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            opacity: 0.5;
            height: 100%;
            @if($user->background !== null)
             background-image: url('{{ Storage::url($user->background) }}');
            @else
            background-image: url('https://i.imgur.com/kfywVO7.png');
            @endif
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }
    </style>
@endsection


@section('title', $user->name)

@section('content')
    <div class="container">
        <div class="col-12">
            @include('main.partials.errors')
        </div>
        {{ Breadcrumbs::render('user', $user) }}
        <div class="card bg-transparent border-0 w-100">
            <div class="card-body h-100">
                <div class="row h-100">
                    <div class="text-right col-12 d-sm-none d-md-block">
                        @include('main.users.partials.steam')
                        @auth
                            @if(Auth::user()->id === $user->id || Auth::user()->can('edit user'))
                                @include('main.users.partials.general')
                                @if(Auth::user()->donator_tier !== null)
                                    @include('main.users.partials.donator')
                                @endif
                            @endif
                            @can('edit user')
                                @if(Auth::user()->hasAnyRole(['Owner', 'Administrator']))
                                    @include('main.users.partials.admin')
                                @else
                                    @if($user->hasRole('Banned'))
                                        <form method="POST" action="{{ action('UserController@Ban', $user) }}">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger mx-1">
                                                Un-ban
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ action('UserController@Ban', $user) }}">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-danger mx-1">
                                                Ban
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            @endcan
                        @endauth
                    </div>
                    <div class="col-12">
                        <h1 class="text-light text-center" style="color:{{ $user->color }} !important;">{{ $user->name }}</h1>
                        <div class="avatar text-center">
                            <img src="{{ Storage::url($user->avatar) }}" class="avatar-lg avatar-rounded mx-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="d-flex flex-column">
                    <div class="d-flex flex-column justify-content-center align-items-center my-1">
                        <h4 class="text-light text-center">About me:</h4>
                        <div class="text-light">
                            @if($user->about !== null)
                                <static-quill-component :post='{{$user->about}}'></static-quill-component>
                            @endif
                        </div>
                    </div>
                    <div class="card-deck">
                        <div class="card bg-brand-black m-3" style="flex-basis: 210px">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h3 class="text-light">Rank</h3>
                                @if($user->hasAnyRole('Owner', 'Staff', 'Administrator'))
                                    <i class="fas fa-shield-check fa-fw fa-2x text-light py-2" v-tippy title="This user is a verified staff member"></i>
                                    @if($user->hasRole('Owner'))
                                        <h6 class="text-light">Owner</h6>
                                    @elseif($user->hasRole('Staff'))
                                        <h6 class="text-light">Staff</h6>
                                    @elseif($user->hasRole('Administrator'))
                                        <h6 class="text-light">Administrator</h6>
                                    @endif

                                @else
                                    <i class="fas fa-user fa-fw fa-2x text-light py-2"></i>
                                    <h6 class="text-light">{{$user->getRoleNames()->first()}}</h6>
                                @endif
                            </div>
                        </div>
                        <div class="card bg-brand-black m-3" style="flex-basis: 210px">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h3 class="text-light">Posts</h3>
                                <i class="fas fa-paste fa-fw fa-2x text-light py-2"></i>
                                <h6 class="text-light">{{ $user->post_count }}</h6>
                            </div>
                        </div>
                        <div class="card bg-brand-black m-3" style="flex-basis: 210px">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h3 class="text-light">Donator Tier</h3>
                                @if($user->donator_tier == null)
                                    <i class="fas fa-frown fa-fw fa-2x text-light py-2"></i>
                                    <h6 class="text-light">This user doesn't have a donator rank.</h6>
                                @else
                                    <i class="fas fa-crown fa-fw fa-2x text-light py-2"></i>
                                    @if($user->donator_tier === 'tier_1')
                                        <h6 class="text-light">V.I.P</h6>
                                    @elseif($user->donator_tier === 'tier_2')
                                        <h6 class="text-light">Ultra V.I.P</h6>
                                    @elseif($user->donator_tier === 'tier_3')
                                        <h6 class="text-light">MEME</h6>
                                    @elseif($user->donator_tier === 'tier_4')
                                        <h6 class="text-light">MEME GOD</h6>
                                    @else
                                        <h6 class="text-light">MEME LEGEND</h6>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <div class="card bg-brand-black m-3" style="flex-basis: 210px">
                            <div class="card-body d-flex flex-column justify-content-center align-items-center">
                                <h3 class="text-light">In-Game Money</h3>
                                <i class="fas fa-wallet fa-fw fa-2x text-light py-2"></i>
                                <h6 class="text-light">{{ \number_format(0 ?? 'Can\'t find your wallet. Sorry!') }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <h3 class="text-light text-center">Comments</h3>
            </div>
            <div class="col-12">
                <form method="POST" action="{{ route('users.comment.store', $user) }}">
                    <div class="card bg-brand-black">
                        <div class="card-body">
                            @method('POST')
                            @csrf
                            <div class="form-group">
                                <quill-component></quill-component>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button type="submit" class="waves-effect waves-light btn btn-success float-right">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12">
                @foreach($comments as $comment)
                    <div class="card my-3 bg-brand-black">
                        <div class="row no-gutters">
                            <div class="col-sm-12 col-md-3">
                                <div class="text-light">
                                    <div class="d-flex flex-row justify-content-center">
                                        <h4 class="text-center" style="color:{{ $comment->author->color }} !important;">{{ $comment->author->name }}</h4>
                                    </div>
                                    <div class="d-flex justify-content-center text-center">
                                        <a href="{{ route('users.show', $comment->author) }}" class="avatar my-3">
                                            <img class="avatar-lg avatar-rounded m-auto" src="{{ Storage::url($comment->author->avatar) }}">
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column text-center">
                                        <h6><span class="font-weight-bold">Posts:</span> {{ $comment->author->post_count ?? 0 }}</h6>
                                        @if($comment->author->hasAnyRole('Owner', 'Staff', 'Administrator'))
                                            <h5 class="role pb-1"><i class="fas fa-shield-check fa-fw text-light py-2 thread-staff" v-tippy title="This user is a verified staff member"></i> {{$comment->author->roles->first()->name}}</h5>
                                        @else
                                            <h5 class="role pb-1">{{$comment->author->getRoleNames()->first()}}</h5>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-9">
                                <div class="card-header bg-transparent border-0">
                                    <p class="text-muted card-text">
                                        Created: {{ $comment->created_at->diffForHumans() }} @if($comment->created_at->diffForHumans() !== $comment->updated_at->diffForHumans())· Updated: {{$comment->updated_at->diffForHumans()}} @endif
                                    </p>
                                </div>
                                <div class="card-body">
                                    <static-quill-component :post='{{ $comment->body }}' v-html></static-quill-component>
                                </div>
                                <div class="card-footer border-0 text-right d-flex justify-content-end">
                                    @auth
                                        @if(Auth::user()->id === $comment->author->id)
                                            <a href="{{ route('users.comment.edit', [$user, $comment])}}" class="btn btn-brand-white">Edit</a>
                                        @endif
                                        @if(Auth::user()->id === $comment->author->id | Auth::user()->hasAnyRole(['Owner', 'Staff', 'Administrator']))
                                            <form method="POST" class="mx-1" action="{{ route('users.comment.delete', [$user, $comment]) }}">
                                                @csrf
                                                @method('POST')
                                                <button type="submit" class="btn btn-danger">Delete Comment</button>
                                            </form>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{ $comments->links() }}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/spectrum/1.8.0/spectrum.min.css">
    <script>
        $('document').ready(function(){
            $("#color").spectrum({
                color: "{{ $user->color ?? '#EFEFEF' }}",
                preferredFormat: "hex",
                containerClassName: 'color-picker',
                showInput: true,
                cancelText: '',
                chooseText: 'close',
                move: function(color) {
                    $("#color").val(color.toHexString());
                }
            });
        });
    </script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.0/clipboard.min.js"></script>
@endsection
