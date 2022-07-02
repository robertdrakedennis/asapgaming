@extends('layouts.master')
@section('title', 'Forums')

@section('body-background', 'bg-brand-black')


@section('content')
    <div class="container">
        <div>
            {{ Breadcrumbs::render('forums') }}
        </div>
        @foreach($categories as $category)
            <div class="card bg-brand-darkest-grey mb-5">
                <div class="card-header bg-brand-darker-grey">
                    <h3 class="text-light">@if($category->isPrivate) <i class="fas fa-fw fa-xs fa-rocket text-light"></i> @endif {{$category->title}}</h3>
                </div>
                <div class="d-block">
                    @foreach($category->children as $child)
                        <div class="d-flex flex-row my-2 w-100">
                            <div class="d-sm-none d-md-flex p-2 align-items-center">
                                <i class="{{ $child->fontawesome }} fa-fw fa-2x" style="color: {{ $child->color }}"></i>
                            </div>
                            <div class="d-flex flex-fill flex-column pl-sm-4 pl-md-0">
                                <div class="my-auto">
                                    <h5 class="text-white mb-1">
                                        @if($child->isLocked)
                                            <i class="fas fa-fw fa-xs fa-lock text-danger"></i>
                                        @endif
                                        @if($child->isPrivate)
                                            <i class="fas fa-fw fa-xs fa-rocket text-light"></i>
                                        @endif
                                        <a class="text-white card-link" href="{{route('categories.show', $child)}}">{{$child->title}}</a>
                                    </h5>
                                    <span class="text-muted">Threads: {{$child->thread_count}}</span>
                                </div>
                            </div>
                            <div class="d-sm-none d-md-flex justify-content-center mr-4">
                                @if($child->latestThread == null)
                                    <div class="my-auto">
                                        <p class="text-white text-center">there are no threads.</p>
                                    </div>
                                @else
                                    <div class="d-sm-none d-md-flex flex-column">
                                        <div class="ml-auto">
                                            <hovercard-component id="template_forum_{{$child->latestThread->id}}" v-tippy-html slug="{{ $child->latestThread->user->slug }}" base_site="{{ env('APP_URL') }}" site="{{ env('APP_API_URL') }}" avatar="{{ Storage::url($child->latestThread->user->avatar) }}" rank="{{ $child->latestThread->user->getRoleNames()->first() }}"></hovercard-component>
                                            <a href="{{route('users.show',  $child->latestThread->user)}}" class="avatar" v-tippy="{ html:  '#template_forum_{{$child->latestThread->id}}', reactive : true, interactive : true, theme : 'transparent', animateFill : false, placement : 'left' }">
                                                <img src="{{ Storage::url($child->latestThread->user->avatar) }}" class="avatar-sm avatar-rounded">
                                            </a>
                                        </div>
                                        <div class="text-white ml-auto">
                                            @if($child->latestThread->isLocked)
                                                <i class="fas fa-fw fa-xs fa-lock text-danger"></i>
                                            @endif
                                            @if($child->latestThread->isPinned)
                                                <i class="fas fa-fw fa-xs fa-thumbtack text-success"></i>
                                            @endif
                                            <a href="{{route('threads.show',[ $child, $child->latestThread])}}" class="card-link">
                                                {{ \Illuminate\Support\Str::limit($child->latestThread->title, 30) }}
                                            </a>
                                        </div>
                                        <div class="text-white ml-auto">
                                            <time dir="auto">{{ date('M d Y', $child->latestThread->created_at->timestamp) }}</time>
                                            <a href="{{route('users.show',  $child->latestThread->user->slug)}}" class="card-link" style="color:{{ $child->latestThread->user->color }} !important;">{{ $child->latestThread->user->name }}</a>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection
