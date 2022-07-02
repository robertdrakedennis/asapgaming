@extends('layouts.master')
@section('title', 'Forums')

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
            {{ Breadcrumbs::render('thread', $category, $thread) }}
        </div>
        <div class="col-12">
            @include('main.partials.errors')
        </div>
        <div class="col-12">
            <form method="POST" class="text-left my-4" action="{{ action('ThreadController@Update', [$category, $thread]) }}">
                <div class="card bg-brand-dark-grey">
                    <div class="card-body">
                        @method('PATCH')
                        @csrf
                        <div class="form-group">
                            <quill-component :post='{{ $thread->body }}' v-html></quill-component>
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

