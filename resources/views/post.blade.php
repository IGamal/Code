@extends('layouts.blog-post')

<?php use App\Category; ?>

@section('body')
    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by <a href="#">{{$post->user->name}}</a>
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffforhumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo_path}}" alt="">

    <hr>

    <!-- Post Content -->
    <p class="lead">{!! $post->body !!}</p>

    <hr>

    <!-- Blog Comments -->
    @if(Session()->has('comment_message')) <p class="btn btn-success"> {{session('comment_message')}}</p> @endif

    @if(Auth::check())
    <!-- Comments Form -->
        <div class="well">
            <h4>Leave a Comment:</h4>
            {!! Form::open(['method' => 'POST', 'action' => 'PostCommentsController@store']) !!}

                <input type="hidden" name="post_id" value="{{$post->id}}">

                <div class = "form-group">
                    @if($errors->has('body')) <p class = 'error'>{{$errors->first('body') }}</p> @endif

                    {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 3]) !!}

                    {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    <hr>
    @endif



    <!-- Posted Comments -->

    <!-- Comment -->
    @if(count($comments) > 0)

        @foreach ($comments as $comment)
            @if($comment->is_active == 1)
            <div class="media">
                <a class="pull-left" href="#">
                    <img height= 64 class="media-object" src="{{$comment->photo}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$comment->author}}
                        <small>{{$comment->created_at->diffforhumans()}}</small>
                    </h4>
                    {{$comment->body}}
                </div>

                @if(count($comment->replies) > 0)
                    @foreach($comment->replies as $reply)
                        @if($reply->is_active == 1)
                            <!-- Nested Comment -->
                            <div class="media">
                                <a class="pull-left" href="#">
                                    <img height = 50 class="media-object" src="{{$reply->photo}}" alt="">
                                </a>
                                <div class="media-body">
                                    <h4 class="media-heading">{{$reply->author}}
                                        <small>{{$reply->created_at->diffforhumans()}}</small>
                                    </h4>
                                    {{$reply->body}}
                                </div>
                            </div>
                            <!-- End Nested Comment -->
                        @endif
                    @endforeach
                @endif

            </div>

                @if(Auth::check())
                <!-- Replay Form -->
                    <div class = "comment-reply-container">

                        <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                        <div class="comment-reply">
                            {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@store']) !!}

                            <input type="text" name="comment_id" value="{{$comment->id}}" hidden>

                            <div class = "form-group">
                                @if($errors->has('reply')) <p class = 'error'>{{$errors->first('reply') }}</p> @endif

                                {!! Form::textarea('reply', null, ['class' => 'form-control', 'rows' => 2]) !!}

                                {!! Form::submit('Submit',['class' => 'btn btn-primary']) !!}
                            </div>
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <hr>
                @endif
            @endif
        @endforeach
    @endif

@stop

@section('category')

    <?php $categories = Category::all(); ?>

    <div class="row">
        <div class="col-lg-6">
            <ul class="list-unstyled">
                @foreach($categories as $category)
                    <li>{{$category->name}}</li>
                @endforeach
            </ul>
        </div>
        <div class="col-lg-6">
            <ul class="list-unstyled">
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
                <li><a href="#">Category Name</a>
                </li>
            </ul>
        </div>
    </div>
@stop

@section('script')
    <script>
        $(".comment-reply-container .toggle-reply").click(function()
        {
            $(this).next().slideToggle('slow')
        });
    </script>
@stop
