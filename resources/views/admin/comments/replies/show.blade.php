@extends('layouts.admin')

@section('content')

    @if(count($replies) > 0 )

        <h1>Replies</h1>

        {!! Form::open(['method' => 'POST', "action" => 'CommentRepliesController@checkrequest']) !!}

        <table class="table">
            <thead>
            <tr>
                <th><input type="checkbox" id="options"></th>
                <th>ID</th>
                <th>Author</th>
                <th>Email</th>
                <th>Comment ID</th>
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
                    <th>{{$reply->comment_id}}</th>
                    <th><a href = "{{route('home.post', $reply->comment->post_id)}}">{{$reply->comment->post->title}}</a></th>
                    <th>{{$reply->body}}</th>
                    <th>{{$reply->created_at->diffforhumans()}}</th>
                    <th>{{$reply->updated_at->diffforhumans()}}</th>
                    @if ($reply->is_active == 0 )
                        <th>
                            {!! Form::model($reply, ['method' => 'POST', 'action' =>[ 'CommentRepliesController@checkrequest', $reply->id]]) !!}
                                <input type="text" value="{{$reply->id}}" name="id" hidden>
                                {!! Form::submit('Approve',['class' => 'btn btn-success', 'name'=> 'update']) !!}
                            {!! Form::close() !!}
                        </th>
                    @else
                        <th><div class= 'btn btn-info'>Approved</div></th>
                    @endif
                </tr>
            @endforeach
        </table>
        {!! Form::submit('Delete',['class' => 'btn btn-danger', 'name'=> 'delete']) !!}

    {!! Form::close() !!}

    @else
        <h1>No Replies</h1>
    @endif

@stop
