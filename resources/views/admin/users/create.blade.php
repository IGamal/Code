@extends ('layouts.admin');

@section("content")
    <h1>Create Admin</h1>

    {!! Form::open(['method' => 'POST', "action" => "AdminUsersController@store", "files"=> "true"]) !!}

        <div class = "form-group">
            {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
            {!! Form::email('email', null, ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('role_id', 'Role', ['class' => 'control-label']) !!}
            {!! Form::select('role_id', ['' => 'Choose a Role', 0 => "User", 1 => "Admin"] , null , ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('is_active', 'Active', ['class' => 'control-label']) !!}
            {!! Form::select('is_active', array(1 => "Active", 0 => "Not Active") , 0 , ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('confirm_password', 'Confirm Password', ['class' => 'control-label']) !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('photo_path', 'Photo', ['class' => '']) !!}
            {!! Form::file('photo_path',['class' => '']) !!}
        </div>

        <div class = "form-group">
            {!! Form::submit('Add Admin', ['class' => 'btn btn-primary']) !!}
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
