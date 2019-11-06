@extends('layouts.admin')

@section('content')

    @if(count($replies) > 0 )

        <h1>Replies</h1>

        {!! Form::open(['method' => 'delete', "action" => 'CommentRepliesController@delete']) !!}

        <table class="table">
            <thead>
            <tr>
                <th><input type="checkbox" id="options"></th>
                <th>ID</th>
                <th>Author</th>
                <th>Email</th>
                <th>Post</th>
                <th>Body</th>
                <th>Created at</th>
                <th>updated at</th>
                <th>Approve</th>
            </tr>
            @foreach ($replies as $reply)
                <tr>
                    <th><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$reply->id}}"></th>
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
                </tr>
            @endforeach
        </table>
        {!! Form::submit('Delete',['class' => 'btn btn-danger']) !!}

    {!! Form::close() !!}

    @else
        <h1>No Replies</h1>
    @endif

@stop
