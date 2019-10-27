
@extends ('layouts.admin');

@section("content")
    <h1>Edit Admin</h1>

    <div class="col-sm-3">
        <img class="img-responsive img-rounded" src="{{$post->photo_path}}">
    </div>

    <div class="col-sm-9">
        {!! Form::model($post, ['method' => 'PATCH', "action" => ["AdminPostsController@update", $post->id], "files"=> "true"]) !!}

        <div class = "form-group">
            {!! Form::label('title', 'Title', ['class' => 'control-label']) !!}
            {!! Form::text('title', $post->title, ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('body', 'Body', ['class' => 'control-label']) !!}
            {!! Form::textarea('body', $post->body, ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('category_id', 'Category', ['class' => 'control-label']) !!}
            {!! Form::select('category_id', ["" => "Choose Category"] + $categories, $post->category_id , ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('photo_path', 'Photo', ['class' => '']) !!}
            {!! Form::file('photo_path',['class' => '']) !!}
        </div>

        <div class = "form-group">
            {!! Form::submit('Edit Post', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

        {!! Form::model($post, ['method' => 'DELETE', "action" => ["AdminPostsController@destroy", $post->id]]) !!}

        <div>
            {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}
        </div>

        {!! Form::close() !!}

        <div>
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <li> {{$error}} </li>
                @endforeach
            @endif
        </div>
    </div>
@stop
