@extends('layouts.admin');

@section('content')

    <h1> Categories </h1>

    <div class="col-sm-6">
        {!! Form::open(['method' => 'Post', 'AdminCategoriesController@store']) !!}

            <div class = "form-group">
                {!! Form::label('name', 'Name', ['class' => 'label-control']) !!}
                {!! Form::text('name','', ['class' => 'form-control']) !!}
            </div>

        <div class = 'form-group'>
            {!! Form::submit('Add Category', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}
    </div>

    <div class="col-sm-6">
        <table class="table">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Created date</th>
                    <th>Updated date</th>
                </tr>

                @if($categories)
                    @foreach($categories as $category)
                        <tr>
                            <th>{{$category->id}}</th>
                            <th><a href="{{route('categories.edit', $category->id)}}">{{$category->name}}</a></th>
                            <th>{{$category->created_at->diffforhumans()}}</th>
                            <th>{{$category->updated_at->diffforhumans()}}</th>
                            <th>{!! Form::model($category, ['method' => 'DELETE', "action" => ["AdminCategoriesController@destroy", $category->id]]) !!}
                                {!! Form::submit('Delete Category', ['class' => 'btn btn-danger']) !!}
                                {!! Form::close() !!}
                            </th>
                        </tr>
                    @endforeach
                @endif
            </thead>
        </table>
    </div>

@stop
