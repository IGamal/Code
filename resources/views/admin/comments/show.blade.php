@extends('layouts.admin')

@section('content')

    @if(count($comments) > 0 )

        <h1>Comments</h1>

        <table class="table">
            <thead>
            <tr>
                <th>Id</th>
                <th>Author</th>
                <th>Email</th>
                <th>Post</th>
                <th>Replies</th>
                <th>Body</th>
                <th>Created at</th>
                <th>updated at</th>
                <th>Approve</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                @foreach ($comments as $comment)
                    <th>{{$comment->id}}</th>
                    <th>{{$comment->author}}</th>
                    <th>{{$comment->email}}</th>
                    <th><a href = "{{route('home.post', $comment->post_id)}}">{{$comment->post->title}}</a></th>
                    <th><a href = "{{route('replies.show', $comment->id)}}">Replies</a></th>
                    <th>{{$comment->body}}</th>
                    <th>{{$comment->created_at->diffforhumans()}}</th>
                    <th>{{$comment->updated_at->diffforhumans()}}</th>
                    @if ($comment->is_active == 0 )
                        <th>
                            {!! Form::model($comment,['method' => 'PATCH', 'action' => ['PostCommentsController@update', $comment->id]]) !!}

                            {!! Form::submit('Approve',['class' => 'btn btn-success']) !!}

                            {!! Form::close() !!}
                        </th>
                    @else
                        <th><div class= 'btn btn-info'>Approved</div></th>
                    @endif
                    <th>
                        {!! Form::model($comment, ['method' => 'DELETE', 'action' => ['PostCommentsController@destroy', $comment->id]]) !!}

                        {!! Form::submit('Delete',['class' => 'btn btn-danger']) !!}

                        {!! Form::close() !!}
                    </th>
            </tr>
            @endforeach
            </tbody>
        </table>

    @else
        <h1>No Comments</h1>
    @endif

@stop
