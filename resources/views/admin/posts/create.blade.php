@extends ('layouts.admin');

@section("content")
    <h1>Create Posts</h1>

    {!! Form::open(['method' => 'POST', "action" => "AdminPostsController@store", "files"=> "true"]) !!}

    <div class = "form-group">
        {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
        {!! Form::text('title', old('title'), ['class' => 'form-control']) !!}
    </div>

    <div class = "form-group">
        {!! Form::label('body', 'Body', ['class' => 'control-label']) !!}
        {!! Form::textarea('body', old('body'), ['class' => 'form-control']) !!}
    </div>

    <div class = "form-group">
        {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
        {!! Form::select('category_id', ["" => "Choose Category"] + $categories, old('category_id'), ['class' => 'form-control']) !!}
    </div>

    <div class = "form-group">
        {!! Form::label('photo_path', 'Photo', ['class' => '']) !!}
        {!! Form::file('photo_path',['class' => '']) !!}
    </div>

    <div class = "form-group">
        {!! Form::submit('Create Post', ['class' => 'btn btn-primary']) !!}
    </div>

    {!! Form::close() !!}

    <div>
        @if($errors->any())
            @foreach($errors->all() as $error)
                <li> {{$error}} </li>
            @endforeach
        @endif
    </div>

@stop
