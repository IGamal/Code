
@extends ('layouts.admin');

@section("content")

    <h1>Admins</h1>

    @if(Session()->has('add_admin')) <p class="btn btn-success"> {{session('add_admin')}}</p> @endif
    @if(Session()->has('update_admin')) <p class="btn btn-success"> {{session('update_admin')}}</p> @endif
    @if(Session()->has('delete_admin')) <p class="bg-danger"> {{session('delete_admin')}}</p> @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>Photo</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Is Active</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Delete</th>
        </tr>
        @if ($users)
            @foreach ($users as $user)
            <tr>
                <th>{{$user->id}}</th>
                <th><img height= '50' src="{{$user->photo_path}}"></th>
                <th><a href ="{{route('users.edit', $user->id)}}">{{$user->name}}</a></th>
                <th>{{$user->email}}</th>
                <th>{{$user->role_id ? "Admin" : "User"}}</th>
                <th>{{$user->is_active ? "Active" : "Not Active"}}</th>
                <th>{{$user->created_at->diffforhumans()}}</th>
                <th>{{$user->updated_at->diffforhumans()}}</th>
                <th>{!! Form::model($user, ['method' => 'DELETE', "action" => ["AdminUsersController@destroy", $user->id]]) !!}
                        {!! Form::submit('Delete Admin', ['class' => 'btn btn-danger']) !!}
                    {!! Form::close() !!}
                </th>
            @endforeach
            </tr>
        @endif
        </thead>
    </table>
@stop
