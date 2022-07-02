@extends('layouts.master')
@section('title', 'Forums')

@section('body-background', 'bg-brand-black')


@section('content')
    <section class="d-flex flex-column position-relative brand bg-brand-black" style="min-height: 100vh; padding: 10rem 0 10rem;">
        <div class="container">
            <div class="d-flex flex-column position-relative my-auto brand">
                @include('main.partials.errors')
                <form method="POST" class="py-3 form-group text-white" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                    @method('POST')
                    @csrf
                    <div class="input-field py-3 form-group">
                        <input type="text" name="title" id="titleInput" aria-describedby="titleHelp">
                        <label for="titleInput">Enter Category Title</label>
                    </div>
                    <div class="input-field py-3 form-group">
                        <input type="text" id="description" name="description">
                        <label for="description">Enter Description</label>
                    </div>
                    <div class="input-field py-3 form-group">
                        <input type="text" class="form-control" id="fontawesome" name="fontawesome">
                        <label for="fontawesome" class="text-white">Font Awesome</label>
                    </div>
                    <div class="file-field input-field py-3 form-group">
                        <div class="btn btn-success waves-effect d-flex text-center justify-content-center align-items-center">
                            <span>File</span>
                            <input type="file" name="background" id="background">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Upload Category Background Image">
                        </div>
                    </div>
                    <div class="input-field py-3 form-group">
                        <select id="parent_id" name="parent_id">
                            <option value="" selected>none</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                        <label for="parent_id">Parent</label>
                    </div>
                    <div class="input-field py-3 form-group">
                        <input type="number" name="weight" class="form-control" id="weight" value="1">
                        <label for="weight" class="text-white">Weight</label>
                    </div>
                    <div class="input-field py-3 form-group">
                        <select id="locked" name="locked">
                            <option value="0" selected>False</option>
                            <option value="1">True</option>
                        </select>
                        <label for="locked">Only staff can post?</label>
                    </div>
                    <div class="input-field py-3 form-group">
                        <select id="private" name="private">
                            <option value="0" selected>False</option>
                            <option value="1">True</option>`
                        </select>
                        <label for="private" class="text-white">Only visible to staff?</label>
                    </div>
                    <div class="input-field py-3 form-group">
                        <input type='text' id="color" name="color" value="#EFEFEF" />
                        <label for="color" class="text-light">Select a Color</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </section>
@endsection
@section('scripts')
    <script>
        $('document').ready(function(){
            $("#color").spectrum({
                color: "#EFEFEF",
                preferredFormat: "hex",
                containerClassName: 'color-picker',
                cancelText: '',
                chooseText: 'close',
                move: function(color) {
                    $("#color").val(color.toHexString());
                }
            });

            $('#parent_id').formSelect();
            $('#locked').formSelect();
            $('#private').formSelect();
        });

    </script>
@endsection
