@extends ('layouts.admin')

@section("content")
    <h1>Edit Admin</h1>

    <div class="col-sm-3">
        <img class="img-responsive img-rounded" src="{{$user->photo_path}}">
    </div>

    <div class="col-sm-9">
        {!! Form::model($user, ['method' => 'PATCH', "action" => ["AdminUsersController@update", $user->id], "files"=> "true"]) !!}

        <div class = "form-group">
            {!! Form::label('name', 'Name', ['class' => 'control-label']) !!}
            @if($errors->has('name')) <p class = 'error'>{{$errors->first('name') }}</p> @endif
            {!! Form::text('name', $user->name, ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('email', 'Email', ['class' => 'control-label']) !!}
            @if($errors->has('email')) <p class = 'error'>{{$errors->first('email') }}</p> @endif
            {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('role_id', 'Role', ['class' => 'control-label']) !!}
            @if($errors->has('role_id')) <p class = 'error'>{{$errors->first('role_id') }}</p> @endif
            {!! Form::select('role_id', ['' => 'Choose a Role', 0 => "User", 1 => "Admin"] , $user->role_id , ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('is_active', 'Active', ['class' => 'control-label']) !!}
            @if($errors->has('is_active')) <p class = 'error'>{{$errors->first('is_active') }}</p> @endif
            {!! Form::select('is_active', ['' => 'Choose Activity', 1 => "Active", 0 => "Not Active"] , $user->is_active , ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('password', 'Password', ['class' => 'control-label']) !!}
            @if($errors->has('password')) <p class = 'error'>{{$errors->first('password') }}</p> @endif
            {!! Form::password('password', ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('confirm_password', 'Confirm Password', ['class' => 'control-label']) !!}
            @if($errors->has('password_confirmation')) <p class = 'error'>{{$errors->first('password_confirmation') }}</p> @endif
            {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
        </div>

        <div class = "form-group">
            {!! Form::label('photo_path', 'Photo', ['class' => '']) !!}
            @if($errors->has('photo_path')) <p class = 'error'>{{$errors->first('photo_path') }}</p> @endif
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
    </div>
@stop
