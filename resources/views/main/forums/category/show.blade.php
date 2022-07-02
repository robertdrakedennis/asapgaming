@extends('layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="xenin, xenin.co, game servers, us game servers, garrysmod, us garrysmod servers, garrys mod, garrysmod, darkrp, Darkrp, darkRP, dark roleplay, dark role play">
    <meta name="description" content="{{ $category->description }}">
    <meta name="title" content="Xenin - Darkrp | Dark Roleplay | US darkrp | dark rp server">
    <meta property="og:site_name" content="Xenin">
    <meta property="og:title" content="{{ $category->title }}">
    <meta property="og:description" content="{{ $category->description }}">
    <meta property="og:type" content="Product">
    <meta property="og:image" content="{{ Storage::url($category->background) }}">
    <meta property="og:url" content="{{ route('categories.show', $category) }}">
    <meta content="summary_large_image" name="twitter:card">
    <meta content="@xeninco" name="twitter:site">
    <meta name="twitter:description" content="{{ $category->description }}">
    <meta name="twitter:image" content="{{ Storage::url($category->background) }}">
    <meta name="theme-color" content="#955799">
@endsection
@section('title')
    {{ 'Forums - ' . $category->slug }}
@endsection

@section('body-background', 'bg-brand-black')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="jumbotron bg-transparent text-center">
                    <h1 class="text-white text pb-2">{{$category->title}}</h1>
                    <p class="text-white sub-text pb-2">{{$category->description}}</p>
                </div>
                @include('main.partials.errors')
            </div>
            <div class="col-12">
                {{ Breadcrumbs::render('category', $category) }}
                <div class="py-3 d-flex">
                    <div class="ml-sm-auto ml-md-auto">
                        <div class="d-flex flex-row">
                            @auth
                                @if($category->isLocked)
                                    @can('edit thread')
                                        <a href="{{ route('threads.create', $category) }}" class="waves-effect waves-light btn btn-primary mx-1">Create Thread</a>
                                    @else
                                        <a href="#" class="btn btn-primary mx-1 disabled">This category is locked</a>
                                    @endcan
                                @else
                                    <a href="{{ route('threads.create', $category) }}" class="waves-effect waves-light btn btn-primary mx-1">Create Thread</a>
                                @endif
                                @can('edit category')
                                    @include('main.forums.category.partials.moderator.modal')
                                @endcan
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12">
                <div class="card bg-brand-darkest-grey">
                    <div class="d-flex flex-column">
                        @foreach($threads as $thread)
                            <div class="d-flex flex-row m-2 @if($thread->trashed()) border border-danger @endif">
                                <div class="d-sm-none d-md-flex p-2 justify-content-center avatar">
                                    <hovercard-component id="template_category_{{$thread->id}}" v-tippy-html slug="{{ $thread->user->slug }}" base_site="{{ env('APP_URL') }}" site="{{ env('APP_API_URL') }}" avatar="{{ Storage::url($thread->user->avatar) }}" rank="{{ $thread->user->getRoleNames()->first() }}"></hovercard-component>
                                    <a href="{{ route('users.show', $thread->user) }}" v-tippy="{ html:  '#template_category_{{$thread->id}}', reactive : true, interactive : true, theme : 'transparent', animateFill : false, placement : 'right' }">
                                        <img src="{{ Storage::url($thread->user->avatar) }}" class="avatar-sm avatar-rounded" alt="">
                                    </a>
                                </div>
                                <div class="d-flex flex-column flex-fill">
                                    <div>
                                        <h5 class="text-white">
                                            @if($thread->isPinned) <i class="fas fa-fw fa-xs fa-thumbtack text-success"></i> @endif
                                            <a class="text-white card-link text-truncate" href="{{route('threads.show', [$category, $thread])}}">{{ \Illuminate\Support\Str::limit($thread->title, 35) }}</a>
                                        </h5>
                                    </div>
                                    <div class="text-white">
                                        <div class="d-flex flex-row">
                                            <div class="mx-1">
                                                <time dir="auto">{{ $thread->created_at->diffForHumans() }}</time>
                                            </div>
                                            <div class="mx-1">
                                                <a href="{{route('users.show', $thread->user)}}" class="card-link" style="color:{{ $thread->user->color }} !important;">{{  $thread->user->name }}</a>
                                            </div>
                                            <div class="mx-1">
                                                Replies: {{ $thread->reply_count}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($thread->trashed())
                                    <div class="d-flex flex-column justify-content-end">
                                        <form method="POST" action="{{ action('ThreadController@Restore', [$category, $thread]) }}">
                                            @method('POST')
                                            @csrf
                                            <button type="submit" class="btn btn-warning">Restore</button>
                                        </form>
                                    </div>
                                @else
                                    <div class="d-sm-none d-md-flex flex-column justify-content-end">
                                        @if($thread->reply_count == 0)
                                            <div class="d-flex flex-column m-auto">
                                                <a class="text-white" href="{{route('threads.show', [$category, $thread])}}">{{ $thread->created_at->diffForHumans() }}</a>
                                                <a class="text-right" href="{{route('threads.show', [$category, $thread])}}" style="color:{{ $thread->user->color }} !important;">{{ $thread->user->name }}</a>
                                            </div>
                                        @else
                                            <div class="d-flex flex-column m-auto">
                                                <a class="text-white card-link" href="{{route('threads.show', [$category, $thread])}}">{{  $thread->latestReply->created_at->diffForHumans() }}</a>
                                                <a class="text-right" href="{{route('threads.show', [$category, $thread])}}" style="color:{{ $thread->user->color }} !important;">{{$thread->latestReply->user->name }}</a>
                                            </div>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="mx-5 pt-3">
                    {{ $threads->links() }}
                </div>
            </div>
        </div>
        <div>
        </div>
    </div>
@endsection
