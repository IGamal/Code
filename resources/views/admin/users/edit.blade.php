@extends ('layouts.admin');

@section("content")
    <h1>Edit Admin</h1>

    <div class="col-sm-3">
        <img class="img-responsive img-rounded" src="{{$user->photo_path}}">
    </div>

    <div class="col-sm-9">
        {!! Form::model($user, ['method' => 'PATCH', "action" => ["AdminUsersController@update", $user->id], "files"=> "true"]) !!}

        <div class = "form-group">
            {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
            {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
            {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('role_id', 'Role', ['class' => 'control-label']) !!}
            {!! Form::select('role_id', ['' => 'Choose a Role', 0 => "User", 1 => "Admin"] , $user->role_id , ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('is_active', 'Active', ['class' => 'control-label']) !!}
            {!! Form::select('is_active', array(1 => "Active", 0 => "Not Active") , $user->is_active , ['class' => 'form-control']) !!}
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
            {!! Form::submit('Edit Admin', ['class' => 'btn btn-primary col-sm-3']) !!}
        </div>

        {!! Form::close() !!}

        {!! Form::model($user, ['method' => 'DELETE', "action" => ["AdminUsersController@destroy", $user->id]]) !!}

            <div class = "form-group">
                {!! Form::submit('Delete Admin', ['class' => 'btn btn-danger col-sm-3']) !!}
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
