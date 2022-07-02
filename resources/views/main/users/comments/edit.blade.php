@extends('layouts.master')


@section('body-background', 'bg-brand-black')


@section('content')
    <div class="container" style="min-height: 75vh;">

        <div class="col-12">
            {{ Breadcrumbs::render('user', $user) }}
        </div>

        <div class="col-12">
            @include('main.partials.errors')
        </div>

        <div class="col-12">
            <form method="POST" action="{{ route('users.comment.update', [$user, $comment]) }}">
                <div class="card bg-brand-black">
                    <div class="card-body">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <quill-component :post='{{$comment->body}}'></quill-component>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <button type="submit" class="waves-effect waves-light btn btn-success float-right">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
