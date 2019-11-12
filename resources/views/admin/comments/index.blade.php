@extends('layouts.admin')

@section('content')

    @if(count($comments) > 0 )

        <h1>Comments</h1>

        {!! Form::open(['method' => 'POST', "action" => 'PostCommentsController@checkrequest']) !!}
            <table class="table">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="options"></th>
                        <th>Id</th>
                        <th>Author</th>
                        <th>Email</th>
                        <th>Post</th>
                        <th>Replies</th>
                        <th>Body</th>
                        <th>Created at</th>
                        <th>updated at</th>
                        <th>Approve</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    @foreach ($comments as $comment)
                        <th><input class="checkBoxes" type="checkbox" name="checkBoxArray[]" value="{{$comment->id}}"></th>
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
                                    {!! Form::model($comment, ['method' => 'POST', 'action' =>[ 'PostCommentsController@checkrequest', $comment->id]]) !!}
                                    <input type="text" value="{{$comment->id}}" name="id" hidden>
                                    {!! Form::submit('Approve',['class' => 'btn btn-success', 'name'=> 'update']) !!}
                                    {!! Form::close() !!}
                                </th>
                            @else
                                <th><div class= 'btn btn-info'>Approved</div></th>
                            @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! Form::submit('Delete Comment',['class' => 'btn btn-danger', 'name'=> 'delete']) !!}

        {!! Form::close() !!}
        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{$comments->render()}}
            </div>
        </div>

    @else
    <h1>No Comments</h1>
    @endif

@stop
