
@extends ('layouts.admin');

@section("content")

    <h1>Posts</h1>

    @if(Session()->has('add_post')) <p class="btn btn-success"> {{session('add_post')}}</p> @endif
    @if(Session()->has('update_post')) <p class="btn btn-success"> {{session('update_post')}}</p> @endif
    @if(Session()->has('delete_post')) <p class="bg-danger"> {{session('delete_post')}}</p> @endif

    <table class="table">
        <thead>
        <tr>
            <th>ID</th>
            <th>User</th>
            <th>Photo</th>
            <th>Title</th>
            <th>View Post</th>
            <th>View Comments</th>
            <th>Body</th>
            <th>Category</th>
            <th>Created at</th>
            <th>Updated at</th>
            <th>Delete</th>
        </tr>
        @if ($posts)
            @foreach ($posts as $post)
                <tr>
                    <th>{{$post->id}}</th>
                    <th>{{$post->user->name}}</th>
                    <th><img height= '50' src="{{$post->photo_path}}"></th>
                    <th><a href ="{{route('posts.edit', $post->id)}}">{{$post->title}}</a></th>
                    <th><a href = "{{route('home.post', $post->id)}}">View Post</a></th>
                    <th><a href = "{{route('comments.show', $post->id)}}">View Comments</a></th>
                    <th>{{$post->body}}</th>
                    <th>{{$post->category ? $post->category->name : "Uncategorized"}}</th>
                    <th>{{$post->created_at->diffforhumans()}}</th>
                    <th>{{$post->updated_at->diffforhumans()}}</th>
                    <th>
                        {!! Form::model($post, ['method' => 'DELETE', "action" => ["AdminPostsController@destroy", $post->id]]) !!}

                            {!! Form::submit('Delete Post', ['class' => 'btn btn-danger']) !!}

                        {!! Form::close() !!}
                    </th>
                    @endforeach
                </tr>
                @endif
        </thead>
    </table>
@stop

