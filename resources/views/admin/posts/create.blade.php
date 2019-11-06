@extends ('layouts.admin')

@section("content")
    <h1>Create Posts</h1>

    {!! Form::open(['method' => 'POST', "action" => "AdminPostsController@store", "files"=> "true"]) !!}

    <div class = "form-group">
        {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
        @if($errors->has('title')) <p class="error">{{$errors->first('title') }}</p> @endif
        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
    </div>

    <div class = "form-group">
        {!! Form::label('body', 'Body', ['class' => 'control-label']) !!}
        @if($errors->has('body')) <p class="error">{{$errors->first('body') }}</p> @endif
        {!! Form::textarea('body', old('body'), ['class' => 'form-control']) !!}
    </div>

    <div class = "form-group">
        {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
        @if($errors->has('category_id')) <p class="error">{{$errors->first('category_id') }}</p> @endif
        {!! Form::select('category_id', ["" => "Choose Category"] + $categories, old('category_id'), ['class' => 'form-control']) !!}
    </div>

    <div class = "form-group">
        {!! Form::label('photo_path', 'Photo', ['class' => '']) !!}
        @if($errors->has('photo_path')) <p class="error">{{$errors->first('photo_path') }}</p> @endif
        {!! Form::file('photo_path',['class' => '']) !!}
    </div>

    <div class = "form-group">
        {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}
@include('includes.tinyeditor')
@stop
