@extends('layouts.master')
@section('meta')
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="weeb, weeb.cafe, game servers, us game servers, garrysmod, us garrysmod servers, garrys mod, garrysmod, darkrp, Darkrp, darkRP, dark roleplay, dark role play">
    <meta name="description" content="{{ str_limit($article->plaintext,  150) }}">
    <meta property="og:title" content="{{ config('app.name') }}">
    <meta property="og:site_name" content="{{ config('app.name') }}">
    <meta property="og:title" content="{{ $article->title }}">
    <meta property="og:description" content="{{ str_limit($article->plaintext, 150) }}">
    <meta property="og:type" content="Product">
    <meta property="og:image" content="{{ Storage::url($article->image) }}">
    <meta property="og:url" content="{{ route('articles.show', $article) }}">
    <meta content="summary_large_image" name="twitter:card">
    <meta content="{{ '@ . ' . config('app.name') }}" name="twitter:site">
    <meta name="twitter:description" content="{{ str_limit($article->plaintext, 150) }}">
    <meta name="twitter:image" content="{{ Storage::url($article->image) }}">
    <meta name="theme-color" content="{{ $article->user->color }}">
@endsection

@section('css')
    <style>
        .news-img-overlay::before{
            background: url('{{ Storage::url($article->image) }}') no-repeat center;
        }
    </style>
@endsection

@section('body-background', 'bg-brand-black')
@section('title')
    {{ 'News - ' . $article->title }}
@endsection


@section('content')
    <section class="d-flex flex-column position-relative justify-content-between news-img-overlay" style="min-height: 500px; padding: 15rem 0 1em;">
        <div class="text-center brand position-relative">
            <h1 class="text-light">{{ $article->title }}</h1>
            <h6 class="text-light">By: <a href="{{ route('users.show', $article->user) }}" class="avatar">
                    {{ $article->user->name }}
                </a></h6>
            <p class="text-muted"> {{ $article->created_at->diffForHumans() }}</p>
            @auth
                @can('edit news')
                    <a href="{{ route('articles.edit', [$article])}}" class="btn btn-brand-white">Edit</a>
                @endcan
            @endauth
        </div>
    </section>
    <section class="d-flex flex-column position-relative justify-content-between  " style="min-height: 600px; padding: 2rem 0 2rem;">
        <div class="container">
            <div>
                {{ Breadcrumbs::render('article', $article) }}
            </div>
            <div class="d-flex flex-column h-100 justify-content-center align-items-center text-light">
                <div class="card bg-brand-black shadow-sm">
                    <div class="card-body">
                        <div class="container">
                            <static-quill-component :post='{{$article->body}}'></static-quill-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="d-flex flex-column position-relative justify-content-between" style="min-height: 500px; padding: 10rem 0 5rem;">
        <div class="text-center mx-auto">
            <h5 class="text-muted">Author</h5>
            <div class="card bg-brand-black shadow-sm" style="min-width: 250px !important;">
                <div class="card-body d-flex flex-row justify-content-center align-items-center">
                    <hovercard-component id="template_article_{{ $article->id }}" v-tippy-html slug="{{ $article->user->slug }}" base_site="{{ env('APP_URL') }}" site="{{ env('APP_API_URL') }}" avatar="{{ Storage::url($article->user->avatar) }}" rank="{{ $article->user->getRoleNames()->first() }}"></hovercard-component>
                    <a href="{{ route('users.show', $article->user) }}" class="avatar" v-tippy="{ html:  '#template_article_{{ $article->id }}', reactive : true, interactive : true, theme : 'transparent', placement : 'right', animateFill : false }">
                        <img src="{{ Storage::url($article->user->avatar) }}" class="avatar-img avatar-img-md template_article_{{ $article->id }}">
                    </a>
                    <div class="d-flex flex-column mx-2 my-auto h-100 text-left">
                        <a href="{{ route('users.show', $article->user) }}" class="card-link">
                            <h5 class="text-light mb-0">{{ $article->user->name }}</h5>
                        </a>
                        @if($article->user->hasAnyRole('Owner', 'Moderator', 'Administrator'))
                            <h5 class="role pb-1 text-light mb-0"><i class="fas fa-shield-check fa-fw fa-xs text-light py-2 thread-staff" title="This user is a verified staff member"></i> {{$article->user->roles->first()->name}}</h5>
                        @else
                            <h5 class="role pb-1 text-ligh mb-0t">{{$article->user->roles->first()->name}}</h5>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
