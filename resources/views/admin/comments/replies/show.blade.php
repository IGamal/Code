@extends('layouts.admin');

@section('content')

    @if(count($replies) > 0 )

        <h1>Comments</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Post</th>
                <th>Body</th>
                <th>Created at</th>
                <th>updated at</th>
                <th>Approve</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach ($replies as $reply)
                    <th>{{$reply->id}}</th>
                    <th>{{$reply->author}}</th>
                    <th>{{$reply->email}}</th>
                    <th><a href = "{{route('home.post', $reply->comment->post_id)}}">{{$reply->comment->post->title}}</a></th>
                    <th>{{$reply->body}}</th>
                    <th>{{$reply->created_at->diffforhumans()}}</th>
                    <th>{{$reply->updated_at->diffforhumans()}}</th>
                    @if ($reply->is_active == 0 )
                        <th>
                            {!! Form::model($reply,['method' => 'PATCH', 'action' => ['CommentRepliesController@update', $reply->id]]) !!}

                            {!! Form::submit('Approve',['class' => 'btn btn-success']) !!}

                            {!! Form::close() !!}
                        </th>
                    @else
                        <th><div class= 'btn btn-info'>Approved</div></th>
                    @endif
                    <th>
                        {!! Form::model($reply, ['method' => 'DELETE', 'action' => ['CommentRepliesController@destroy', $reply->id]]) !!}

                        {!! Form::submit('Delete',['class' => 'btn btn-danger']) !!}

                        {!! Form::close() !!}
                    </th>
            </tr>
            @endforeach
            </tbody>
        </table>

    @else
        <h1>No Replies</h1>
    @endif

@stop
