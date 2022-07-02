@extends('layouts.master')
@section('title')
    {{'Forums - ' . $category->title}}
@endsection

@section('body-background', 'bg-brand-black')


@section('content')
    <div class="container" style="min-height: 75vh;">
        <div class="col-12">
            <div class="alert alert-warning">
                <h3>Seriously: if you post stupid shit, you will be banned.</h3>
                <p class="mb-0">If you have to question whether what you're posting is appropriate, it's probably not.</p>
            </div>
        </div>
        <div class="col-12">
            {{ Breadcrumbs::render('category', $category) }}
        </div>
        <div class="col-12">
            @include('main.partials.errors')
        </div>
        <div class="col-12">
            <form method="POST" action="{{ action('ThreadController@Store', $category->slug) }}">
                <div class="card bg-brand-dark-grey">
                    <div class="card-body">
                        @method('POST')
                        @csrf
                        <div class="form-group">
                            <label for="titleInput" class="text-white">Enter Post Title</label>
                            <input type="text" class="form-control validate" name="title" id="titleInput" aria-describedby="titleHelp" placeholder="Title..." required>
                        </div>
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
    </div>
@endsection
