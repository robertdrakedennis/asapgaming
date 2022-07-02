@extends('layouts.master')
@section('css')
    @if($user->background !== null)
        <style>
            .avatar-img-overlay::before{
                background: url('{{ Storage::url($user->background) }}') no-repeat center;
            }
        </style>
    @endif
@endsection
@section('title', 'Editing - ' . $user->name)

@section('body-background', 'bg-brand-black')


@section('content')
    <section class="d-flex flex-column position-relative justify-content-between avatar-img-overlay" style="min-height: 700px; padding: 10rem 0 5rem;">
        <div class="container">
            <div class="text-light position-relative">
                {{ Breadcrumbs::render('user', $user) }}
                @include('main.partials.errors')
                <article class="community-post bg-brand-darker-grey w-100 mb-3">
                    <div class="post-inner d-sm-block d-md-block d-lg-flex d-xl-flex">
                        <div class="post-cell-main text-white" style="min-height: 600px;">
                            <div class="d-flex h-100 flex-column">
                                <div class="inner">
                                    <ul class="nav nav-tabs justify-content-center position-relative" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active mx-1 text-light dont-fade" style="z-index: 9999" id="general-tab" data-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true">General</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link mx-1 text-light dont-fade" style="z-index: 9999" id="donator-tab" data-toggle="tab" href="#donator" role="tab" aria-controls="donator" aria-selected="false">Donator</a>
                                        </li>
                                        @can('edit user')
                                            <li class="nav-item">
                                                <a class="nav-link mx-1 text-light dont-fade" style="z-index: 9999" id="moderator-tab" data-toggle="tab" href="#moderator" role="tab" aria-controls="moderator" aria-selected="false">Moderator</a>
                                            </li>
                                        @endcan
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="general" role="tabpanel" aria-labelledby="general-tab">
                                            <form method="POST" action="{{ action('UserController@Update', $user) }}" enctype="multipart/form-data">
                                                @method('PATCH')
                                                @csrf
                                                <div class="form-group">
                                                    <div class="input-field">
                                                        <label for="titleInput" class="text-white">Name</label>
                                                        <input type="text" class="form-control" name="name" class="text-light" id="titleInput" aria-describedby="titleHelp" value="{{ $user->name }}">
                                                    </div>
                                                </div>
                                                <quill-component></quill-component>
                                                <div class="custom-file mb-2">
                                                    <input type="file" class="custom-file-input" name="avatar" id="avatar">
                                                    <label class="custom-file-label bg-brand-black text-light" for="avatar">Upload Avatar</label>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                            <form method="POST" action="{{ action('UserController@syncWithSteam', $user) }}">
                                                @method('POST')
                                                @csrf
                                                <div class="my-2">
                                                    <button type="submit" class="btn btn-default">
                                                        <i class="fab fa-steam-symbol fa-fw"></i> Sync with steam
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                        @if($user->donator_tier != null || $user->hasAnyRole(['Owner', 'Administrator', 'Staff']))
                                            <div class="tab-pane fade" id="donator" role="tabpanel" aria-labelledby="donator-tab">
                                                <div class="alert alert-warning m-3">
                                                    Seriously, do not abuse these features. You will have your status permanently revoked immediately if you do so.
                                                </div>
                                                <form method="POST" action="{{ action('UserController@Update', $user) }}" enctype="multipart/form-data">
                                                    @method('PATCH')
                                                    @csrf
                                                    <div class="form-group">
                                                        <label for="titleInput" class="text-white">Custom url: your current custom url is: <code>{{ env('APP_URL') }}/users/{{$user->slug}}</code></label>
                                                        <input type="text" name="slug" class="form-control" id="titleInput" aria-describedby="titleHelp">
                                                    </div>
                                                    <div class="custom-file mb-3">
                                                        <input type="file" class="custom-file-input" name="background" id="background">
                                                        <label class="custom-file-label bg-brand-black text-light" for="background">Upload Background</label>
                                                    </div>

                                                    <div class="custom-file mb-3">
                                                        <input type="file" class="custom-file-input" name="post_background" id="post_background">
                                                        <label class="custom-file-label bg-brand-black text-light" for="post_background">Upload Post Background</label>
                                                    </div>

                                                    <div class="form-group">
                                                        <label for="color" class="text-light">Select a Color</label>
                                                        <input type='text' id="color" />
                                                    </div>

                                                    <button type="submit" class="btn btn-primary my-2">Submit</button>
                                                </form>
                                            </div>
                                        @else
                                            <div class="tab-pane fade" id="donator" role="tabpanel" aria-labelledby="donator-tab">
                                                <div class="d-flex flex-column text-center justify-content-center align-items-center">
                                                    <i class="far fa-sad-tear fa-fw fa-4x p-3"></i>
                                                    <p class="text-white">
                                                        Looks like you aren't a donator , by <a href="{{ route('store') }}" class="text-light font-weight-bold">purchasing credits</a> you can unlock prime, which will grant you all of these features!
                                                    </p>
                                                </div>
                                            </div>
                                        @endif
                                        @can('edit rank')
                                            <div class="tab-pane fade" id="moderator" role="tabpanel" aria-labelledby="moderator-tab">
                                                <form method="POST" class="" action="{{ action('UserController@setRank', $user) }}">
                                                    @method('POST')
                                                    @csrf
                                                    <div class="form-group my-2">
                                                        <label for="role">Choose Role</label>
                                                        <select class="form-control" id="role" name="role">
                                                            @foreach($roles as $role)
                                                                <option value="{{$role->name}}" @if($role->name == $user->roles()->first()->name) selected @endif> {{$role->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <button type="submit" class="waves-effect waves-light btn btn-primary m-2 float-right">Set Rank</button>
                                                </form>

                                                <form method="POST" class="my-5" action="{{ action('UserController@setCredits', $user) }}">
                                                    @method('POST')
                                                    @csrf
                                                    <div class="form-group my-2">
                                                        <input id="credits" class="form-control" name="credits" type="number" value="{{ $user->credits }}">
                                                        <label for="credits">Set Credits</label>
                                                    </div>
                                                    <button type="submit" class="waves-effect waves-light btn btn-primary m-2 float-right">Set Credits</button>
                                                </form>
                                            </div>
                                        @endcan
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
            </div>
        </div>
    </section>
    <section class="d-flex flex-column position-relative justify-content-between" style="min-height: 600px; padding: 10rem 0 20rem;"></section>
@endsection
