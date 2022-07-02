@extends('layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="weeb, weeb.cafe, game servers, uk game servers, garrysmod, us garrysmod servers, garrys mod, garrysmod, darkrp, Darkrp, darkRP, dark roleplay, dark role play">
    <meta name="description" content="{{ str_limit($thread->plaintext, 150) }}">
    <meta name="title" content="{{ config('app.name') }} - Darkrp | Dark Roleplay | US darkrp | dark rp server">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $thread->title }}">
    <meta property="og:description" content="{{ str_limit($thread->plaintext, 150) }}">
    <meta property="og:type" content="Product">
    <meta property="og:image" content="{{ Storage::url($thread->user->avatar) }}">
    <meta property="og:url" content="{{ route('threads.show', [$category, $thread]) }}">
    <meta content="summary_large_image" name="twitter:card">
    <meta content="{{ '@ . ' . config('app.name') }}" name="twitter:site">
    <meta name="twitter:description" content="{{ str_limit($thread->plaintext, 150) }}">
    <meta name="twitter:image" content="{{ Storage::url($thread->user->avatar) }}">
    @if($thread->user->color === null)
        <meta name="theme-color" content="#955799">
    @else
        <meta name="theme-color" content="{{ $thread->user->color }}">
    @endif
@endsection

@section('body-background', 'bg-brand-black')

@section('css')
    {{--    @include('main.forums.thread.partials.css.avatar')--}}
@endsection
@section('title')
    {{ 'Forums - Thread - ' . $thread->title }}
@endsection

@section('content')
    <div class="container">
        @include('main.partials.errors')
        <div class="row">
            <div class="col-12">
                <div>
                    <h3 class="text-light">
                        @if($thread->isLocked)
                            <i class="fas fa-fw fa-xs fa-lock text-danger"></i>
                        @endif
                        @if($thread->isPinned)
                            <i class="fas fa-fw fa-xs fa-thumbtack text-success"></i>
                        @endif
                        {{ $thread->title }}
                    </h3>
                </div>
            </div>
        </div>
        {{ Breadcrumbs::render('thread', $category, $thread) }}

        <div class="row">
            <div class="col-12">
                <div class="float-right">
                    @if($thread->getIsSubscribedToAttribute())
                        <form method="POST" class="m-2 text-right float-right" action="{{ action('Subscriptions\ThreadSubscriptionsController@destroy', [$category, $thread]) }}">
                            @method('POST')
                            @csrf
                            <button type="submit" class="waves-effect btn btn-warning float-right my-4">Unsubscribe</button>
                        </form>
                    @else
                        <form method="POST" class="m-2 text-right float-right" action="{{ action('Subscriptions\ThreadSubscriptionsController@store', [$category, $thread]) }}">
                            @method('POST')
                            @csrf
                            <button type="submit" class="waves-effect btn btn-primary float-right my-4">Subscribe</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <div class="card mb-3 bg-brand-darker-grey">
            <div class="row no-gutters">
                <div class="col-sm-12 col-md-3 text-light">
                    @if($thread->user->post_background !== null)
                        <img src="{{ Storage::url($thread->user->post_background) }}" class="card-img">
                    @else
                        <img src="{{ env('DEFAULT_USER_BACKGROUND') }}" class="card-img">
                    @endif
                        <div class="card-img-overlay text-light">
                            <div class="d-flex flex-row justify-content-center">
                                <h4 class="text-center" style="color:{{ $thread->user->color }} !important;">{{ $thread->user->name }} <span class="badge badge-secondary thread-op" v-tippy title="This user is the author of this thread.">OP</span></h4>
                            </div>
                            <div class="d-flex justify-content-center text-center">
                                <a href="{{ route('users.show', $thread->user) }}" class="avatar my-3">
                                    <img class="avatar-lg avatar-rounded m-auto" src="{{ Storage::url($thread->user->avatar) }}">

                                </a>
                            </div>
                            <div class="d-flex flex-column text-center">
                                <h6><span class="font-weight-bold">Posts:</span> {{ $thread->user->post_count ?? 0 }}</h6>
                                @if($thread->user->hasAnyRole('Owner', 'Staff', 'Administrator'))
                                    <h5 class="role pb-1"><i class="fas fa-shield-check fa-fw text-light py-2 thread-staff" v-tippy title="This user is a verified staff member"></i> {{$thread->user->roles->first()->name}}</h5>
                                @else
                                    <h5 class="role pb-1">{{$thread->user->getRoleNames()->first()}}</h5>
                                @endif
                            </div>
                        </div>
                </div>
                <div class="col-sm-12 col-md-9">
                    <div class="card-header">
                        <p class="card-text text-muted">
                            Created: {{ $thread->created_at->diffForHumans() }} @if($thread->created_at->diffForHumans() !== $thread->updated_at->diffForHumans())· Updated: {{$thread->updated_at->diffForHumans()}} @endif
                        </p>
                    </div>
                    <div class="card-body">
                        <static-quill-component :post='{{ $thread->body }}' v-html></static-quill-component>
                    </div>
                    <div class="card-footer text-right border-0">
                        @auth
                            @if(Auth::user()->id === $thread->user_id)
                                <a href="{{ route('threads.edit', [$category, $thread])}}" class="btn btn-brand-white">Edit</a>
                            @endif
                            @can('edit thread')
                                @include('main.forums.thread.partials.moderator.thread.modal')
                            @endcan
                        @endauth
                    </div>
                </div>
            </div>
        </div>

        @foreach($replies as $reply)
            <div class="card mb-3 bg-brand-dark-grey">
                <div class="row no-gutters">
                    <div class="col-sm-12 col-md-3 card-img-fade">
                        @if($reply->user->post_background !== null)
                            <img src="{{ Storage::url($reply->user->post_background) }}" class="card-img">
                        @else
                            <img src="{{ env('DEFAULT_USER_BACKGROUND') }}" class="card-img">
                        @endif
                        <div class="card-img-overlay text-light">
                            <div class="d-flex flex-row justify-content-center">
                                <h4 class="text-center" style="color:{{ $reply->user->color }} !important;">{{ $reply->user->name }} @if($thread->user->id === $reply->user->id) <span class="badge badge-secondary thread-op" v-tippy title="This user is the author of this thread.">OP</span> @endif</h4>
                            </div>
                            <div class="d-flex justify-content-center text-center">
                                <a href="{{ route('users.show', $reply->user) }}" class="avatar my-3">
                                    <img class="avatar-lg avatar-rounded m-auto" src="{{ Storage::url($reply->user->avatar) }}">
                                </a>
                            </div>
                            <div class="d-flex flex-column text-center">
                                <h6><span class="font-weight-bold">Posts:</span> {{ $reply->user->post_count ?? 0 }}</h6>
                                @if($reply->user->hasAnyRole('Owner', 'Staff', 'Administrator'))
                                    <h5 class="role pb-1"><i class="fas fa-shield-check fa-fw text-light py-2 thread-staff" v-tippy title="This user is a verified staff member"></i> {{$reply->user->roles->first()->name}}</h5>
                                @else
                                    <h5 class="role pb-1">{{$reply->user->getRoleNames()->first()}}</h5>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-9">
                        <div class="card-header">
                            <p class="text-muted card-text">
                                Created: {{ $reply->created_at->diffForHumans() }} @if($reply->created_at->diffForHumans() !== $reply->updated_at->diffForHumans())· Updated: {{$reply->updated_at->diffForHumans()}} @endif
                            </p>
                        </div>
                        <div class="card-body">
                            <static-quill-component :post='{{ $reply->body }}' v-html></static-quill-component>
                        </div>
                        <div class="card-footer border-0 text-right">
                            @auth
                                @if(Auth::user()->id === $reply->user_id)
                                    <a href="{{ route('replies.edit', [$category, $thread, $reply])}}" class="btn btn-brand-white">Edit</a>
                                @endif
                                @can('edit thread')
                                    @include('main.forums.thread.partials.moderator.reply.modal')
                                @endcan
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

        {{ $replies->links() }}
        @guest
            <h3 class="text-light text-center"> You must login to reply.</h3>
        @endguest
        @auth
            <div class="row">
                <div class="col-12">
                    <div class="card bg-brand-dark-grey">
                        <div class="card-header bg-transparent">
                            <h3 class="text-light">Post a reply</h3>
                        </div>
                        <div class=card-body">
                            @if($thread->isLocked)
                                <h3 class="text-light">Thread is locked.</h3>
                                @can('edit thread')
                                    <form method="POST" class="m-2 text-left" action="{{ action('ReplyController@Store', [$category, $thread]) }}">
                                        @method('POST')
                                        @csrf
                                        <quill-component></quill-component>
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                @endcan
                            @else
                                <form method="POST" class="m-2 text-left" action="{{ action('ReplyController@Store', [$category, $thread]) }}">
                                    @method('POST')
                                    @csrf
                                    <quill-component></quill-component>
                                    <button type="submit" class="waves-effect btn btn-success float-right my-4">Submit</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endauth
    </div>
@endsection

@section('scripts')
    <script>
        $('#category').formSelect();
    </script>
@endsection
